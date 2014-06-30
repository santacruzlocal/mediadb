<?php

use Carbon\Carbon;

class Title extends Eloquent
{
    /**
     * Cacher instance.
     *
     * @var Lib\Services\Cache\Cacher
     */
    private $cache;

    /**
     * Options instace.
     *
     * @var Lib\Services\Options\Options
     */
    private $options;

    public function __construct()
    {
        $this->cache = App::make('Lib\Services\Cache\Cacher');
        $this->options = App::make('Options');
    }

    /**
     * Format genre so it can be used as a filter for grid.
     *
     * @param  string $value
     * @return string
     */
    public function getGenreAttribute($value)
    {
       $genre = str_replace(',', ' | ', $value);

       return trim($genre, ' | ');
    }

     /**
     * Returns default image if title doesnt have poster.
     *
     * @param  string $value
     * @return string
     */
    public function getPosterAttribute($value)
    {
        if ( ! $value)
        {
            return 'assets/images/imdbnoimage.jpg';
        }

        if ( ! str_contains($value, 'http') && ! str_contains($value, 'imdb'))
        {
            return "imdb/posters/$value";
        }

        return $value;
    }

    /**
     * Formats release date before returning.
     *
     * @param  string $value
     * @return string
     */
    public function getReleaseDateAttribute($value)
    {
        //format release date if not already formatted
        if ( ! preg_match('/[a-z]|[A-Z]|-/', $value) && strlen($value) > 4)
        {
            return Carbon::createFromFormat('Y-m-d', $value)->toFormattedDateString();
        }

        return $value;
    }

    public function actor()
    {
        return $this->belongsToMany('Actor', 'actors_titles')->withPivot('known_for', 'char_name', 'id');

    }

    public function user()
    {
        return $this->belongsToMany('User', 'users_titles')->withPivot('favorite', 'watchlist');
    }

    public function image()
    {
        return $this->hasMany('Image')->orderBy('created_at', 'asc');
    }

    public function director()
    {
       return $this->belongsToMany('Director', 'directors_titles');
    }

    public function writer()
    {
       return $this->belongsToMany('Writer', 'writers_titles');
    }

    public function review()
    {
       return $this->hasMany('Review');
    }

    public function season()
    {
        return $this->hasMany('Season');
    }

    /** *  *  *  Movies  *  *  *
     * Gets Featured movies
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeFeatured($query)
    {
        $fet = $query->where('featured', 1)->limit(8)->orderBy('created_at', 'desc')->get();

        if ($this->options->getDataProvider() == 'db' || ! $this->options->autoUpdateData())
        {
           return $fet;
        }

        if ($fet->isEmpty() || $fet->first()->updated_at->addDay() <= Carbon::now())
        {
            $fet = $this->updateFeatured();
        }

        return $fet;
    }

    /** *  *  *  Movies  *  *  *
     * Gets movies that are now playing in theaters.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeNowPlaying($query)
    {
        $order = Helpers::getOrdering();
        $playing = $query->where('now_playing', 1)->limit(10)->orderBy($order, 'desc')->get();

        if ($this->options->getDataProvider() == 'db' || ! $this->options->autoUpdateData())
        {
            return $playing;
        }

        if ($playing->isEmpty() || $playing->first()->updated_at->addDays(2) <= Carbon::now())
        {
            $playing = $this->updatePlaying($order);
        }

        return $playing;
    }

    /** *  *  *  Movies  *  *  *
     * Gets latest Movie title.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  Int $id
     * @return collection
     */
    public function scopeLatest($query)
    {
        return $query->where('poster', '>', 0)
                     ->where('fully_scraped', '=', 1)
                     ->where('release_date', '<', Carbon::now()->toDateString())
                     ->has('review', '>', 5)
                     ->orderBy('year', 'desc')
                     ->limit(1)
                     ->with('Review')
                     ->first();
    }

     /** *  *  *  Series  *  *  *
     * Gets titles for series on main page list
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeTvIndex($query)
    {
        return $query->where('type', '=', 'series')
                     ->where('poster', '>', 0)
                     ->orderBy('release_date', 'desc')
                     ->limit(10)
                     ->get();
    }

    /** *  *  *  Series  *  *  *
     * Gets Top IMDB rated  TV Series
     * Limit of 8
     * For Slider
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeTv($query)
    {
        return $query->where('type', '=', 'series')
                     ->where('poster', '>', 0)
                     ->where('imdb_rating', '>', 8)
                     ->orderBy('imdb_rating', 'desc')
                     ->limit(8)
                     ->get();
    }

    /**
     * Fetches title with relations by id.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  Int $id
     * @return collection
     */
    public function scopeById($query, $id)
    {
        return $query->with('Actor', 'Image', 'Director', 'Writer', 'Review', 'Season')->findOrFail($id);
    }

    /**
     * Performs like query by user specified search term.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  string $q
     * @return collection
     */
    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'LIKE', $q)
                     ->select('id', 'imdb_id', 'tmdb_id', 'title', 'poster', 'type')
                     ->groupBy('title')
                     ->orderBy(Helpers::getOrdering(), 'desc')
                     ->get();
    }

     /**
     * Fetches all titles matching $id.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  Int $id
     * @return collection
     */
    public function scopeByTempId($query, $id, $order = null)
    {
        if ($order)
        {
            return $query->where('temp_id', '=', $id)->orderBy($order, 'desc')->get();
        }

        return $query->where('temp_id', '=', $id)->get();
    }

    /** *  *  *  Series  *  *  *
     * Fetches all information about series.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeSeries($query, $id)
    {
        return $query->where('id', '=', $id)->with('Season.Episode')->first();
    }

    /**
     * Fetches all upcoming titles.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeUpcoming($query)
    {
        return $query->where('release_date', '>', Carbon::now()->toDateString())->limit(6)->get();
    }

    /**
     * Returns paginated titles for movie page index.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeMovieIndex($query, $perPage = 36)
    {
        return $query->where('type', '=', 'movie')
                     ->orderBy(Helpers::getOrdering(), 'desc')
                     ->paginate($perPage);
    }

     /** *  *  *  Series  *  *  *
     * Returns paginated titles for series page index.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return collection
     */
    public function scopeSeriesIndex($query, $perPage = 36)
    {
        return $query->where('type', '=', 'series')
                     ->orderBy(Helpers::getOrdering(), 'desc')
                     ->paginate($perPage);
    }

    /**
     * Updates featured movies from external sources.
     *
     * @return Collection
     */
    public function updateFeatured()
    {
        $s = App::make('Lib\Services\Scraping\Scraper');
        $s->featured();

        $fet = $this->where('featured', 1)->limit(8)->orderBy('created_at', 'asc')->get();

        return $fet;
    }

    /**
     * Updates Now Playing movies from external sources.
     *
     * @return Collection
     */
    public function updatePlaying($order = 'created_at')
    {
        $s = App::make('Lib\Services\Scraping\Scraper');
        $s->updateNowPlaying();

        $playing = $this->where('now_playing', 1)->limit(10)->orderBy($order, 'desc')->get();

        return $playing;
    }

    /**
     * Updates titles information from tmdb or imdb.
     *
     * @return void
     */
    public function updateFromExternal()
    {
        $title = App::make('Lib\Repository\Title\TitleRepositoryInterface');
        $title->getCompleteTitle($this);

        return true;
    }


}

