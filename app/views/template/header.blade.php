<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Partilha a localização de pessoas suspeitas e/ou assaltos que tenhas sido vítima/presenciado">

    <title>Anti-Gatunos - {{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('vendor/pickadate/themes/default.css') }}" id="theme_base">
    <link rel="stylesheet" href="{{ URL::asset('vendor/pickadate/themes/default.date.css') }}" id="theme_date">
    <link rel="stylesheet" href="{{ URL::asset('vendor/pickadate/themes/default.time.css') }}" id="theme_time">

    <link href="{{ URL::asset('apple-touch-icon.png') }}" rel="apple-touch-icon" />
    <link href="{{ URL::asset('apple-touch-icon-76x76.png') }}" rel="apple-touch-icon" sizes="76x76" />
    <link href="{{ URL::asset('apple-touch-icon-120x120.png') }}" rel="apple-touch-icon" sizes="120x120" />
    <link href="{{ URL::asset('apple-touch-icon-152x152.png') }}" rel="apple-touch-icon" sizes="152x152" />

    <script src="{{ URL::asset('vendor/pickadate/picker.js') }}"></script>
    <script src="{{ URL::asset('vendor/pickadate/picker.date.js') }}"></script>
    <script src="{{ URL::asset('vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ URL::asset('vendor/pickadate/legacy.js') }}"></script>

    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <style>
        #map-canvas {
            height: 100%;
            margin: 0px;
            padding: 0px;
            height:400px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
</head>

<body>

<!-- Static navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('home') }}"><img src="{{ URL::asset('leLogo2.png') }}" style="max-width:220px"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ URL::route('home') }}">Home</a></li>
                <li><a href="{{ URL::route('addOccurrence') }}">Adicionar Ocorrência</a></li>
                @if(!Auth::check())
                <li><a href="{{ URL::to('login/fb') }}">Login</a></li>
                @else
                <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
