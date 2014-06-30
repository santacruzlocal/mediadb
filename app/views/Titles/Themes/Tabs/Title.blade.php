@extends('Main.Boilerplate')

@section('title')
  <title>{{{ $data->getTitle() }}} - {{ trans('main.brand') }}</title>
@stop

@section('assets')

  @parent
  
  <meta name="title" content="{{{ $data->getTitle() . ' - ' . trans('main.brand') }}}">
  <meta name="description" content="{{{ $data->getPlot() }}}">
  <meta name="keywords" content="{{ trans('main.meta title keywords') }}">
  <meta property="og:title" content="{{{ $data->getTitle() . ' - ' . trans('main.brand') }}}"/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:site_name" content="{{ trans('main.brand') }}"/>
  <meta property="og:image" content="{{str_replace('w342', 'original', asset($data->getPoster()))}}"/>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@{{ trans('main.brand') }}">
  <meta name="twitter:title" content="{{ $data->getTitle() }}">
  <meta name="twitter:description" content="{{ $data->getPlot() }}">
  <meta name="twitter:image" content="{{ $data->getPoster() }}">

@stop

@section('bodytag')
  <body class="nav-trans animate-nav title-page tabs-title" data-url="{{ url() }}">
@stop

@section('content')

  @include('Titles.Partials.Jumbotron')

  <section class="container push-footer-wrapper">

    <div class="yt-modal-box"></div> 
    
    <div class="row ads-row">
      @if($ad = $options->getTitleJumboAd())
        {{ $ad }}
      @endif
    </div>
    
    <div class="row responses"> @include('Partials.Response') </div>

    <div class="tab-content">
      <div class="tab-pane fade in active" id="description">
        @include('Titles.Themes.Tabs.Description')
      </div>

      <div class="tab-pane fade" id="cast">
        @include('Titles.Themes.Tabs.Cast')
      </div>

      <div class="tab-pane fade" id="reviews">
        @include('Titles.Themes.Tabs.Reviews')
      </div>

      <div class="tab-pane fade" id="similar">
        @include('Titles.Themes.Tabs.Similar')
      </div>
    </div>

    @if (isset($disqus))

      <section class="disqus row">
        <div class="bordered-heading"><span style="border-color:{{$options->getColor('warning')}};color:{{$options->getColor('warning')}}" class="text-border-top"><i class="fa fa-comments"></i> {{ trans('main.comments') }}</div>
        <div id="disqus_thread"></div>
      </section>

      @include('Titles.Partials.Disqus')

    @endif
  <div class="push"></div>
  </section>{{--container--}}

<div class="modal fade animated fadeInBig" id="img-modal">
  <div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div></div></div>
</div>


@section('scripts')

<script>

(function ($){

  $('#imdb-rate').raty({
    readOnly: true, 
    score: '{{ $data->getImdbRating() }}', 
    path: '../assets/images',
    halfShow : true,
    number: 10,
    width: 260,
  });

  $('#mc-user-rate').raty({
    readOnly: true, 
    score: '{{ $data->getMcUserRate() }}', 
    path: '../assets/images',
    halfShow : true,
    number: 10,
    width: 260,
  });

  $('#tmdb-rate').raty({
    readOnly: true, 
    score: '{{ $data->getTmdbRating() }}', 
    path: '../assets/images',
    halfShow : true,
    number: 10,
    width: 260,
  });

   $('#mc-critic-rate').raty({
    readOnly: true, 
    score: '{{ $data->getMcCriticRate("convert") }}', 
    path: '../assets/images',
    halfShow : true,
    number: 10,
    width: 260,
  });

})(jQuery);

   //add 0 comments to jumbotron if not already there.
  (function ($){
   
    if ( ! $('.disqus-link').text().trim().length)
    {
      $(".disqus-link").text('0 {{ trans("main.comments") }}');
    }

  })(jQuery);

</script>

@stop

<noscript>{{ trans('main.enable js') }}</noscript>
    
@stop


  

