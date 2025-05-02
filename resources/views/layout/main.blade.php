<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('partials.header')

                <div class="main-navbar">
                    @include('partials.sidebar')
                </div>

<div class="main-wrapper main-wrapper-1">
  @yield('content')
</div>

@include('partials.footer')
