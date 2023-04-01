<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="witdh=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="static/imgs/icon.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Sen:wght@700&family=Roboto+Slab&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div id="app">
                <app></app>
            </div>
        </div>
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>

</html>
