<!DOCTYPE html>
<html [amp]amp[/amp]>
<head>
    <meta charset="{charset}">
    <title>{title} - {THEME}</title>
    [amp]<link rel="canonical" href="{full-link}">[/amp]
    [amp]<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">[/amp]
    [not-amp]<meta name="viewport" content="width=device-width, initial-scale=1.0">[/not-amp]
    [amp]<script async src="https://cdn.ampproject.org/v0.js"></script>[/amp]
    [amp]<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>[/amp]
    [amp]<script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>[/amp]
    [amp]<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>[/amp]
    [amp]<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>[/amp]
    
    [amp]<style amp-custom>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .news-date {
            color: #888;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .category {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .news-content {
            margin-top: 20px;
        }
        .tags {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }
        .print-link {
            margin-top: 30px;
            text-align: center;
        }
        .print-link a {
            color: #2a65a0;
            text-decoration: none;
        }
        .xfields {
            margin-top: 20px;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #eee;
        }
    </style>[/amp]
    
    [not-amp]<style type="text/css">
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .news-date {
            color: #888;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .category {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .news-content {
            margin-top: 20px;
        }
        .tags {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }
        .print-link {
            margin-top: 30px;
            text-align: center;
        }
        .print-link a {
            color: #2a65a0;
            text-decoration: none;
        }
        .xfields {
            margin-top: 20px;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #eee;
        }
        @media print {
            .print-link {
                display: none;
            }
        }
    </style>[/not-amp]
</head>
<body>
    <article>
        <h1>{title}</h1>
        
        <div class="news-date">{date}</div>
        
        <div class="category">
            [category-icon]{category-icon}[/category-icon] {category}
        </div>
        
        <div class="news-content">
            [short-story]{short-story}[/short-story]
            {full-story}
        </div>
        
        [tags]
        <div class="tags">
            <b>Теги:</b> {tags}
        </div>
        [/tags]
        
        <!-- Support for xfields from fullstory.tpl -->
        [xfvalue_source]
        <div class="xfields">
            <b>Источник:</b> {xfvalue_source}
        </div>
        [/xfvalue_source]
        
        [xfvalue_author]
        <div class="xfields">
            <b>Автор:</b> {xfvalue_author}
        </div>
        [/xfvalue_author]
        
        <!-- Add support for other xfields as needed -->
        
        <div class="print-link">
            [not-amp]<a href="javascript:print()">Распечатать</a> | [/not-amp]
            <a href="{full-link}">Вернуться к новости</a>
            [not-amp] | <a href="{full-link}?amp=1">AMP версия</a>[/not-amp]
        </div>
    </article>
</body>
</html>