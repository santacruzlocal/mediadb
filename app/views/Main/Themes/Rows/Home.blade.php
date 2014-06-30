@extends('Main.Boilerplate')

@section('styles')
      {{ HTML::style('assets/css/flexslider.css') }}
      {{ HTML::style('assets/css/prettyPhoto.css') }}
@stop

@section('scripts')
		<script src="assets/js/jquery.prettyPhoto.js"></script>
		<script src="assets/js/jquery.flexslider.js"></script>
    <script>
    !function(d,s,id){
      var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
      if(!d.getElementById(id)){
        js=d.createElement(s);
        js.id=id;
        js.src=p+"://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js,fjs);
        }}
        (document,"script","twitter-wjs");
    </script>
		<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });

});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });
});

</script>
@stop
@section('content')

    <div class="row headline"><!--Begin Headline-->
<!--Slider Carousel-->
        <div class="span8">
            <div class="flexslider">
              <ul class="slides">

              <!--Slide 1-->
			             <li>
			             <div class="row">
									 @foreach($series->slice(0, 4) as $k => $series)
			             <div class="span2">
	              <a href="{{ Helpers::url($series['title'], $series['id'], $series['type']) }}">
	                <img src="{{{ asset($series['poster']) }}}" class="img-responsive thumbnail" alt="{{ 'Poster of ' . $series['title'] }}">
	              </a>
	              <figcaption>
	                <a href="{{ Helpers::url($series['title'], $series['id'], $series['type']) }}">{{{ $series['title'] }}}</a> <br>
	              </figcaption>
	            </div>
	            @endforeach
	            </div>
	            </li>
                            <!--Slide 1-->
                   <li>
                   <div class="row">
                   @foreach($tv->slice(0, 4) as $k => $series)
                   <div class="span2">
                <a href="{{ Helpers::url($series['title'], $series['id'], $series['type']) }}">
                  <img src="{{{ asset($series['poster']) }}}" class="img-responsive thumbnail" alt="{{ 'Poster of ' . $series['title'] }}">
                </a>
                <figcaption>
                  <a href="{{ Helpers::url($series['title'], $series['id'], $series['type']) }}">{{{ $series['title'] }}}</a> <br>
                </figcaption>
              </div>
              @endforeach
              </div>
              </li>

              <!--Slide 2-->
			             <li>
			             <div class="row">
									 @foreach($tv->slice(4, 4) as $k => $movie)
			             <div class="span2">
	              <a href="{{ Helpers::url($movie['title'], $movie['id'], $movie['type']) }}">
	                <img src="{{{ asset($movie['poster']) }}}" class="img-responsive thumbnail" alt="{{ 'Poster of ' . $movie['title'] }}">
	              </a>
	              <figcaption>
	                <a href="{{ Helpers::url($movie['title'], $movie['id'], $movie['type']) }}">{{{ $movie['title'] }}}</a> <br>
	              </figcaption>
	            </div>
	            @endforeach
	            </div>
	            </li>

              </ul>
            </div>
        </div>

        {{--Headline Text--}}
        <div class="span4">
        {{ trans('main.headline') }}
        </div>
    </div>
    {{-- End Headline --}}

<div class="row">{{--Container row--}}
  <div class="span8">{{--Begin page content column--}}

    <div class="row">

      <div class="span4">
        <h4> {{ trans('main.smart search') }} <small> {{ trans('main.search header') }}</small></h4>
      </div>

{{--Search--}}
      <div class="span4 input-append">
        <section>
            {{ Form::open(array('url' => Str::slug(trans('main.search')), 'method' => 'GET')) }}
            {{ Form::text('q', null, array('id' => 'auto-complete', 'class' => 'form-control search-bar', 'placeholder' => trans('main.search placeholder'), 'data-url' => url('typeahead'))) }}
            <!-- <span class="input-group-btn search-btn-ie-fix" title="GO!"> -->
            <button class="btn btn-normal" type="submit"><i class="icon-search"></i></button>
            {{ Form::close() }}
          </section>
        </div>
      </div>
{{--End Search--}}

            <p class="lead">Our new Smart Search functions give you more accurate results faster. Maybe you are thinking "why does that matter?", well it's simple. Our databases are huge and using old outdated search systems would make it nearly imposible to find anything in a reasonable amount of time. Now as soon as you start typing we can use our blazing fast smart search tools to start looking for that movie or tv show, and in most cases find it before you finnish typing in the title.</p>

{{--in theaters now begins--}}

            <h5 class="title-bg"> {{ trans('main.in theaters') }}

            @if (Helpers::hasAccess('titles.update'))
              {{ Form::open(array('route' => 'titles.updatePlaying', 'class' => 'pull-right in-heading-form')) }}
                <button type="submit" class="btn btn-mini btn-warning"><i class="icon-repeat"></i> {{ trans('dash.update') }}</button>
              {{ Form::close() }}
            @endif

            </h5>

          <div class="row">

            @foreach($playing->slice(0, 4) as $k => $movie)
            <div class="span2">
              <figure>
                <a href="{{ Helpers::url($movie['title'], $movie['id'], $movie['type']) }}">
                  <img src="{{{ asset($movie['poster']) }}}" class="img-responsive thumbnail" alt="{{ 'Poster of ' . $movie['title'] }}">
                </a>

                <figcaption>
                  <a href="{{ Helpers::url($movie['title'], $movie['id'], $movie['type']) }}">{{{ $movie['title'] }}}</a> <br>
                </figcaption>
              </figure>
            </div>
            @endforeach
          </div>
          <div class="row">
            @foreach($playing->slice(4, 4) as $p => $moviez)
            <div class="span2">
              <figure>
                <a href="{{ Helpers::url($moviez['title'], $moviez['id'], $moviez['type']) }}">
                  <img src="{{{ asset($moviez['poster']) }}}" class="img-responsive thumbnail" alt="{{ 'Poster of ' . $moviez['title'] }}">
                </a>

                <figcaption>
                  <a href="{{ Helpers::url($moviez['title'], $moviez['id'], $moviez['type']) }}">{{{ $moviez['title'] }}}</a> <br>
                </figcaption>
              </figure>
            </div>
            @endforeach

            </div>
            <div class="row">
            @foreach($playing->slice(8, 2) as $p => $moviez)
            <div class="span2">
              <figure>
                <a href="{{ Helpers::url($moviez['title'], $moviez['id'], $moviez['type']) }}">
                  <img src="{{{ asset($moviez['poster']) }}}" class="img-responsive thumbnail" alt="{{ 'Poster of ' . $moviez['title'] }}">
                </a>

                <figcaption>
                  <a href="{{ Helpers::url($moviez['title'], $moviez['id'], $moviez['type']) }}">{{{ $moviez['title'] }}}</a> <br>
                </figcaption>
              </figure>
            </div>
            @endforeach

            </div>

            <h6 class="title-bg"> This is a sub head divider</h6>

            <div class="clearfix">
                <img src="assets/images/gallery/gallery-img-1-4col.jpg" class="thumbnail align-left" alt="Image" />
                <p>Vivamus augue nulla, vestibulum ac ultrices posuere, vehicula ac arcu. Quisque nisi lacus, bibendum quis commodo eget, lobortis eget elit. Cras venenatis mauris eu tortor consequat a convallis nulla molestie. Phasellus malesuada malesuada velit et fermentum. Proin ut leo nec mauris pulvinar volutpat. Sed ac neque nec leo condimentum rhoncus.</p>
                <p>Quisque nisi lacus, bibendum quis commodo eget, lobortis eget elit. Cras venenatis mauris eu tortor consequat a convallis nulla molestie.</p>
                <button class="btn btn-small btn-inverse" type="button">Visit Website</button>
            </div>

            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Heads up!</strong> This alert is not super important.
            </div>

            <p>Vivamus augue nulla, vestibulum ac ultrices posuere, vehicula ac arcu. Quisque nisi lacus, bibendum quis commodo eget, lobortis eget elit. Cras venenatis mauris eu tortor consequat a convallis nulla molestie. Phasellus malesuada malesuada velit et fermentum. Proin ut leo nec mauris pulvinar volutpat. Sed ac neque nec leo condimentum rhoncus. Quisque nisi lacus, bibendum quis commodo eget, lobortis eget elit. Cras venenatis mauris eu tortor consequat a convallis nulla molestie.</p>

        </div> <!--End page content column-->

  @section('right-bar')

    @include('Partials.Sidebar-Right')

  @show

    </div><!-- End container row -->
@stop
