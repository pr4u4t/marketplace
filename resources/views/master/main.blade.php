<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/app.css">


    @hasSection('title')
        <title>{{config('app.name')}} - @yield('title')</title>
    @else
        <title>{{config('app.name')}}</title>
    @endif

</head>
<body class="@isroute('home') home @endisroute">
@include('master.navbar')
<div class="pt-4" id="top-jump"></div>

@if (Auth::check())
    <div class="col-md-7 col-sm-12 mt-3" style="margin-right:auto; margin-left:auto;">
        @include('includes.jswarning')
    </div>
@endif

@isroute('home')
    @include('master.carousel')
@endisroute

@isroute('home')
    @include('master.search')
@endisroute

@hasSection('container-fluid')
    <div class="container-fluid">
@else
    <div class="container">
@endif
        <div class="mt-4">
            @yield('content')
        </div>
</div>
@unless(Request::is('signin','signup','signup/*'))
    <div id="top-jumper" style="position:fixed; bottom:5em; right:1em; transform:rotate(180deg)"><a href="#top-jump"><i class="fa fa-angle-down"></i></a></div>
@endunless

@include('master.footer')
</body>
</html>
