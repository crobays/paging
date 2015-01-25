<?php

class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function page($page = FALSE)
	{
		if ($locale = Cookie::get('locale'))
		{
			App::setLocale($locale);
		}

		if ( ! $page)
		{
			return Redirect::to(Lang::get('navigation.consumer'), 301);
		}

		$nav = array();
		foreach(['consumer', 'exporter'] as $item)
		{
			$loc = Lang::get('navigation.'.$item);
			$link = strtolower(str_replace(' ', '-', $loc));
			if($link == $page)
			{
				$page = $item;
			}
			$nav[$link] = ucfirst($loc);
		}

		if ( ! View::exists('layouts.public.'.$page))
		{
			App::abort(404);
		}
		$sub_nav = array();
		$view = View::make('layouts.public.'.$page);
		switch ($page) {
			case 'exporter':
				$sub_nav = [
					'assortment',
					'horticulture',
					'certification',
					'contact',
				];
				
				$picturebox = new Picturebox\PictureboxManager();
				$view->with('picturebox', $picturebox);
				break;
		}
		$view->with('sub_nav', $sub_nav);
		return $view->with('nav', $nav);
	}


}
