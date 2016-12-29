<html lang="en-gb" dir="ltr" class="uk-notouch">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dropdown component - UIkit documentation</title>

        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
        <link id="data-uikit-theme" rel="stylesheet" href="css/uikit.docs.min.css">
        {{ HTML::style('css/uikit.min.css') }}
        {{ HTML::style('css/docs.css') }}
        {{ HTML::style('../vendor/highlight/highlight.css') }}
        {{ HTML::style('css/addons/uikit.addons.css') }}
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 


        <!-- LOADING CUSTOM CSS -->
        {{ HTML::style('css/custom.css') }}

        <script async="" src="//www.google-analytics.com/analytics.js"></script>
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/uikit.min.js') }}
        {{ HTML::script('../vendor/highlight/highlight.js') }}
        {{ HTML::script('js/docs.js') }}
        {{ HTML::script('js/addons/datepicker.js') }}
        

    </head>

    <body>

        <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">

            @include('_partials.nav')


            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-3-4">

                    @yield('content')

                </div>

                <div class="uk-width-medium-1-4">
                    @include('_partials.sidebar')
                </div>

            </div>

        </div>
        
<div class="uk-tooltip"></div>

    @yield('script')
    @yield('sidebar-script')

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
</body></html>