@extends('Main.Boilerplate')

@section('title')
	<title>{{ trans('main.overview of') }} '{{{ $data->getTitle() }}}' {{ trans_choice('main.season', 1) }} {{{ $num }}} - {{ trans('main.brand') }}</title>
@stop

@section('bodytag')
  <body class="nav-trans animate-nav title-page" id="episodes-page">
@stop

@section('content')

	@if ($options->getTitleView() == 'NoTabs')
    @include('Titles.Themes.NoTabs.Jumbotron')
  @else
    @include('Titles.Partials.Jumbotron')
  @endif
  
<div class="container push-footer-wrapper">

<div class="yt-modal-box"></div>

  @if (Helpers::hasAccess('titles.create') && $options->getTitleView() == 'NoTabs')

    <a class="btn btn-success pull-right" href='{{ url("series/" . $data->getId() . "/seasons/$num/episodes/create") }}'>{{ trans('main.create new epi') }}</a>

  @endif

	<br>
  <div class="row" id="responses"> @include('Partials.Response') </div>

    <div class="tab-content">
       <div class="tab-pane fade in active" id="episodes">
        @include('Titles.Themes.Tabs.EpisodeList')
      </div>

      <div class="tab-pane fade" id="description">
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
</div>{{--container--}}


@section('scripts')

<script>
  
 (function( $ ){

  $(".edit-episode").submit(function(e)
  {
    e.preventDefault();

    var url = $(this).attr('action');

    $.ajax(
    {
      url: url,
      type: "POST",
      datatype: "json",
      data: $(this).serialize(),
      beforeSend: function()
      {
        $('#ajax-loading').show();
      }
    })
    .done(function(data)
    {
      if (data == 'success')
      {
        $('.edit-season-modal').modal('hide')

        $('#responses').html('<div class="alert alert-success alert-dismissable">{{ trans("main.ajax edit episode success") }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>') 
      }
      else
      {
        $('#modal-response').html('<div class="alert alert-danger alert-dismissable">' + data + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>') 
      }

      $('#ajax-loading').hide();      
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        $('#ajax-loading').hide();
        alert('Something went wrong on our end, sorry.');
    });

    return false;
    
  });

})( jQuery );

</script>

@stop

@stop