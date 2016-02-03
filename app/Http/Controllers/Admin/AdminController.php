<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use File;
use Validator;
use Auth;

use App\Http\Models\Admin;
use App\Http\Models\AdminRight;
use App\Http\Models\Right;

class AdminController extends Controller
{
	private $rules = [
		'last_name' 		=> 'required|max:255',
		'first_name' 		=> 'required|max:255',
		'email' 				=> 'required|email|max:255|unique:folio_admins',
		'password' 			=> 'required|confirmed|min:4',
	];

	public function index()
	{
		if(Auth::user()->can_show(1)) {
			$data['meta_title'] = 'Gestion des administrateurs';
			$data['admins'] = Admin::all();

			return view('admin.admin.index', $data);
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
		if(Auth::user()->can_create(1)) {
			$data['meta_title'] = 'Création d\'un nouvel administrateur';
			$data['rights'] = Right::lists('name', 'id');

			return view('admin.admin.create', $data);
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
		if(Auth::user()->can_create(1)) {
			$input = $request->all();

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{
				$admin = Admin::create([
					'last_name' 	=> $input['last_name'],
					'first_name' 	=> $input['first_name'],
					'email' 			=> $input['email'],
					'password' 		=> bcrypt($input['password']),

					'created_by' 	=> Auth::user()->id,
					'updated_by' 	=> Auth::user()->id,
				]);

				if(isset($input['image']) && is_uploaded_file($input['image']))
				{
					$dir = public_path('images/admin/'.$admin->id.'/small');
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}

					$image = Image::make($input['image'])
						->fit(100, 100)
						->save($dir.'/original.jpg');

					$admin->has_image = 1;
					$admin->save();
				}

				if(count($admin->rights) > 0)
				{
					$admin->rights->each(function($right, $id) {
						$right->delete();
					});
				}

				if(isset($input['rights']))
				{
					foreach($input['rights'] as $right)
					{
						$admin_right = AdminRight::create([
							'admin_id' 		=> $admin->id,
							'right_id' 		=> $right,
							'created_by' 	=> $admin->id,
							'updated_by' 	=> $admin->id,
						]);

						if(isset($right['show'])) {
							$admin_right->can_show = 1;
						}
						if(isset($right['create'])) {
							$admin_right->can_create = 1;
						}
						if(isset($right['edit'])) {
							$admin_right->can_edit = 1;
						}
						if(isset($right['delete'])) {
							$admin_right->can_delete = 1;
						}
						if(isset($right['right'])) {
							$admin_right->can_right = 1;
						}

						$admin_right->save();
					}
				}

				return redirect()->route('admin.admin.index')->with([
					'type' => 'success',
					'message' => '<span class="fa fa-check"></span> L\'administrateur a bien été créé.',
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
		if(Auth::user()->can_edit(1)) {
			$data['meta_title'] = 'Modification d\'un administrateur';
			$data['admin'] = Admin::find($id);
			$data['rights'] = Right::lists('name', 'id');

			return view('admin.admin.edit', $data);
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
		if(Auth::user()->can_edit(1)) {
			$input = $request->all();

			$this->rules['email'] = 'required|email|max:255|unique:folio_admins,email,'.$id;
			$this->rules['password'] = 'confirmed|min:4';

			$validator = Validator::make($input, $this->rules);

			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			}
			else
			{
				if($admin = Admin::find($id))
				{
					$admin->update([
						'last_name' 	=> $input['last_name'],
						'first_name' 	=> $input['first_name'],
						'email' 		=> $input['email'],

						'updated_by' 	=> Auth::user()->id,
					]);

					if(!empty($input['password']))
					{
						$admin->password = bcrypt($input['password']);
						$admin->save();
					}

					if((isset($input['remove_photo']) && $input['remove_photo'] == "true") ||
					(isset($input['image']) && is_uploaded_file($input['image']) && $admin->has_image == 1))
					{
						$admin->has_image = 0;
						$admin->save();

						$dir = public_path('images/admin/'.$admin->id);
				        if(File::isDirectory($dir)) {
							File::deleteDirectory($dir);
						}
					}

					if(isset($input['image']) && is_uploaded_file($input['image']))
					{
						$dir = public_path('images/admin/'.$admin->id.'/small');
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}

						$image = Image::make($input['image'])
							->fit(100, 100)
							->save($dir.'/original.jpg');

						$admin->has_image = 1;
						$admin->save();
					}

					if(count($admin->rights) > 0)
					{
						$admin->rights->each(function($right, $id) {
							$right->delete();
						});
					}

					if(isset($input['rights']))
					{
						foreach($input['rights'] as $id=>$right) {

							$admin_right = AdminRight::create([
								'admin_id' 		=> $admin->id,
								'right_id' 		=> $id,
								'created_by' 	=> $admin->id,
								'updated_by' 	=> $admin->id,
							]);

							if(isset($right['show'])) {
								$admin_right->can_show = 1;
							}
							if(isset($right['create'])) {
								$admin_right->can_create = 1;
							}
							if(isset($right['edit'])) {
								$admin_right->can_edit = 1;
							}
							if(isset($right['delete'])) {
								$admin_right->can_delete = 1;
							}
							if(isset($right['right'])) {
								$admin_right->can_right = 1;
							}

							$admin_right->save();
						}
					}

					return redirect()->route('admin.admin.index')->with([
						'type' 		=> 'success',
						'message' 	=> '<span class="fa fa-check"></span> L\'administrateur a bien été modifié.',
					]);
				}
				else
				{
					return redirect()->route('admin.admin.index')->with([
						'type' 		=> 'danger',
						'message'	=> '<span class="fa fa-times"></span> L\'administrateur sélectionné n\'existe pas.',
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
		if(Auth::user()->can_delete(1)) {
			if($admin = Admin::find($id))
			{
				$dir = public_path('images/admin/'.$admin->id);
		        if(File::isDirectory($dir)) {
					File::deleteDirectory($dir);
				}

	      $admin->delete();

	      return redirect()->route('admin.admin.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> L\'administrateur a bien été supprimé.',
				]);
	    }
	    else
	    {
	      return redirect()->route('admin.admin.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> L\'administrateur sélectionné n\'existe pas.',
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
