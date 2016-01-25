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
		$data['meta_title'] = $data['page']->meta_title;
		$data['meta_desc'] = $data['page']->meta_desc;
		return view('index', $data);
	}

	public function articles() {
		$data['articles'] = Article::all();
		$data['page'] = Page::find(2);
		$data['meta_title'] = '';
		$data['meta_desc'] = '';
		return view('articles', $data);
	}

	public function category_articles($id) {
		$data['category'] = ArticleCategory::find($id);
		$data['meta_title'] = $data['category']->meta_title;
		$data['meta_desc'] = $data['category']->meta_desc;
		return view('category_articles', $data);
	}

	public function page_article($id) {
		$data['article'] = Article::find($id);
		$data['meta_title'] = $data['article']->meta_title;
		$data['meta_desc'] = $data['article']->meta_desc;
		return view('page_article', $data);
	}

	public function projects() {
		$data['projects'] = Project::all();
		$data['page'] = Page::find(3);
		$data['meta_title'] = '';
		$data['meta_desc'] = '';
		return view('projects', $data);
	}

	public function category_projects($id) {
		$data['category'] = ProjectCategory::find($id);
		$data['meta_title'] = $data['category']->meta_title;
		$data['meta_desc'] = $data['category']->meta_desc;
		return view('category_projects', $data);
	}

	public function page_project($id) {
		$data['project'] = Project::find($id);
		$data['meta_title'] = $data['project']->meta_title;
		$data['meta_desc'] = $data['project']->meta_desc;
		return view('page_project', $data);
	}
}
