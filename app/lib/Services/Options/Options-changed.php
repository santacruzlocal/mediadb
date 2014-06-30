<?php namespace Lib\Services\Options;

class Options
{
	/**
	 * Site Preferences.
	 *
	 * @var array
	 */
	public $options;

	/**
	 * Initiate new options instance.
	 *
	 * @param mixed $options
	 */
	public function __construct($options = null)
	{
		if ($options)
		{
			$this->options = $options;
		}



		//set data provider defaults if nothing passed
		else
		{
			$this->options['data_provider'] = 'imdb';
			$this->options['search_provider'] = 'imdb';
		}
	}


/** *  *  *  New Admin Options (June 2014) *  *  *  */

	/**
	 * Returns title critic reviews ad.
	 *
	 * @return string
	 */
	public function getTitleCriticAd()
	{
		if (isset($this->options['ad_title_critic']))
		{
			return $this->options['ad_title_critic'];
		}
	}

	/**
	 * Return home page sidebar LoginTabs
	 *
	 * @return boolean
	 */
	public function getLoginTabsView()
	{
		if ( array_key_exists('LoginTabs', $this->options) )
		{
			return (int) $this->options['LoginTabs'];
		}

		return true;
	}

	/**
	 * Returns whether or not to save images locally from tmdb.
	 *
	 * @return boolean
	 */
	public function getTwitterView()
	{
		if ( array_key_exists('twitter_view', $this->options) )
		{
			return (int) $this->options['twitter_view'];
		}

		return true;
	}

/** *  *  *  Original Options Start Here  *  *  *  */

	/**
	 * Return data provider.
	 *
	 * @return string
	 */
	public function getDataProvider()
	{
		return isset($this->options['data_provider']) ? $this->options['data_provider'] : 'imdb';
	}

	/**
	 * Return contact email
	 *
	 * @return string
	 */
	public function getContactEmail()
	{
		if (isset($this->options['contact_us_email']))
		{
			return $this->options['contact_us_email'];
		}
	}

	/**
	 * Return color scheme.
	 *
	 * @return string
	 */
	public function getColorScheme()
	{
		if (isset($this->options['color_scheme']))
		{
			return $this->options['color_scheme'];
		}

		return 'green';
	}

	/**
	 * Return titles tabs view
	 *
	 * @return string
	 */
	public function getTitleView()
	{
		if (isset($this->options['title_view']) && $this->options['title_view'])
		{
			return $this->options['title_view'];
		}

		return 'Tabs';
	}

	/**
	 * Return home page colums/rows view
	 *
	 * @return string
	 */
	public function getHomeView()
	{
		if (isset($this->options['home_view']) && $this->options['home_view'])
		{
			return $this->options['home_view'];
		}

		return 'Columns';
	}

	/**
	 * Return search provider.
	 *
	 * @return string
	 */
	public function getSearchProvider()
	{
		return isset($this->options['search_provider']) ? $this->options['search_provider'] : 'imdb';
	}

	/**
	 * Return tmdb api key.
	 *
	 * @return mixed
	 */
	public function getTmdbKey()
	{
		if (isset($this->options['tmdb_api_key']) && $this->options['tmdb_api_key'])
		{
			return $this->options['tmdb_api_key'];
		}
	}

	/**
	 * Returns all options.
	 *
	 * @return array
	 */
	public function getAll()
	{
		return $this->options;
	}

	/**
	 * Returns requested backgrounds url.
	 *
	 * @param  string $name
	 * @return string
	 */
	public function getBg($name = 'home')
	{
		if ( isset($this->options[$name . '_bg']) && $this->options[$name . '_bg'])
		{
			return $this->options[$name . '_bg'];
		}

		return asset('assets/images/arrow.jpg'); // default bg image
	}

	/**
	 * Returns amazon affiliate id
	 *
	 * TODO: Set default id
	 * @return mixed
	 */
	public function getAmazonId()
	{
		if ( isset($this->options['amazon_id']) && $this->options['amazon_id'])
		{
			return $this->options['amazon_id'];
		}

		return null;
	}

	/**
	 * Returns uri separator.
	 *
	 * @return string
	 */
	public function getUriSeparator()
	{
		if ( isset($this->options['uri_separator']) && $this->options['uri_separator'])
		{
			return $this->options['uri_separator'];
		}

		return '-';
	}

	/**
	 * Returns uri case.
	 *
	 * @return string
	 */
	public function getUriCase()
	{
		if ( isset($this->options['uri_case']) && $this->options['uri_case'])
		{
			return $this->options['uri_case'];
		}

		return '';
	}

	/**
	 * Returns disqus shortname.
	 *
	 * @return mixed
	 */
	public function getDisqusShortname()
	{
		if ( isset($this->options['disqus_short_name']) && $this->options['disqus_short_name'])
		{
			return $this->options['disqus_short_name'];
		}

		return null;
	}

	/**
	 * Returns news char length
	 *
	 * @return mixed
	 */
	public function getNewsExeLen()
	{
		if ( isset($this->options['news_ex_len']) && $this->options['news_ex_len'])
		{
			return $this->options['news_ex_len'];
		}

		return 225; // default char length
	}

	// TODO: Add other social providers (twitter, pinterest, vimeo, yahoo, ect...)
	/**
	 * Returns facebook page url.
	 *
	 * @return mixed
	 */
	public function getFb()
	{
		if ( isset($this->options['fb_url']) && $this->options['fb_url'])
		{
			return $this->options['fb_url'];
		}

		return null;
	}

	/**
	 * Returns whether use should be required to activate
	 * his account via email or not.
	 *
	 * @return boolean
	 */
	public function requireUserActivation()
	{
		if ( array_key_exists('require_act', $this->options) )
		{
			return (int) $this->options['require_act'];
		}

		return true;
	}

	/**
	 * Returns whether or not to automaticlly update news/trailers/in theaters.
	 *
	 * @return boolean
	 */
	public function autoUpdateData()
	{
		if ( array_key_exists('auto_upd_data', $this->options) )
		{
			return (int) $this->options['auto_upd_data'];
		}

		return true;
	}

	/**
	 * Returns whether or not to cache in filesystem.
	 *
	 * @return boolean
	 */
	public function useCache()
	{
		if ( array_key_exists('use_cache', $this->options) )
		{
			return (int) $this->options['use_cache'];
		}

		return true;
	}

	/**
	 * Returns whether or not to save images locally from tmdb.
	 *
	 * @return boolean
	 */
	public function saveTmdbImages()
	{
		if ( array_key_exists('save_tmdb', $this->options) )
		{
			return (int) $this->options['save_tmdb'];
		}

		return true;
	}

	/**
	 * Get specified color for options if it exists.
	 *
	 * @param  string $color
	 * @return mixed
	 */
	public function getColor($color = 'success')
	{
		if ( isset($this->options[$color . '_color']) )
		{
			return $this->options[$color . '_color'];
		}

		return null;
	}

	/**
	 * Whether to fully scraped news items or link to original source.
	 *
	 * @param  string $color
	 * @return mixed
	 */
	public function scrapeNewsFully()
	{
		if ( array_key_exists('scrape_news_fully', $this->options) )
		{
			return (int) $this->options['scrape_news_fully'];
		}

		return 1;
	}

	/**
	 * Get TMDB api language code.
	 *
	 * @param  string $color
	 * @return mixed
	 */
	public function getTmdbLang()
	{
		if (isset($this->options['tmdb_language']) && $this->options['tmdb_language'])
		{
			return $this->options['tmdb_language'];
		}

		return 'en';
	}

// Starts Ads Here (Edited in admin goes straight into page code as plain text)

	/**
	 * Returns footer ad.
	 *
	 * @return string
	 */
	public function getFooterAd()
	{
		if (isset($this->options['ad_footer_all']))
		{
			return $this->options['ad_footer_all'];
		}
	}

	/**
	 * Returns google analytics code.
	 *
	 * @return string
	 */
	public function getAnalytics()
	{
		if (isset($this->options['analytics']))
		{
			return $this->options['analytics'];
		}
	}

	/**
	 * Returns title jumbo ad.
	 *
	 * @return string
	 */
	public function getTitleJumboAd()
	{
		if (isset($this->options['ad_title_jumbo']))
		{
			return $this->options['ad_title_jumbo'];
		}
	}

	/**
	 * Returns home jumbo ad.
	 *
	 * @return string
	 */
	public function getHomeJumboAd()
	{
		if (isset($this->options['ad_home_jumbo']))
		{
			return $this->options['ad_home_jumbo'];
		}
	}

	/**
	 * Returns home news ad.
	 *
	 * @return string
	 */
	public function getHomeNewsAd()
	{
		if (isset($this->options['ad_home_news']))
		{
			return $this->options['ad_home_news'];
		}
	}

	/**
	 * Returns title user reviews ad.
	 *
	 * @return string
	 */
	public function getTitleUserAd()
	{
		if (isset($this->options['ad_title_user']))
		{
			return $this->options['ad_title_user'];
		}
	}

	/**
	 * Returns title critic reviews ad.
	 *
	 * @return string
	 */
	public function getTitleCriticAd()
	{
		if (isset($this->options['ad_title_critic']))
		{
			return $this->options['ad_title_critic'];
		}
	}

}
