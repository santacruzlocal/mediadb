<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
@section('htmltag')
  <html>
@show

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    @section('title')

      <title>{{ trans('main.meta title') }}</title>

    @show

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @section('assets')

      <link rel="shortcut icon" href="{{{ asset('assets/images/icon/favicon.ico') }}}">
      <link rel="apple-touch-icon" href="{{{ asset('assets/images/icon/apple-touch-icon.png') }}}">
      <link rel="apple-touch-icon" sizes="72x72" href="{{{ asset('assets/images/icon/apple-touch-icon-72x72.png') }}}">
      <link rel="apple-touch-icon" sizes="114x114" href="{{{ asset('assets/images/icon/apple-touch-icon-114x114.png') }}}">

      <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Cantora+One' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Quando' rel='stylesheet' type='text/css'>

      {{ HTML::style('assets/css/bootstrap.css') }}
      {{ HTML::style('assets/css/bootstrap-responsive.css') }}
      {{ HTML::style('assets/css/jquery.lightbox-0.5.css') }}
      {{ HTML::style('assets/css/custom-styles.css') }}
      {{ HTML::style('assets/css/main.css') }}
      @yield('styles')

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="assets/css/style-ie.css"/>
    <![endif]-->

      <script src="http://code.jquery.com/jquery-latest.js"></script>
      <script data-rocketsrc="http://code.jquery.com/jquery-1.8.3.min.js" type="text/rocketscript" ></script>
      {{ HTML::script('assets/js/bootstrap.js') }}
      {{ HTML::script('assets/js/jquery.custom.js') }}
      {{ HTML::script('assets/js/scripts.js') }}
      @yield('scripts')


    @show

  </head>

    <body>

    <div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    <div class="container main-container"><!-- Start Container -->

  @section('header')

    @include('Partials.Header')

  @show


  @yield('content')


    </div> <!-- End Container -->

  @section('footer')<!--Start Footer-->

    @include('Partials.Footer')<

  @show<!--End Footer-->


  <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>
<!--Start Analytics-->
  @if ($options->getAnalytics())
    {{ $options->getAnalytics() }}
  @endif
<!--End Analytics-->
  </body>
</html>
