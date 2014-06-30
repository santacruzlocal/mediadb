<section class="row images-row">

     @if ($data->getImages())

     	<div id="links">

         @foreach(array_slice($data->getImages(), 0, 6) as $k => $img)
    
          <a href="{{ asset(Helpers::original($img)) }}" class="col-sm-2 col-xs-6 image-col" data-gallery>
            <img src="{{{ Helpers::thumb($img) }}}" data-num="{{ $k }}" data-original="{{ Helpers::original(asset($img)) }}" alt="{{ 'Still of ' . $data->getTitle() }}" class="img-responsive pull-left thumb lightbox">
          </a>
        
         @endforeach

        </div>

        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" >
	        <div class="slides"></div>
	        <h3 class="title"></h3>
	        <a class="prev">‹</a>
	        <a class="next">›</a>
	        <a class="close">×</a>
	        <a class="play-pause"></a>
	        <ol class="indicator"></ol>
	    </div>

     @endif

    

</section>

<section class="row">
	<div class="col-sm-6">

		@if ($data->getTagline())
			<h3>{{{ $data->getTagline() }}}</h3>
		@endif

		@if ($data->getPlot())
			<p>{{{ $data->getPlot() }}}</p>
		@endif

		@if ($data->getAwards())

		<p class="row well actor-awards" style="background-color:{{ $data->getJumboMenuColor() }}">
    		<i class="fa fa-trophy"></i> 
       		{{{ $data->getAwards() }}}
       	</p>

		@endif

		@if ($custom = $data->getCustomField())
			<p>{{ $custom }} </p>
		@endif
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-5">

		<h3>{{ trans('main.details') }}</h3>

		<dl class="dl-horizontal title-desc-crew">
				
			<div class="title-dt-group">
				@if ($directors = $data->getDirectors())

					<dt>{{ trans('main.directors') }}:</dt>
			  		<dd>
				  		@foreach($directors as $d)
							{{{ $d['name'] }}},
				  		@endforeach
			  		</dd>

				@endif
			</div>

			<div class="title-dt-group">
				@if ($writers = $data->getWriters())

					<dt>{{ trans('main.writing') }}:</dt>
			  		<dd>
				  		@foreach($writers as $w)
							{{{ $w['name'] }}},
				  		@endforeach
			  		</dd>


				@endif
			</div>

			<div class="title-dt-group">
				@if ($stars = array_slice($data->getCast(), 0, 3))

					<dt>{{ trans('main.stars') }}:</dt>
			  		<dd>
				  		@foreach($stars as $s)
							<a href="{{ Helpers::url($s['name'], $s['id'], 'people') }}">{{{ $s['name'] }}}</a>,
				  		@endforeach
			  		</dd>

				@endif
		  	</div>

			@if ($country = $data->getCountry())
		  		<div class="title-dt-group">
					<dt>{{ trans('main.country') }}:</dt>
			  		<dd>{{{ $country }}}</dd>				
		  		</div>
		  	@endif

		  	@if ($language = $data->getLanguage())
		  		<div class="title-dt-group">
					<dt>{{ trans('main.lang') }}:</dt>
			  		<dd>{{{ $language }}}</dd>				
		  		</div>
		  	@endif

		  	@if ($data->getRating())

				<h3>{{ trans('main.ratings') }}</h3>

		  	@endif

		  	<div class="title-ratings">
				@if ($imdb = $data->getImdbRating())
					<dt>IMDb {{ trans('main.rating') }}:</dt>			
					<dd id="imdb-rate"><strong class="pull-right">({{ $imdb }}/10)</strong></dd>
				@endif			
		  	</div>

			<div class="title-ratings">
			  	@if ($mcUser = $data->getMcUserRate())
					<dt>Metacritic {{ trans('main.user') }}:</dt>			
					<dd id="mc-user-rate"><strong class="pull-right">({{ $mcUser }}/10)</strong></dd>
				@endif
			</div>

			<div class="title-ratings">
			  	@if ($mcCritic = $data->getMcCriticRate())
					<dt>Metacritic {{ trans('main.critic') }}:</dt>			
					<dd id="mc-critic-rate"><strong class="pull-right">({{ $mcCritic }}/10)</strong></dd>
				@endif
				<div class="raty"></div>
			</div>

			<div class="title-ratings">
			  	@if ($data->getTmdbRating() && Carbon\Carbon::parse($data->getReleaseDate()) < Carbon\Carbon::now()->toDateString())
					<dt>TMDB {{ trans('main.rating') }}:</dt>			
					<dd id="tmdb-rate"><strong class="pull-right">({{ $data->getTmdbRating() }}/10)</strong></dd>
				@endif
			</div>

			@if ($data->getBudget() || $data->getRevenue())
				<h3>{{ trans('main.box office') }}</h3>
			@endif
			
			@if ($budget = $data->getBudget())
				<div class="title-ratings">		  	
					<dt>{{ trans('main.budget') }}:</dt>			
					<dd>{{ $budget }}</dd>				
				</div>
			@endif

			@if ($revenue = $data->getRevenue())
				<div class="title-ratings">		  	
					<dt>{{ trans('main.revenue') }}:</dt>			
					<dd>{{ $revenue }}</dd>				
				</div>
			@endif

		</dl>

	</div>
</section>