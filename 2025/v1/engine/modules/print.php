<?php
/*
=====================================================
 DataLife Engine - by SoftNews Media Group
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004-2020 SoftNews Media Group
=====================================================
 This code is protected by copyright
=====================================================
 File: print.php
-----------------------------------------------------
 Use: Print version of the article
=====================================================
*/

if( !defined('DATALIFEENGINE') ) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}

$is_amp = isset($_GET['amp']) && $_GET['amp'] == 1;

if ($cstart == 1) $cstart = 0;
$news_found = false;
$allow_comments = false;

if ($config['allow_alt_url'] AND $config['seo_type'] AND $category AND $cstart) {
	$cstart = ($cstart - 1) * $config['news_number'] + 1;
}

if ($dle_module != "static" AND isset($_GET['news_page']) AND $_GET['news_page']) {
	$news_page = intval($_GET['news_page']);
	if ($news_page) $news_page = $news_page - 1;
}

$url_page = $config['http_home_url'];

$thisdate = date( "Y-m-d H:i:s", time() );

if( $config['no_date'] AND !$config['news_future'] AND !$user_group[$member_id['user_group']]['allow_all_edit']) {
	$where_date = " AND date < '" . $thisdate . "'";
} else {
	$where_date = "";
}

if ($dle_module == "static") {
	
	// ... [static page handling code] ...
	
} else {
	
	$sql_select = "SELECT p.id, p.autor, p.date, p.short_story, CHAR_LENGTH(p.full_story) as full_story_length, p.xfields, p.title, p.category, p.alt_name, p.allow_comm, p.allow_main, p.approve, p.fixed, p.tags, e.news_read, e.allow_rate, e.rating, e.vote_num, e.votes, e.view_edit, e.editdate, e.editor, e.reason FROM " . PREFIX . "_post p LEFT JOIN " . PREFIX . "_post_extras e ON (p.id=e.news_id) WHERE p.id = '{$newsid}'" . $where_date;
	
	if ($is_logged AND $user_group[$member_id['user_group']]['allow_all_edit']) {
		$sql_select = str_replace( "p.approve = '1'", "p.approve > '0'", $sql_select );
	}
	
	if ($allow_main) $sql_select = str_replace( "p.allow_main = '1'", "p.allow_main > '0'", $sql_select );
	
	$result = $db->query( $sql_select );
	$row = $db->get_row( $result );
	
	if ( $row['id'] ) {
		$options = news_permission( $row['id'] );
		
		if ($options[$member_id['user_group']] AND $options[$member_id['user_group']] != 3) {
			
			$news_found = true;
			$allow_comments = true;
			
			if( $options[$member_id['user_group']] == 1 ) $allow_comments = false;
			if( $options[$member_id['user_group']] == 2 ) {
				$row['short_story'] = stripslashes( $row['short_story'] );
				$row['full_story'] = "";
			}
			
			if ($config['allow_alt_url'] AND $config['seo_type'] AND $row['full_story_length'] > 0 AND $news_page) {
				
				$row['full_story'] = $db->super_query( "SELECT full_story FROM " . PREFIX . "_post_content WHERE news_id='{$row['id']}'" );
				$row['full_story'] = $row['full_story']['full_story'];
				
			}
			
			$row['date'] = strtotime( $row['date'] );
			
			$row['category'] = intval( $row['category'] );
			
			if( $config['allow_alt_url'] ) {
				
				if( $config['seo_type'] == 1 OR $config['seo_type'] == 2 ) {
					
					if( $row['category'] and $config['seo_type'] == 2 ) {
						
						$full_link = $config['http_home_url'] . get_url( $row['category'] ) . "/" . $row['id'] . "-" . $row['alt_name'] . ".html";
						
					} else {
						
						$full_link = $config['http_home_url'] . $row['id'] . "-" . $row['alt_name'] . ".html";
						
					}
					
				} else {
					
					$full_link = $config['http_home_url'] . date( 'Y/m/d/', $row['date'] ) . $row['alt_name'] . ".html";
				}
				
			} else {
				
				$full_link = $config['http_home_url'] . "index.php?newsid=" . $row['id'];
				
			}
			
			if( $row['tags'] ) {
				
				$tags = array ();
				
				$row['tags'] = explode( ",", $row['tags'] );
				
				foreach ( $row['tags'] as $value ) {
					
					$value = trim( $value );
					
					if( $config['allow_alt_url'] ) {
						
						$tags[] = "<a href=\"" . $config['http_home_url'] . "tags/" . urlencode( $value ) . "/\">" . $value . "</a>";
					
					} else {
						
						$tags[] = "<a href=\"$PHP_SELF?do=tags&amp;tag=" . urlencode( $value ) . "\">" . $value . "</a>";
					
					}
				
				}
				
				$row['tags'] = implode( ", ", $tags );
			
			} else {
				
				$row['tags'] = "";
			
			}
			
			if ( $row['category'] ) {
				
				$my_cat = array ();
				$my_cat_icon = array();
				$my_cat_link = array();
				
				$cat_list = explode( ',', $row['category'] );
				
				foreach ( $cat_list as $element ) {
					if( $element ) {
						$my_cat[] = $cat_info[$element]['name'];
						$my_cat_icon[] = $cat_info[$element]['icon'];
						$my_cat_link[] = $config['http_home_url'] . get_url( $element );
					}
				}
				
				$row['category'] = implode( ', ', $my_cat );
				$row['category_icon'] = implode( '', $my_cat_icon );
				
				$row['category_link'] = $my_cat_link;
			
			} else {
				
				$row['category'] = $lang['no_category'];
				$row['category_icon'] = "";
				$row['category_link'] = array ();
			
			}
			
			$row['short_story'] = stripslashes( $row['short_story'] );
			
			if( $row['full_story_length'] > 0 ) {
				
				$row['full_story'] = stripslashes( $row['full_story'] );
			
			} else {
				
				$row['full_story'] = "";
			
			}
			
			$news_seiten = explode( "{PAGEBREAK}", $row['full_story'] );
			$anzahl_seiten = count( $news_seiten );
			
			if( $news_page <= 0 OR $news_page > $anzahl_seiten ) {
				$news_page = 0;
			}
			
			if( $anzahl_seiten > 1 AND $news_page ) {
				
				$row['full_story'] = $news_seiten[$news_page];
			
			} else {
				
				$row['full_story'] = implode( "", $news_seiten );
			
			}
			
			// Process AMP content if needed
			if ($is_amp) {
				$row['full_story'] = validate_amp_content($row['full_story']);
				$row['short_story'] = validate_amp_content($row['short_story']);
			}
			
			$row['title'] = stripslashes( $row['title'] );
			
			$metatags['title'] = $row['title'];
			
			if( $config['create_metatags'] AND $row['keywords'] ) {
				$metatags['keywords'] = $row['keywords'];
			}
			
			if( $config['create_metatags'] AND $row['descr'] ) {
				$metatags['description'] = $row['descr'];
			}
			
			$row['xfields'] = stripslashes( $row['xfields'] );
			
			if( $row['xfields'] ) {
				$xfieldsdata = xfieldsdataload( $row['xfields'] );
			}
			
			if( $config['files_allow'] ) {
				if( $row['files'] ) $fileinfo = explode( ',', $row['files'] );
				else $fileinfo = array ();
			} else $fileinfo = array ();
			
			$row['full_story'] = str_replace( "{PAGEBREAK}", "", $row['full_story'] );
			
			if( $config['allow_alt_url'] ) {
				$print_link = $full_link . "?print=1";
				$canonical = $full_link;
				$row['print_link'] = $print_link;
			} else {
				$print_link = $config['http_home_url'] . "index.php?newsid=" . $row['id'] . "&seourl=" . $row['alt_name'] . "&print=1";
				$canonical = $config['http_home_url'] . "index.php?newsid=" . $row['id'];
				$row['print_link'] = $print_link;
			}
			
			if( $news_page > 0 ) {
				$canonical = $canonical . "?news_page=" . ($news_page + 1);
			}
			
			$news_navigation = "";
			
			if( $anzahl_seiten > 1 ) {
				
				if( $news_page ) {
					$page = $news_page + 1;
				} else {
					$page = 1;
				}
				
				// ... [pagination code] ...
			}
			
			// Include template
			$tpl->load_template( 'print.tpl' );
			
			if( $news_page ) {
				$tpl->set( '{pages}', $news_navigation );
			} else $tpl->set( '{pages}', '' );
			
			$tpl->set( '{full-story}', $row['full_story'] );
			$tpl->set( '{title}', $row['title'] );
			
			if ( $row['short_story'] ) $tpl->set( '{short-story}', $row['short_story'] );
			else $tpl->set( '{short-story}', '' );
			
			if( $is_logged ) {
				
				$tpl->set( '{login}', $member_id['name'] );
				$tpl->set( '{login-id}', $member_id['user_id'] );
			
			} else {
				
				$tpl->set( '{login}', $lang['guest'] );
				$tpl->set( '{login-id}', '0' );
			
			}
			
			$tpl->set( '{news-id}', $row['id'] );
			$tpl->set( '{date}', langdate( $config['timestamp_active'], $row['date'] ) );
			$tpl->set( '{category}', $row['category'] );
			$tpl->set( '{link-category}', $config['http_home_url'] . get_url( $row['category_link'][0] ) );
			
			$tpl->set( '{author}', $row['autor'] );
			$tpl->set( '{comments-num}', $row['comm_num'] );
			$tpl->set( '{tags}', $row['tags'] );
			
			if( $row['tags'] ) $tpl->set( '[tags]', "" );
			else $tpl->set_block( "'\\[tags\\](.*?)\\[/tags\\]'si", "" );
			
			if( $row['category_icon'] ) {
				$tpl->set( '[category-icon]', "" );
				$tpl->set( '[/category-icon]', "" );
				$tpl->set( '{category-icon}', $row['category_icon'] );
			} else {
				$tpl->set_block( "'\\[category-icon\\](.*?)\\[/category-icon\\]'si", "" );
				$tpl->set( '{category-icon}', "" );
			}
			
			if ( $xfieldsdata ) {
				foreach ( $xfieldsdata as $key => $value ) {
					$tpl->set( "[xfvalue_{$key}]", $value );
					$tpl->set( "{xfvalue_{$key}}", $value );
				}
			}
			
			$tpl->set( '{full-link}', $full_link );
			
			if( $is_amp ) {
				$tpl->set( '[amp]', '' );
				$tpl->set( '[/amp]', '' );
				$tpl->set_block( "'\\[not-amp\\](.*?)\\[/not-amp\\]'si", "" );
			} else {
				$tpl->set( '[not-amp]', '' );
				$tpl->set( '[/not-amp]', '' );
				$tpl->set_block( "'\\[amp\\](.*?)\\[/amp\\]'si", "" );
			}
			
			$tpl->compile( 'content' );
			$tpl->clear();
			
		} else $tpl->result['content'] = $lang['text_denied'];
	
	} else $tpl->result['content'] = $lang['news_not_found'];

}

// AMP validation and processing
function validate_amp_content($content) {
    // Remove disallowed tags in AMP
    $disallowed_tags = ['script', 'iframe', 'frame', 'frameset', 'object', 'param', 'applet', 'embed'];
    foreach ($disallowed_tags as $tag) {
        $content = preg_replace('/<'.$tag.'[^>]*>.*?<\/'.$tag.'>/is', '', $content);
        $content = preg_replace('/<'.$tag.'[^>]*\/>/is', '', $content);
    }
    
    // Convert img tags to amp-img
    $content = preg_replace_callback('/<img([^>]*)>/is', 'convert_to_amp_img', $content);
    
    // Convert video tags to amp-video
    $content = preg_replace_callback('/<video([^>]*?)>(.*?)<\/video>/is', 'convert_to_amp_video', $content);
    
    // Convert iframes to amp-iframe (if any remain after filtering)
    $content = preg_replace_callback('/<iframe([^>]*)><\/iframe>/is', 'convert_to_amp_iframe', $content);
    
    // Remove inline styles (not allowed in AMP)
    $content = preg_replace('/style\s*=\s*"[^"]*"/i', '', $content);
    
    // Process all fullstory.tpl tags
    $content = process_fullstory_tags($content);
    
    return $content;
}

// Convert img to amp-img with proper dimensions
function convert_to_amp_img($matches) {
    $attributes = $matches[1];
    
    // Extract width and height
    $width = preg_match('/width\s*=\s*["\']?(\d+)["\']?/i', $attributes, $width_match) ? $width_match[1] : '100';
    $height = preg_match('/height\s*=\s*["\']?(\d+)["\']?/i', $attributes, $height_match) ? $height_match[1] : '100';
    $src = preg_match('/src\s*=\s*["\']([^"\']*)["\']/', $attributes, $src_match) ? $src_match[1] : '';
    $alt = preg_match('/alt\s*=\s*["\']([^"\']*)["\']/', $attributes, $alt_match) ? $alt_match[1] : '';
    
    // If no height specified, calculate based on width to maintain aspect ratio
    if (!$height_match && $width_match) {
        // Get image dimensions from the actual image
        if ($src && file_exists(ROOT_DIR . '/' . $src)) {
            $img_size = getimagesize(ROOT_DIR . '/' . $src);
            if ($img_size) {
                $original_width = $img_size[0];
                $original_height = $img_size[1];
                
                // Calculate proportional height
                if ($original_width > 0) {
                    $height = round(($width / $original_width) * $original_height);
                }
            }
        }
    }
    
    // If still no valid height, use default responsive layout
    $layout = (!$width_match || !$height_match || $height < 1) ? ' layout="responsive"' : '';
    
    return '<amp-img src="' . $src . '" width="' . $width . '" height="' . $height . '" alt="' . $alt . '"' . $layout . '></amp-img>';
}

// Convert video to amp-video
function convert_to_amp_video($matches) {
    $attributes = $matches[1];
    $content = $matches[2];
    
    // Extract width and height
    $width = preg_match('/width\s*=\s*["\']?(\d+)["\']?/i', $attributes, $width_match) ? $width_match[1] : '640';
    $height = preg_match('/height\s*=\s*["\']?(\d+)["\']?/i', $attributes, $height_match) ? $height_match[1] : '360';
    
    // Extract source
    preg_match('/<source[^>]*src\s*=\s*["\']([^"\']*)["\'][^>]*>/i', $content, $source_match);
    $src = isset($source_match[1]) ? $source_match[1] : '';
    
    if (!$src) {
        preg_match('/src\s*=\s*["\']([^"\']*)["\']/', $attributes, $src_match);
        $src = isset($src_match[1]) ? $src_match[1] : '';
    }
    
    return '<amp-video width="' . $width . '" height="' . $height . '" src="' . $src . '" layout="responsive" controls></amp-video>';
}

// Convert iframe to amp-iframe
function convert_to_amp_iframe($matches) {
    $attributes = $matches[1];
    
    // Extract width and height
    $width = preg_match('/width\s*=\s*["\']?(\d+)["\']?/i', $attributes, $width_match) ? $width_match[1] : '640';
    $height = preg_match('/height\s*=\s*["\']?(\d+)["\']?/i', $attributes, $height_match) ? $height_match[1] : '360';
    $src = preg_match('/src\s*=\s*["\']([^"\']*)["\']/', $attributes, $src_match) ? $src_match[1] : '';
    
    return '<amp-iframe width="' . $width . '" height="' . $height . '" src="' . $src . '" layout="responsive" sandbox="allow-scripts allow-same-origin" frameborder="0"></amp-iframe>';
}

// Process fullstory.tpl tags
function process_fullstory_tags($content) {
    global $row, $config, $user_group, $member_id, $lang;
    
    // Replace common DLE tags
    $content = str_replace('{title}', $row['title'], $content);
    $content = str_replace('{date}', langdate($config  $row['title'], $content);
    $content = str_replace('{date}', langdate($config['timestamp_active'], $row['date']), $content);
    $content = str_replace('{category}', $row['category'], $content);
    $content = str_replace('{author}', $row['autor'], $content);
    
    // Process xfields
    if ($row['xfields']) {
        $xfieldsdata = xfieldsdataload($row['xfields']);
        foreach ($xfieldsdata as $key => $value) {
            $content = str_replace("{xfield_".$key."}", $value, $content);
        }
    }
    
    // Process tags
    $content = str_replace('{tags}', $row['tags'], $content);
    
    // Process related news if available
    if (strpos($content, '{related-news}') !== false) {
        // Code to handle related news would go here
        $content = str_replace('{related-news}', '', $content);
    }
    
    return $content;
}

// Add AMP boilerplate
function add_amp_boilerplate($content) {
    $boilerplate = '
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
    <noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    ';
    
    return $content . $boilerplate;
}
?>