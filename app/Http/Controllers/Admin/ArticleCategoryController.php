<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use File;
use Validator;
use Auth;

use App\Http\Models\Article;
use App\Http\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
	private $rules = [

	];

	public function index()
	{
		if(Auth::user()->can_show(5)) {
			$data['meta_title'] = 'Gestion des catégories d\'articles';
			$data['categories'] = ArticleCategory::all();

			return view('admin.category_article.index', $data);
		}
		else {
			return redirect()->route('admin.dashboard.index')->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Vous n\'avez pas les droits nécessaires pour accéder à cette partie.',
			]);
		}
	}

	public function create()
	{
		if(Auth::user()->can_create(5) && Auth::user()->can_show(5)) {
			$data['meta_title'] = 'Création d\'une nouvelle catégorie d\'articles';
			$data['categories'] = ArticleCategory::all();

			return view('admin.category_article.create', $data);
		}
		else {
			return redirect()->route('admin.dashboard.index')->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Vous n\'avez pas les droits nécessaires pour accéder à cette partie.',
			]);
		}
	}

	public function store(Request $request)
	{
		if(Auth::user()->can_create(5)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{
				$category = ArticleCategory::create([
					'is_visible' 		=> isset($input['is_visible']) ? 1 : 0,
					'meta_title' 		=> $input['meta_title'],
					'meta_desc' 		=> $input['meta_desc'],
					'name' 					=> $input['name'],

					'created_by' 		=> Auth::user()->id,
					'updated_by' 		=> Auth::user()->id,
				]);

				return redirect()->route('admin.category_article.index')->with([
					'type' 		=> 'success',
					'message' 	=> '<span class="fa fa-check"></span> La catégorie d\'articles a bien été créé.',
				]);
			}
		}
		else {
			return redirect()->route('admin.dashboard.index')->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Vous n\'avez pas les droits nécessaires pour accéder à cette partie.',
			]);
		}
	}

	public function edit($id)
	{
		if(Auth::user()->can_edit(5) && Auth::user()->can_show(5)) {
			$data['meta_title'] = 'Modification d\'une catégorie d\'articles';
			$data['category'] = ArticleCategory::find($id);

			return view('admin.category_article.edit', $data);
		}
		else {
			return redirect()->route('admin.dashboard.index')->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Vous n\'avez pas les droits nécessaires pour accéder à cette partie.',
			]);
		}
	}

	public function update(Request $request, $id)
	{
		if(Auth::user()->can_edit(5)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{

				if($category = ArticleCategory::find($id))
				{
					$category->update([
						'is_visible' 		=> isset($input['is_visible']) ? 1 : 0,
						'meta_title' 		=> $input['meta_title'],
						'meta_desc' 		=> $input['meta_desc'],
						'name'			 		=> $input['name'],

						'updated_by' 		=> Auth::user()->id,
					]);

					return redirect()->route('admin.category_article.index')->with([
						'type' 		=> 'success',
						'message' 	=> '<span class="fa fa-check"></span> La catégorie d\'articles a bien été modifié.',
					]);
				}
				else
				{
					return redirect()->route('admin.category_article.index')->with([
						'type' 		=> 'danger',
						'message' 	=> '<span class="fa fa-times"></span> La catégorie d\'articles sélectionnée n\'existe pas.',
					]);
				}
			}
		}
		else {
			return redirect()->route('admin.dashboard.index')->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Vous n\'avez pas les droits nécessaires pour accéder à cette partie.',
			]);
		}
	}

	public function destroy($id)
	{
		if(Auth::user()->can_delete(5) && Auth::user()->can_show(5)) {
			if($category = ArticleCategory::find($id))
			{
	      $category->delete();

	      return redirect()->route('admin.category_article.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> La catégorie d\'articles a bien été supprimé.',
				]);
	    }
	    else
	    {
	      return redirect()->route('admin.category_article.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> La catégorie d\'articles sélectionnée n\'existe pas.',
				]);
	    }
		}
		else {
			return redirect()->route('admin.dashboard.index')->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Vous n\'avez pas les droits nécessaires pour accéder à cette partie.',
			]);
		}
	}
}
