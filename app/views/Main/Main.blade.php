<!DOCTYPE html>
<html lang="en">
@section('htmltag')
  <html>
@show

  <head>

    @section('title')

      <title>{{ trans('main.meta title') }}</title>

    @show

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @section('assets')

      <link rel="shortcut icon" href="{{{ asset('assets/images/favicon.ico') }}}">
      <link rel="shortcut icon" href="{{{ asset('assets/images/apple-touch-icon.png') }}}">
      <link rel="shortcut icon" href="{{{ asset('assets/images/apple-touch-icon-72x72.png') }}}">
      <link rel="shortcut icon" href="{{{ asset('assets/images/apple-touch-icon-114x114.png') }}}">
      <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Cantora+One' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Quando' rel='stylesheet' type='text/css'>

      {{ HTML::style('assets/css/styles.min.css') }}
      {{ HTML::style('assets/css/bootstrap.css') }}
      {{ HTML::style('assets/css/bootstrap-responsive.css') }}
      {{ HTML::style('assets/css/jquery.lightbox-0.5.css') }}
      {{ HTML::style('assets/css/bootstrap-theme.css') }}
      {{ HTML::style('assets/css/main.css') }}
      {{ HTML::style('assets/css/foundation.css') }}
      {{ HTML::style('assets/css/bff.css') }}
      {{ HTML::style('assets/css/jquery.ui.min.css') }}
      {{ HTML::style('assets/css/rust.css') }}

      {{ HTML::script('assets/js/bootstrap.js') }}
      {{ HTML::script('assets/js/foundation.js') }}
      {{ HTML::script('assets/jquery-2.10.min.js') }}
      {{ HTML::script('assets/js/jquery.js') }}
      {{ HTML::script('assets/js/bff.js') }}

    @show

  </head>


  @section('bodytag')

    <body>

  @show

  @section('nav')

    @include('Partials.Navbar')

  @show

  @yield('content')

  @section('ads')

  @if($ad = $options->getFooterAd())

    <div class="row ads-row">{{ $ad }}</div>

  @endif



  @show

  <footer style="border-color:{{$options->getColor('warning')}}">
    <div class="col-sm-4"> {{ trans('main.copyright') }} &#169; <span class="brand">{{ trans('main.brand') }}</span>{{ Carbon\Carbon::now()->year }}</div>

    <section class="col-sm-6 hidden-xs">
      <a href="{{ route('privacy') }}">{{ trans('main.privacy') }}</a> |
      <a href="{{ route('tos') }}">{{ trans('main.tos') }}</a> |
      <a href="{{ route('contact') }}">{{ trans('main.contact') }}</a>
    </section>
   <div class="col-sm-2 home-social hidden-xs hidden-sm">

     <div id="twitter" data-url="{{ url() }}" data-text='{{ trans("main.meta description") }}' data-title="<i class='fa fa-twitter'></i>"></div>
     <div id="facebook" data-url="{{ url() }}" data-text='{{ trans("main.meta description") }}' data-title="<i class='fa fa-facebook'></i>"></div>
     <div id="pinterest" data-url="{{ url() }}" data-text='{{ trans("main.meta description") }}' data-title="<i class='fa fa-pinterest'></i>"></div>
     <div id="linkedin" data-url="{{ url() }}" data-text='{{ trans("main.meta description") }}' data-title="<i class='fa fa-linkedin'></i>"></div>

   </div>
 </footer>
 {{ HTML::script('assets/js/scripts.js') }}

  @yield('scripts')

  @if ($options->getAnalytics())
    {{ $options->getAnalytics() }}
  @endif

  </body>
</html>
