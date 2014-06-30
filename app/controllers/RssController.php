<?php

class RssController extends BaseController
{
	
	/**
	 * Return feed of movies now playing in theaters.
	 * 
	 * @return xml
	 */
	public function nowInTheaters()
	{
		$feed = $this->makeChannel(trans('main.brand') . ' - ' . trans('feed.nowInTheatersDesc'), trans('feed.nowInTheatersDesc'), Request::url());

	    $playing = Title::nowPlaying();
	    
	    foreach ($playing as $p)
	    {
	        $feed->item(array('title' => $p['title'], 'description|cdata' => $p['plot'], 'link' => Helpers::url($p['title'], $p['id'], $p['type'])));
	    }

	    return Response::make($feed, 200, array('Content-Type' => 'text/xml'));
	}

	/**
	 * Returns feed of latest news.
	 * 
	 * @return xml
	 */
	public function news()
	{
		$feed = $this->makeChannel(trans('main.brand') . ' - ' . trans('feed.newsDesc'), trans('feed.newsDesc'), Request::url());

	    $news = News::News();
	    
	    foreach ($news as $n)
	    {
	        $feed->item(array('title' => $n['title'], 'description|cdata' => Str::words($n['body'], 75), 'link' => Helpers::url($n['title'], $n['id'], 'news')));
	    }

	    return Response::make($feed, 200, array('Content-Type' => 'text/xml'));
	}

	private function makeChannel($title, $desc, $link)
	{
		$feed = Rss::feed('2.0', 'UTF-8');
	    return $feed->channel(array('title' => $title, 'description' => $desc, 'link' => $link));
	}
}