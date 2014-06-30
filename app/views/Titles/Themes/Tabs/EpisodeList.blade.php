@if ( ! $data->getSeasons($num)->episode->isEmpty())

@foreach($data->getSeasons($num)->episode as $k => $v)

		<div class="media col-sm-12">
			<div class="pull-left col-sm-3">
			
				<img src="{{{ $v->poster ? asset($v->poster) : asset($data->getPoster()) }}}" alt="{{ 'Poster of ' . $v->title }}" class="media-object img-responsive thumb">

			</div>
		
			<div class="media-body col-sm-9">

		    	<h4 class="media-heading">{{ trans('main.episode') }} {{{ $v->episode_number }}} - {{ $v->title }}</h4>
		    	<p>{{ $v->plot }}</p>

				@if ($v->promo)

					<button class="promo-trigger btn btn-warning" data-trailer="{{ $v['promo'] }}" data-toggle="modal">
					  <i class="fa fa-play"></i> {{ trans('main.watch promo') }}
					</button>

					<div id="promo-modal-box"></div>


				@endif

		    	<p>
		      		@if (Helpers::hasAccess('titles.delete'))
						
  							{{ Form::open(array('url' => Str::slug(trans('main.series')) . '/' . $data->getId() . "/seasons/$num/episodes/{$v->id}", 'method' => 'delete', 'class' => 'delete-form')) }}

  							  <button type="submit" title="{{ trans('main.delete') }}" class="btn btn-danger-drk"><i class="fa fa-trash-o"></i> {{ trans('main.delete ep') }}</button>

  							{{ Form::close() }}

			  	  	@endif

						@if (Helpers::hasAccess('titles.edit'))

							@include('Titles.Partials.EditEpisodeModal')

						@endif

		    	</p>
			
		    	<span class="row grey-out">{{ trans('main.release date') }}: {{{ $v->release_date }}} </span>
			</div>{{--media-body--}}
		</div>{{--media--}}
	<hr>
@endforeach

@else
	<div><h3 class="reviews-not-released"><i class="fa fa-exclamation-triangle"></i> {{ trans('main.no episodes') }}</h3></div>
@endif