<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Models\Page;
use App\Http\Models\Article;
use App\Http\Models\ArticleCategory;
use App\Http\Models\Project;
use App\Http\Models\ProjectCategory;

class HomeController extends Controller
{
	public function index() {
		$data['page'] = Page::find(1);
		return view('site.index', $data);
	}

	public function articles() {
		$data['articles'] = Article::all();
		return view('site.articles', $data);
	}

	public function category_articles($id) {
		$data['category'] = ArticleCategory::find($id);
		return view('site.category_articles', $data);
	}

	public function page_article($id) {
		$data['article'] = Article::find($id);
		return view('site.page_article', $data);
	}

	public function projects() {
		$data['projects'] = Project::all();
		return view('site.projects', $data);
	}

	public function category_projects($id) {
		$data['category'] = ProjectCategory::find($id);
		return view('site.category_projects', $data);
	}

	public function page_project($id) {
		$data['project'] = Project::find($id);
		return view('site.page_project', $data);
	}
}
