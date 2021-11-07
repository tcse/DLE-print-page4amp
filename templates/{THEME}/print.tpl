<!doctype html>
<html ⚡ lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="description" content='{full-story limit="150"}'>
	<title>{title} - Название сайта</title>
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0/amp-experiment-0.1.js">
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0/amp-dynamic-css-classes-0.1.js">
    <link rel="preconnect dns-prefetch" href="https://fonts.gstatic.com/" crossorigin>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-experiment" src="https://cdn.ampproject.org/v0/amp-experiment-0.1.js"></script>
    <script async custom-element="amp-dynamic-css-classes" src="https://cdn.ampproject.org/v0/amp-dynamic-css-classes-0.1.js"></script>
    <script custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js" async=""></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
	<script custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js" async=""></script>
	<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <!-- Import other AMP Extensions here -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	{include file="custom/amp/amp-custom-css.tpl"}
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
    <noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <link rel="canonical" href="{full-link}">
	<script type="application/ld+json">
	{
	        "@context": "http://schema.org",
	        "@type": "NewsArticle",
	        "mainEntityOfPage": "{full-link}",
	        "headline": "{title}",
	        "datePublished": "{date=d-m-Y H:i}",
	        "dateModified": "{date=d-m-Y H:i}",
	        "description": "{full-story limit="150"}",
	        "author": {
	          "@type": "Person",
	          "url": "{foto}",
	          "name": "{login}"
	        },
	        "publisher": {
	          "@type": "Organization",
	          "name": "Название сайта",
	          "logo": {
	            "@type": "ImageObject",
	            "url": "{THEME}/images/logo.jpg",
	            "width": 600,
	            "height": 60
	          }
	        },
	        "image": {
	          "@type": "ImageObject",
	          "url": "{image-1}",
	          "height": 2000,
	          "width": 800
	        }
	      }
	</script>
  </head>
  <body>

<!-- Start Navbar -->
<header class="ampstart-headerbar fixed flex justify-start items-center top-0 left-0 right-0 pl2 pr4 ">
    <div role="button" aria-label="open sidebar" on="tap:header-sidebar.toggle" tabindex="0" class="ampstart-navbar-trigger  pr2  ">
        ☰
    </div>
    <div class="ampstart-navbar m-auto">
        Название сайта
    </div>
</header>
<!-- Start Sidebar -->
<amp-sidebar id="header-sidebar" class="ampstart-sidebar px3  " layout="nodisplay">
    <div class="flex justify-start items-center ampstart-sidebar-header">
        <div role="button" aria-label="close sidebar" on="tap:header-sidebar.toggle" tabindex="0" class="ampstart-navbar-trigger items-start">✕</div>
    </div>
    <nav class="ampstart-sidebar-nav ampstart-nav">
        {catmenu id="1-100" subcat="no" template="custom/amp/categorymenu" cache="yes"}
    </nav>
</amp-sidebar>
<!-- End Sidebar -->
<!-- End Navbar -->

<article class="fullstory photo-article">
	<h1 class="title">[full-link]{title}[/full-link]</h1>

	<section class="ampstart-related-section mb4">
		<p class="mb4">{link-category} | {date}</p>
	</section>


	{* Рекламный блок *}
    {* <div class="mb-4">
        <amp-ad width="100vw" height=320
                type="adsense"
                data-ad-client="ca-pub-5295124462895719"
                data-ad-slot="1033992468"
                data-auto-format="rspv"
                data-full-width>
          <div overflow></div>
        </amp-ad>
    </div> *}
	
	<div class="mb4">

		[not-image-1] 
			[fullimage-1] 
			    <amp-img src="{fullimage-1}" width="500" height="150"></amp-img> 
			[/fullimage-1]
		[/not-image-1]

		[image-1] 
			<amp-img src="{image-1}" width="500" height="150"></amp-img> 
		[/image-1]

		{* Вывод youtube ролика через доп.поле *}
		{* [xfgiven_youtube-id]
			<amp-youtube
		    data-videoid="[xfvalue_youtube-id]"
		    layout="responsive"
		    width="480" height="270"></amp-youtube>
	    [/xfgiven_youtube-id] *}

		<div class="not-img">
	    	{full-story}
	    </div>
	</div>
</article>

<!-- Start Footer -->
<footer class="ampstart-footer flex flex-column items-center px3 ">

    {* Поделиться в соцсетях *}
    <ul class="ampstart-social-follow list-reset flex justify-around items-center flex-wrap m0 mb4">
        <li>
            <a href="#" target="_blank" class="inline-block p1" aria-label="Link to AMP HTML Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="22.2" viewBox="0 0 53 49">
                    <title>Twitter</title>
                    <path d="M45 6.9c-1.6 1-3.3 1.6-5.2 2-1.5-1.6-3.6-2.6-5.9-2.6-4.5 0-8.2 3.7-8.2 8.3 0 .6.1 1.3.2 1.9-6.8-.4-12.8-3.7-16.8-8.7C8.4 9 8 10.5 8 12c0 2.8 1.4 5.4 3.6 6.9-1.3-.1-2.6-.5-3.7-1.1v.1c0 4 2.8 7.4 6.6 8.1-.7.2-1.5.3-2.2.3-.5 0-1 0-1.5-.1 1 3.3 4 5.7 7.6 5.7-2.8 2.2-6.3 3.6-10.2 3.6-.6 0-1.3-.1-1.9-.1 3.6 2.3 7.9 3.7 12.5 3.7 15.1 0 23.3-12.6 23.3-23.6 0-.3 0-.7-.1-1 1.6-1.2 3-2.7 4.1-4.3-1.4.6-3 1.1-4.7 1.3 1.7-1 3-2.7 3.6-4.6" class="ampstart-icon ampstart-icon-twitter"></path>
                </svg></a>
        </li>
        <li>
            <a href="#" target="_blank" class="inline-block p1" aria-label="Link to AMP HTML Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="23.6" viewBox="0 0 56 55">
                    <title>Facebook</title>
                    <path d="M47.5 43c0 1.2-.9 2.1-2.1 2.1h-10V30h5.1l.8-5.9h-5.9v-3.7c0-1.7.5-2.9 3-2.9h3.1v-5.3c-.6 0-2.4-.2-4.6-.2-4.5 0-7.5 2.7-7.5 7.8v4.3h-5.1V30h5.1v15.1H10.7c-1.2 0-2.2-.9-2.2-2.1V8.3c0-1.2 1-2.2 2.2-2.2h34.7c1.2 0 2.1 1 2.1 2.2V43" class="ampstart-icon ampstart-icon-fb"></path>
                </svg></a>
        </li>
        <li>
            <a href="#" target="_blank" class="inline-block p1" aria-label="Link to AMP HTML E-mail"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="18.4" viewBox="0 0 56 43">
                    <title>email</title>
                    <path d="M10.5 6.4C9.1 6.4 8 7.5 8 8.9v21.3c0 1.3 1.1 2.5 2.5 2.5h34.9c1.4 0 2.5-1.2 2.5-2.5V8.9c0-1.4-1.1-2.5-2.5-2.5H10.5zm2.1 2.5h30.7L27.9 22.3 12.6 8.9zm-2.1 1.4l16.6 14.6c.5.4 1.2.4 1.7 0l16.6-14.6v19.9H10.5V10.3z" class="ampstart-icon ampstart-icon-email"></path>
                </svg></a>
        </li>
    </ul>

    <nav class="ampstart-footer-nav">
        <ul class="list-reset flex flex-wrap mb3">
            <li class="px1"><a class="text-decoration-none ampstart-label" href="#">О компании</a></li>
            <li class="px1"><a class="text-decoration-none ampstart-label" href="#">Контакты</a></li>
            <li class="px1"><a class="text-decoration-none ampstart-label" href="#">На главную</a></li>
        </ul>
    </nav>
</footer>
<!-- End Footer -->









  </body>
</html>
