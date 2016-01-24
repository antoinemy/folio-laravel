<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use File;
use Validator;
use Auth;

use App\Http\Models\Page;
use App\Http\Models\Language;
use App\Http\Models\PageType;
use App\Http\Models\Photo;
use App\Http\Models\PhotoPage;

class PageController extends Controller
{
	private $rules = [

	];
	
	public function index() 
	{
		$data['meta_title'] = 'Pages';
		$data['pages'] = Page::all();
		return view('admin.page.index', $data);
	}
	
	public function create() 
	{
		$data['meta_title'] = 'Création d\'une nouvelle page';
		$data['types'] = PageType::all();
		$data['languages'] = Language::all();
		
		return view('admin.page.create', $data);
	}
	
	public function store(Request $request)
	{
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
				'photo_id' => 1, // Default photo
				'page_type_id' => $input['type'],
				'meta_title' => $input['meta_title'],
				'meta_desc' => $input['meta_desc'],
				'is_visible' => isset($input['is_visible']) ? 1 : 0,
				'is_disponible' => isset($input['is_disponible']) ? 0 : 1,
				'name' => $input['name'],
				'desc' => $input['desc'],
				'desc_plus' => $input['desc_plus'],
				'facebook' => $input['facebook'],
				'address' => $input['address'],
				'address_plus' => $input['address_plus'],
				'brasseur_1' => $input['brasseur_1'],
				'brasseur_2' => $input['brasseur_2'],
				'latitude' => $input['latitude'],
				'longitude' => $input['longitude'],
				'content' => $input['content'],
				'list' => $input['list'],
				'updated_by' => Auth::user()->id,
				'created_by' => Auth::user()->id,
			]);
			
			if(isset($input['image']) && is_uploaded_file($input['image'])) {
				$dir = public_path('images/page/'.$page->id);
				if(!File::isDirectory($dir)) {
					File::makeDirectory($dir, 0777, true);
				}
				$image = Image::make($input['image'])->fit(1110, 1110)->save($dir.'/original.jpg');
				
				$photo = Photo::create([
					'name' => 'original',
					'type' => 'jpg',
					'path' => $dir,
					'absolute' => $dir.'/original.jpg',
					'updated_by' => Auth::user()->id,
					'created_by' => Auth::user()->id,
				]);
				
				$page->photo_id = $photo->id;
				$page->save();
			}
			
			if(count($input['images']) > 0) {
				foreach($input['images'] as $img) {
					if(isset($img) && is_uploaded_file($img)) {
						$dir = public_path('images/page/'.$page->id);
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}
						$name = randomStr();
						$image = Image::make($img)->fit(1200, 800)->save($dir.'/'.$name.'.jpg');
						
						$photo = Photo::create([
							'name' => $name,
							'type' => 'jpg',
							'path' => $dir,
							'absolute' => $dir.'/'.$name.'.jpg',
							'updated_by' => 0,
							'created_by' => 0,
						]);
						
						PhotoPage::create([
							'photo_id' => $photo->id,
							'page_id' => $page->id,
							'updated_by' => Auth::user()->id,
							'created_by' => Auth::user()->id,
						]);
					}
				}	
			}
			
			return redirect()->route('admin.page.index')->with([
				'type' => 'success',
				'message' => '<span class="fa fa-check"></span> La page a bien été créé.',
			]);
		}
	}
	
	public function edit($id) 
	{
		$data['meta_title'] = 'Modification d\'une page';
		$data['page'] = Page::find($id);
		$data['types'] = PageType::all();
		$data['lists'] = $this->lists;
		
		return view('admin.page.edit', $data);
	}
	
	public function update(Request $request, $id) 
	{
		$input = $request->all();

		$validator = Validator::make($input, $this->rules);

		if($validator->fails()) {
			return redirect()->back()->withErrors($validator)->with([
				'type' => 'danger',
				'message' => '<span class="fa fa-ban"></span> Les champs en rouge sont manquants ou invalides.',
			]);
		}
		else {
			$page = Page::find($id);
			
			$page->update([
				'meta_title' => $input['meta_title'],
				'meta_desc' => $input['meta_desc'],
				'is_visible' => isset($input['is_visible']) ? 1 : 0,
				'is_disponible' => isset($input['is_disponible']) ? 0 : 1,
				'desc' => $input['desc'],
				'desc_plus' => $input['desc_plus'],
				'facebook' => $input['facebook'],
				'address' => $input['address'],
				'address_plus' => $input['address_plus'],
				'brasseur_1' => $input['brasseur_1'],
				'brasseur_2' => $input['brasseur_2'],
				'latitude' => $input['latitude'],
				'longitude' => $input['longitude'],
				'content' => $input['content'],
				'list' => $input['list'],
				'updated_by' => Auth::user()->id,
				'created_by' => Auth::user()->id,
			]);
			
			if((isset($input['remove_photo']) && $input['remove_photo'] == "true") || (isset($input['image']) && is_uploaded_file($input['image']) && $page->photo_id != 1)) {
				$last_photo = $page->photo;
				$page->photo_id = 1;
				$page->save();
				$last_photo->delete();
			}
			
			if(isset($input['image']) && is_uploaded_file($input['image'])) {				
				$dir = public_path('images/page/'.$page->id);
				if(!File::isDirectory($dir)) {
					File::makeDirectory($dir, 0777, true);
				}
				$image = Image::make($input['image'])->fit(1110, 1110)->save($dir.'/original.jpg');
				
				$photo = Photo::create([
					'name' => 'original',
					'type' => 'jpg',
					'path' => $dir,
					'absolute' => $dir.'/original.jpg',
					'updated_by' => 1,
					'created_by' => 1,
				]);
				
				$page->photo_id = $photo->id;
				$page->save();
			}
			
			if(isset($input['remove_photos']) && !empty($input['remove_photos'])) {
				$remove_photos = explode("-", $input['remove_photos']);
				foreach($remove_photos as $photo_id) {
					$photo = Photo::find($photo_id);
					$photo->delete();
				}
			}
			
			if(count($input['images']) > 0) {
				foreach($input['images'] as $img) {
					if(isset($img) && is_uploaded_file($img)) {
						$dir = public_path('images/page/'.$page->id);
						if(!File::isDirectory($dir)) {
							File::makeDirectory($dir, 0777, true);
						}
						$name = randomStr();
						$image = Image::make($img)->fit(1200, 800)->save($dir.'/'.$name.'.jpg');
						
						$photo = Photo::create([
							'name' => $name,
							'type' => 'jpg',
							'path' => $dir,
							'absolute' => $dir.'/'.time().'.jpg',
							'updated_by' => Auth::user()->id,
							'created_by' => Auth::user()->id,
						]);
						
						PhotoPage::create([
							'photo_id' => $photo->id,
							'page_id' => $page->id,
							'updated_by' => Auth::user()->id,
							'created_by' => Auth::user()->id,
						]);
					}
				}	
			}
			
			return redirect()->route('admin.page.index')->with([
				'type' => 'success',
				'message' => '<span class="fa fa-check"></span> La page a bien été modifié.',
			]);
		}
	}
	
	public function destroy($id) 
	{
		$page = Page::find($id);
		if($page->photo_id != 1) {
			$last_photo = $page->photo;
			$page->photo_id = 1;
			$page->save();
			$last_photo->delete();	
		}
		$page->photos->each(function($item, $key) {
			$item->photo->delete();	
		});
		File::deleteDirectory(public_path('images/page/'.$page->id));
		$page->delete();
	}
	
	public function search(Request $request)
	{
		$input = $request->all();
		dd($input);
	}
}