<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use File;
use Validator;
use Auth;

use App\Http\Models\Project;
use App\Http\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
	private $rules = [

	];

	public function index()
	{
		if(Auth::user()->can_show(6)) {
			$data['meta_title'] = 'Gestion des catégories de projets';
			$data['categories'] = ProjectCategory::all();

			return view('admin.category_project.index', $data);
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
		if(Auth::user()->can_create(6)) {
			$data['meta_title'] = 'Création d\'une nouvelle catégorie de projets';
			$data['categories'] = ProjectCategory::all();

			return view('admin.category_project.create', $data);
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
		if(Auth::user()->can_create(6)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{
				$category = ProjectCategory::create([
					'is_visible' 		=> isset($input['is_visible']) ? 1 : 0,
					'meta_title' 		=> $input['meta_title'],
					'meta_desc' 		=> $input['meta_desc'],
					'name' 					=> $input['name'],

					'created_by' 		=> Auth::user()->id,
					'updated_by' 		=> Auth::user()->id,
				]);

				return redirect()->route('admin.category_project.index')->with([
					'type' 		=> 'success',
					'message' 	=> '<span class="fa fa-check"></span> La catégorie de projets a bien été créé.',
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
		if(Auth::user()->can_edit(6)) {
			$data['meta_title'] = 'Modification d\'une catégorie de projets';
			$data['category'] = ProjectCategory::find($id);

			return view('admin.category_project.edit', $data);
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
		if(Auth::user()->can_edit(6)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{

				if($category = ProjectCategory::find($id))
				{
					$category->update([
						'is_visible' 		=> isset($input['is_visible']) ? 1 : 0,
						'meta_title' 		=> $input['meta_title'],
						'meta_desc' 		=> $input['meta_desc'],
						'name'			 		=> $input['name'],

						'updated_by' 		=> Auth::user()->id,
					]);

					return redirect()->route('admin.category_project.index')->with([
						'type' 		=> 'success',
						'message' 	=> '<span class="fa fa-check"></span> La catégorie de projets a bien été modifié.',
					]);
				}
				else
				{
					return redirect()->route('admin.category_project.index')->with([
						'type' 		=> 'danger',
						'message' 	=> '<span class="fa fa-times"></span> La catégorie de projets sélectionnée n\'existe pas.',
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
		if(Auth::user()->can_delete(6)) {
			if($category = ProjectCategory::find($id))
			{
				$dir = public_path('images/categories/projects/'.$category->id);
		        if(File::isDirectory($dir)) {
					File::deleteDirectory($dir);
				}

	      $category->delete();

	      return redirect()->route('admin.category_project.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> La catégorie de projets a bien été supprimé.',
				]);
	    }
	    else
	    {
	      return redirect()->route('admin.category_project.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> La catégorie de projets sélectionnée n\'existe pas.',
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
