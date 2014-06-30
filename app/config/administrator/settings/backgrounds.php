<?php

return array(

	/**
	 * Settings page title
	 *
	 * @type string
	 */
	'title' => trans('dash.bgs'),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
		'home_bg' => array(
			'title' => trans('dash.home bg'),
			'type' => 'image',
		    'location' => public_path() . '/assets/images/',
		    'naming' => 'random',
		    'length' => 20,
		    'size_limit' => 5,
		),
		'login_bg' => array(
			'title' => trans('dash.login bg'),
			'type' => 'image',
		    'location' => public_path() . '/assets/images/',
		    'naming' => 'random',
		    'length' => 20,
		    'size_limit' => 5,
		),
		'register_bg' => array(
			'title' => trans('dash.register bg'),
			'type' => 'image',
		    'location' => public_path() . '/assets/images/',
		    'naming' => 'random',
		    'length' => 20,
		    'size_limit' => 5,
		),
		'404_bg' => array(
			'title' => trans('dash.404 bg'),
			'type' => 'image',
		    'location' => public_path() . '/assets/images/',
		    'naming' => 'random',
		    'length' => 20,
		    'size_limit' => 5,
		),
	),

	'rules' => array(
		'home_bg' => 'max:255',
		'404_bg' => 'max:255',
		'register_bg' => 'max:255',
		'login_bg' => 'max:255',
	),

	/**
	 * This is run prior to saving the JSON form data
	 *
	 * @type function
	 * @param array		$data
	 *
	 * @return string (on error) / void (otherwise)
	 */
	'before_save' => function(&$data)
	{
		$dash = \App::make('Lib\Repository\Dashboard\DashboardRepositoryInterface');
		$dash->updateOptions($data);
	},
);