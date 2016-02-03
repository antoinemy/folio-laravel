<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use File;
use Validator;
use Auth;

use App\Http\Models\Page;
use App\Http\Models\PageType;

class PageController extends Controller
{
	private $rules = [

	];

	public function index()
	{
		if(Auth::user()->can_show(4)) {
			$data['meta_title'] = 'Gestion des pages';
			$data['pages'] = Page::all();

			return view('admin.page.index', $data);
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
		if(Auth::user()->can_create(4)) {
			$data['meta_title'] = 'Création d\'une nouvelle page';
			$data['types'] = PageType::all();

			return view('admin.page.create', $data);
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
		if(Auth::user()->can_create(4)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails()) {
				return redirect()->back()->withErrors($validator)->with([
					'type' => 'danger',
					'message' => '<span class="fa fa-ban"></span> Les champs en rouge sont manquants ou invalides.',
				]);
			}
			else {
				$page = Page::create([
					'page_type_id'				=> $input['type'],
					'is_visible' 					=> isset($input['is_visible']) ? 1 : 0,

					'meta_title'					=> $input['meta_title'],
					'meta_desc'						=> $input['meta_desc'],
					'link_github'					=> $input['link_github'],
					'link_bitbucket'			=> $input['link_bitbucket'],

					'created_by' 					=> Auth::user()->id,
					'updated_by' 					=> Auth::user()->id,
				]);

				if(isset($input['image']) && is_uploaded_file($input['image']))
				{
					$dir = public_path('images/page/'.$page->id.'/small');
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(100, 100)
						->save($dir.'/original.jpg');

					$dir = public_path('images/page/'.$page->id);
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(500, 500)
						->save($dir.'/original.jpg');

					$page->has_image = 1;
					$page->save();
				}

				return redirect()->route('admin.page.index')->with([
					'type' => 'success',
					'message' => '<span class="fa fa-check"></span> La page a bien été créé.',
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
		if(Auth::user()->can_edit(4)) {
			$data['meta_title'] = 'Modification d\'une page';
			$data['page'] = Page::find($id);
			$data['types'] = PageType::all();

			return view('admin.page.edit', $data);
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
		if(Auth::user()->can_edit(4)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails()) {
				return redirect()->back()->withErrors($validator)->with([
					'type' => 'danger',
					'message' => '<span class="fa fa-ban"></span> Les champs en rouge sont manquants ou invalides.',
				]);
			}
			else {
				if($page = Page::find($id))
				{
					$page->update([
						'page_type_id'				=> $input['type'],
						'is_visible' 					=> isset($input['is_visible']) ? 1 : 0,

						'meta_title'					=> $input['meta_title'],
						'meta_desc'						=> $input['meta_desc'],
						'link_github'					=> $input['link_github'],
						'link_bitbucket'			=> $input['link_bitbucket'],

						'updated_by' 					=> Auth::user()->id,
					]);

					if((isset($input['remove_photo']) && $input['remove_photo'] == "true") ||
					(isset($input['image']) && is_uploaded_file($input['image']) && $page->has_image == 1))
					{
						$page->has_image = 0;
						$page->save();

						$dir = public_path('images/page/'.$page->id);
						if(File::isDirectory($dir)) {
							File::deleteDirectory($dir);
						}
					}

					if(isset($input['image']) && is_uploaded_file($input['image']))
					{
						$dir = public_path('images/page/'.$page->id.'/small');
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}

						$image = Image::make($input['image'])
							->fit(100, 100)
							->save($dir.'/original.jpg');

						$dir = public_path('images/page/'.$page->id);
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}

						$image = Image::make($input['image'])
							->fit(500, 500)
							->save($dir.'/original.jpg');

						$page->has_image = 1;
						$page->save();
					}

					return redirect()->route('admin.page.index')->with([
						'type' => 'success',
						'message' => '<span class="fa fa-check"></span> La page a bien été modifié.',
					]);
				}
				else {
					return redirect()->route('admin.page.index')->with([
						'type' => 'success',
						'message' => '<span class="fa fa-check"></span> La page sélectionnée n\'existe pas.',
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
		if(Auth::user()->can_delete(4)) {
			if($page = Page::find($id))
			{
				$dir = public_path('images/project/'.$project->id);
		    if(File::isDirectory($dir)) {
					File::deleteDirectory($dir);
				}

	      $page->delete();

	      return redirect()->route('admin.project.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> Le projet a bien été supprimé.',
				]);
	    }
	    else
	    {
	      return redirect()->route('admin.project.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> Le projet sélectionné n\'existe pas.',
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
