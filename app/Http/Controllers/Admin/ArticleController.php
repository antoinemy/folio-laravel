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

class ArticleController extends Controller
{
	private $rules = [

	];

	public function index()
	{
		if(Auth::user()->can_show(2)) {
			$data['meta_title'] = 'Gestion des articles';
			$data['articles'] = Article::all();

			return view('admin.article.index', $data);
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
		if(Auth::user()->can_create(2)) {
			$data['meta_title'] = 'Création d\'un nouvel article';
			$data['categories'] = ArticleCategory::all();

			return view('admin.article.create', $data);
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
		if(Auth::user()->can_create(2)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{
				$article = Article::create([
					'article_category_id'	=> $input['category'],
					'is_visible' 					=> isset($input['is_visible']) ? 1 : 0,

					'meta_title'					=> $input['meta_title'],
					'meta_desc'						=> $input['meta_desc'],
					'name'								=> $input['name'],
					'desc'								=> $input['desc'],
					'content'							=> $input['content'],

					'created_by' 					=> Auth::user()->id,
					'updated_by' 					=> Auth::user()->id,
				]);

				if(isset($input['image']) && is_uploaded_file($input['image']))
				{
					$dir = public_path('images/article/'.$article->id.'/small');
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(100, 100)
						->save($dir.'/original.jpg');

					$dir = public_path('images/article/'.$article->id);
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(500, 500)
						->save($dir.'/original.jpg');

					$article->has_image = 1;
					$article->save();
				}

				return redirect()->route('admin.article.index')->with([
					'type' 		=> 'success',
					'message' 	=> '<span class="fa fa-check"></span> L\'article a bien été créé.',
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
		if(Auth::user()->can_edit(2)) {
			$data['meta_title'] = 'Modification d\'un article';
			$data['article'] = Article::find($id);
			$data['categories'] = ArticleCategory::all();

			return view('admin.article.edit', $data);
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
		if(Auth::user()->can_edit(2)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{

				if($article = Article::find($id))
				{
					$article->update([
						'article_category_id'	=> $input['category'],
						'is_visible' 					=> isset($input['is_visible']) ? 1 : 0,

						'meta_title'					=> $input['meta_title'],
						'meta_desc'						=> $input['meta_desc'],
						'name'								=> $input['name'],
						'desc'								=> $input['desc'],
						'content'							=> $input['content'],

						'updated_by' 					=> Auth::user()->id,
					]);

					if((isset($input['remove_photo']) && $input['remove_photo'] == "true") ||
					(isset($input['image']) && is_uploaded_file($input['image']) && $article->has_image == 1))
					{
						$article->has_image = 0;
						$article->save();

						$dir = public_path('images/article/'.$article->id);
				    if(File::isDirectory($dir)) {
							File::deleteDirectory($dir);
						}
					}

					if(isset($input['image']) && is_uploaded_file($input['image']))
					{
						$dir = public_path('images/article/'.$article->id.'/small');
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}

						$image = Image::make($input['image'])
							->fit(100, 100)
							->save($dir.'/original.jpg');

						$dir = public_path('images/article/'.$article->id);
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}

						$image = Image::make($input['image'])
							->fit(500, 500)
							->save($dir.'/original.jpg');

						$article->has_image = 1;
						$article->save();
					}

					return redirect()->route('admin.article.index')->with([
						'type' 		=> 'success',
						'message' 	=> '<span class="fa fa-check"></span> L\'article a bien été modifié.',
					]);
				}
				else
				{
					return redirect()->route('admin.article.index')->with([
						'type' 		=> 'danger',
						'message' 	=> '<span class="fa fa-times"></span> L\'article sélectionné n\'existe pas.',
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
		if(Auth::user()->can_delete(2)) {
			if($article = Article::find($id))
			{
				$dir = public_path('images/article/'.$article->id);
		    if(File::isDirectory($dir)) {
					File::deleteDirectory($dir);
				}

	      $article->delete();

	      return redirect()->route('admin.article.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> L\'actualité a bien été supprimé.',
				]);
	    }
	    else
	    {
	      return redirect()->route('admin.article.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> L\'actualité sélectionnée n\'existe pas.',
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
