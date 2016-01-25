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

class ProjectController extends Controller
{
	private $rules = [

	];

	public function index()
	{
		$data['meta_title'] = 'Gestion des projects';
		$data['projects'] = Project::all();

		return view('admin.project.index', $data);
	}

	public function create()
	{
		$data['meta_title'] = 'Création d\'un nouveau projet';
		$data['categories'] = ProjectCategory::all();

		return view('admin.project.create', $data);
	}

	public function store(Request $request)
	{
		$input = $request->all();

		$validator = Validator::make($input, $this->rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		else
		{
			$project = Project::create([
				'project_category_id'	=> $input['category'],
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
				$dir = public_path('images/project/'.$project->id.'/small');
				if(!File::isDirectory($dir)) {
					File::makeDirectory($dir, 0777, true);
				}

				$image = Image::make($input['image'])
					->fit(100, 100)
					->save($dir.'/original.jpg');

				$dir = public_path('images/project/'.$project->id);
				if(!File::isDirectory($dir)) {
					File::makeDirectory($dir, 0777, true);
				}

				$image = Image::make($input['image'])
					->fit(500, 500)
					->save($dir.'/original.jpg');

				$project->has_image = 1;
				$project->save();
			}

			return redirect()->route('admin.project.index')->with([
				'type' 		=> 'success',
				'message' 	=> '<span class="fa fa-check"></span> Le project a bien été créé.',
			]);
		}
	}

	public function edit($id)
	{
		$data['meta_title'] = 'Modification d\'un project';
		$data['project'] = Project::find($id);
		$data['categories'] = ProjectCategory::all();

		return view('admin.project.edit', $data);
	}

	public function update(Request $request, $id)
	{
		$input = $request->all();

		$validator = Validator::make($input, $this->rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		else
		{

			if($project = Project::find($id))
			{
				$project->update([
					'project_category_id'	=> $input['category'],
					'is_visible' 					=> isset($input['is_visible']) ? 1 : 0,

					'meta_title'					=> $input['meta_title'],
					'meta_desc'						=> $input['meta_desc'],
					'name'								=> $input['name'],
					'desc'								=> $input['desc'],
					'content'							=> $input['content'],

					'updated_by' 					=> Auth::user()->id,
				]);

				if((isset($input['remove_photo']) && $input['remove_photo'] == "true") ||
				(isset($input['image']) && is_uploaded_file($input['image']) && $project->has_image == 1))
				{
					$project->has_image = 0;
					$project->save();

					$dir = public_path('images/project/'.$project->id);
			    if(File::isDirectory($dir)) {
						File::deleteDirectory($dir);
					}
				}

				if(isset($input['image']) && is_uploaded_file($input['image']))
				{
					$dir = public_path('images/project/'.$project->id.'/small');
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(100, 100)
						->save($dir.'/original.jpg');

					$dir = public_path('images/project/'.$project->id);
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(500, 500)
						->save($dir.'/original.jpg');

					$project->has_image = 1;
					$project->save();
				}

				return redirect()->route('admin.project.index')->with([
					'type' 		=> 'success',
					'message' 	=> '<span class="fa fa-check"></span> Le projet a bien été modifié.',
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
	}

	public function destroy($id)
	{
		if($project = Project::find($id))
		{
			$dir = public_path('images/project/'.$project->id);
	    if(File::isDirectory($dir)) {
				File::deleteDirectory($dir);
			}

      $project->delete();

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
}
