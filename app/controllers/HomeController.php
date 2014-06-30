<?php

use Carbon\Carbon;
use Lib\Services\Mail\Mailer;
use Lib\Services\Validation\ContactValidator;

class HomeController extends BaseController
{
	/**
	 * Validator instance.
	 *
	 * @var Lib\Services\Validation\ContactValidator
	 */
	private $validator;

	/**
	 * Options instance.
	 *
	 * @var Lib\Services\Options\Options
	 */
	private $options;

	/**
	 * Mailer instance.
	 *
	 * @var Lib\Services\Mail\Mailer;
	 */
	private $mailer;


	public function __construct(ContactValidator $validator, Mailer $mailer)
	{
		$this->mailer    = $mailer;
		$this->validator = $validator;
		$this->options   = App::make('Options');
	}

	/**
	 * Show homepage.
	 *
	 * @return View
	 */
	public function index()
	{
		$view = ucfirst($this->options->getHomeView());

		$featured   = Title::featured();
		$playing    = Title::nowPlaying();
		$news       = News::news();
		$tv         = Title::tv();
		$series     = Title::tvIndex();

		if ($view == 'Rows')
		{
			$upcoming = Title::upcoming();
			$actors   = Actor::popular();
			$latest   = Title::latest();

			if (is_a($latest, 'Illuminate\Database\Eloquent\Builder'))
			{
				$latest = null;
			}

			return View::make("Main.Themes.$view.Home")
					  ->withFeatured($featured)
					  ->withPlaying($playing)
					  ->withBg($this->options->getBg('home'))
					  ->withFacebook($this->options->getFb())
					  ->withUpcoming($upcoming)
					  ->withActors($actors)
					  ->withNews($news)
					  ->withLatest($latest)
					  ->withTv($tv)
					  ->withSeries($series);
		}
		else
		{
			return View::make("Main.Themes.$view.Home")
					  ->withFeatured($featured)
					  ->withPlaying($playing)
					  ->withNews($news)
					  ->withBg($this->options->getBg('home'))
					  ->withFacebook($this->options->getFb());
		}
	}

	/**
	 * Show privacy policy page.
	 *
	 * @return View
	 */
	public function privacy()
	{
		return View::make('Main.Privacy');
	}

	/**
	 * Show terms of service page.
	 *
	 * @return View
	 */
	public function tos()
	{
		return View::make('Main.Tos');
	}

	/**
	 * Show contact us page.
	 *
	 * @return View
	 */
	public function contact()
	{
		return View::make('Main.Contact');
	}

	/**
	 * Sends an email message from contact us form.
	 *
	 * @return View
	 */
	public function submitContact()
	{
		$input = Input::all();

		if ( ! $this->validator->with($input)->passes())
		{
			return Redirect::back()->withErrors($this->validator->errors())->withInput($input);
		}

		$this->mailer->sendContactUs($input);

		return Redirect::to('/')->withSuccess( trans('main.contact succes') );
	}
}
