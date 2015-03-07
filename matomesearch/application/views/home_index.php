<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タイトル</title>
    <link rel="stylesheet" href="/css/cssreset-min.css">
    <style>
        html, body {
            height: 100%;
            min-height: 100%;
            width: 100%;
        }

        .container {
            height: 100%;
            width: 100%;
        }

        .header {
            height: 100px;
            background: #f2f2f2;
            margin-bottom: 30px;
        }

        .search {

        }
        
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <div class="search">

                <input type="text">

            </div>
        </div>

        <div class="main">
            
            todo: 検索ボックス、表示画面

            <div class="result">
                <ul class="left">
                    <li>
                        <a href="blogUrl">ブログ記事タイトル</a>
                        <span class="small">元ブログ</span>
                    </li>
                </ul>

                <ul class="right">
                    <li>
                        <a href="blogUrl">ブログ記事タイトル</a>
                        <span class="small">元ブログ</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
    <script src="/js/jquery-2.1.3.min.js"></script>
    <!-- <script src="/js/bootstrap.min.js"></script> -->
</body>
</html