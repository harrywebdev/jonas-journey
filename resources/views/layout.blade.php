<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') &ndash; Jonas's Journey</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #ecf0f1;
            color: #2c3e50;
            font-family: 'Source Serif Pro', serif;
            font-weight: 400;
            margin: 0;
            font-size: 1.25em;
            line-height: 1.75em;
        }

        h1 {
            font-size: 2em;
            line-height: 2em;
            font-weight: 700;
            margin-top: 0;
            border-bottom: 1px solid #eee;
        }

        h2 {
            font-size: 1.5em;
            line-height: 1.5em;
            font-weight: 600;
            margin-top: 0;
        }

        a {
            color: #27ae60;
        }

        video {
            width: 100%;
            height: auto;
            max-height: 480px;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 1em;
        }

        figure {
            box-shadow: 0 0 10px 5px #f5f5f5;
            padding: 8px;
            margin-top: 2em;
            margin-bottom: 2em;
        }

        figcaption {
            padding: 12px;
            font-size: 0.65em;
            line-height: 1.25em;
            color: #7f8c8d;
            text-align: center;
        }

        .post-footer {
            border-top: 1px solid #eee;
            padding: 1em;
            margin-top: 1em;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .post-footer__next {
            margin-left: auto;
        }

        pre {
            background: #34495e;
            color: #fff;
            padding: 1em;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Jonas's Journey</h1>

    @yield('content')
</div>
</body>
</html>
