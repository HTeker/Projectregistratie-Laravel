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


            <div class="uk-grid" data-uk-grid-margin="">
                <div class="login-center">
                    <div class="uk-panel uk-panel-box login-panel">
                        <h2 class="text-center">Log in</h2>
                            @include('_partials.errors')
                        {{ Form::open(array( 'url'=>'/login', 'method'=>'POST', 'class'=>'uk-form')) }}
                            <div class="uk-form-row">
                                {{ Form::text('email',null,array('placeholder'=>'E-mail','class'=>'uk-width-1-1', 'autofocus'=>'autofocus')) }}
                            </div>
                            <div class="uk-form-row">
                                {{ Form::password('wachtwoord',array('placeholder'=>'Wachtwoord','class'=>'uk-width-1-1', 'autofocus'=>'autofocus')) }}
                            </div>
                        <br>
                            <hr class="uk-grid-divider">
                            <button class="uk-button uk-button-primary">Log in</button>
                        {{ Form::close() }}
                    </div>

                </div>

            </div>

        </div>

    
<div class="uk-tooltip"></div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
</body></html>

<!--
    <div class="center-login-content">
        <div class="login-form">
          <h6 class="text-center">Heeft u een account?</h6>
          
          
          <br>
          <div class="form-group">
            <input type="text" class="form-control login-field" value="" placeholder="Gebruikersnaam" id="login-name">
            <label class="login-field-icon fui-user" for="login-name"></label>
          </div>

          <div class="form-group">
            <input type="password" class="form-control login-field" value="" placeholder="Wachtwoord" id="login-pass">
            <label class="login-field-icon fui-lock" for="login-pass"></label>
          </div>

          <a class="btn btn-primary btn-lg btn-block" href="#">Log in</a>
          <a class="login-link" href="#">Wachtwoord vergeten?</a>
        </div>
  </div>