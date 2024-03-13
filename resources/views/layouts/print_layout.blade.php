<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    @if($printer == 1)
    <link class="js-stylesheet" href="{{ asset('/assets/css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet">
    @endif
    @if($printer == 2)
    <link href="{{ asset('/assets/css/print.css') }}" rel="stylesheet">
    @endif
</head>
<body>
    {{$slot}}
</body>
</html>