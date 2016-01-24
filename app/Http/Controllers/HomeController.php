<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index() {
		return view('site.index');
	}

	public function articles() {
		return view('site.articles');
	}

	public function projects() {
		return view('site.projects');
	}
}
