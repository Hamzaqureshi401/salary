<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SketchStack Pos">
    <meta name="author" content="SketchStack">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="index.html" />
    <title>{{getStoreName()}}</title>
    <link class="js-stylesheet" href="{{ asset('/assets/css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    @livewireScripts()
    @livewireStyles()
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default" class="login-bg" style="background-color: grey;">
    <!-- Your login form goes here -->
    {{$slot}}
    <script src="{{ asset('/assets/js/app.js') }}"></script>
</body>
</html>
