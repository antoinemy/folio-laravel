<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use File;
use Validator;
use Auth;

use App\Http\Models\News;
use App\Http\Models\NewsContent;
use App\Http\Models\NewsCategory;
use App\Http\Models\NewsCategoryContent;
use App\Http\Models\NewsPhoto;
use App\Http\Models\Language;

class NewsCategoryController extends Controller
{
	private $rules = [

	];
	
	public function index() 
	{
		$data['meta_title'] = 'Locabike - Gestion des catégories d\'actualités';
		$data['categories'] = NewsCategory::all();
		
		return view('admin.category_news.index', $data);
	}
	
	public function create() 
	{
		$data['meta_title'] = 'Locabike - Création d\'une nouvelle catégorie d\'actualité';
		$data['categories'] = NewsCategory::all();
		$data['languages'] = Language::all();
		
		return view('admin.category_news.create', $data);
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
			$category = NewsCategory::create([
				'is_visible' 		=> isset($input['is_visible']) ? 1 : 0,
				
				'created_by' 		=> Auth::user()->id,
				'updated_by' 		=> Auth::user()->id,
			]);
			
			if($languages = Language::all()) 
			{
				foreach($languages as $l) 
				{
					NewsCategoryContent::create([
						'news_category_id'		=> $category->id,
						'language_id'			=> $l->id,
						
						'meta_title'			=> $input['meta_title_'.$l->short_name],
						'meta_desc'				=> $input['meta_desc_'.$l->short_name],
						'name'					=> $input['name_'.$l->short_name],
						'desc'					=> $input['desc_'.$l->short_name],
						'content'				=> $input['content_'.$l->short_name],
						
						'created_by' 			=> Auth::user()->id,
						'updated_by' 			=> Auth::user()->id,
					]);
				}	
			}
			
			if(isset($input['image']) && is_uploaded_file($input['image'])) 
			{
				$dir = public_path('images/categories/news/'.$category->id.'/small');
				if(!File::isDirectory($dir)) {
					File::makeDirectory($dir, 0777, true);
				}
				
				$image = Image::make($input['image'])
					->fit(100, 100)
					->save($dir.'/original.jpg');
				
				$category->has_image = 1;
				$category->save();
			}
			
			return redirect()->route('admin.category_news.index')->with([
				'type' 		=> 'success',
				'message' 	=> '<span class="fa fa-check"></span> La catégorie d\'actualités a bien été créé.',
			]);
		}
	}
	
	public function edit($id) 
	{
		$data['meta_title'] = 'Locabike - Modification d\'une catégorie d\'actualité';
		$data['category'] = NewsCategory::find($id);
		$data['languages'] = Language::all();
		
		return view('admin.category_news.edit', $data);
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
			
			if($category = NewsCategory::find($id)) 
			{			
				$category->update([
					'is_visible' 		=> isset($input['is_visible']) ? 1 : 0,
					
					'updated_by' 		=> Auth::user()->id,
				]);
				
				if(count($category->contents) > 0) 
				{
					foreach($category->contents as $c) 
					{
						$c->update([							
							'meta_title'	=> $input['meta_title_'.$c->language->short_name],
							'meta_desc'		=> $input['meta_desc_'.$c->language->short_name],
							'name'			=> $input['name_'.$c->language->short_name],
							'desc'			=> $input['desc_'.$c->language->short_name],
							'content'		=> $input['content_'.$c->language->short_name],
							
							'updated_by' 	=> Auth::user()->id,
						]);
					}
				}
				
				if((isset($input['remove_photo']) && $input['remove_photo'] == "true") || 
				(isset($input['image']) && is_uploaded_file($input['image']) && $category->has_image == 1)) 
				{
					$category->has_image = 0;
					$category->save();
					
					$dir = public_path('images/categories/news/'.$category->id);
			        if(File::isDirectory($dir)) {
						File::deleteDirectory($dir);
					}
				}
				
				if(isset($input['image']) && is_uploaded_file($input['image'])) 
				{
					$dir = public_path('images/categories/news/'.$category->id.'/small');
					if(!File::isDirectory($dir)) {
						File::makeDirectory($dir, 0777, true);
					}
					
					$image = Image::make($input['image'])
						->fit(100, 100)
						->save($dir.'/original.jpg');
					
					$category->has_image = 1;
					$category->save();
				}
				
				return redirect()->route('admin.category_news.index')->with([
					'type' 		=> 'success',
					'message' 	=> '<span class="fa fa-check"></span> La catégorie d\'actualités a bien été modifié.',
				]);
			}
			else 
			{
				return redirect()->route('admin.category_news.index')->with([
					'type' 		=> 'danger',
					'message' 	=> '<span class="fa fa-times"></span> La catégorie d\'actualités sélectionnée n\'existe pas.',
				]);
			}
		}
	}
	
	public function destroy($id) 
	{
		if($category = NewsCategory::find($id)) 
		{    
			$dir = public_path('images/categories/news/'.$category->id);
	        if(File::isDirectory($dir)) {
				File::deleteDirectory($dir);
			}
			
	        $category->delete();

	        return redirect()->route('admin.category_news.index')->with([
				'type' 		=> 'danger',
				'message' 	=> '<span class="fa fa-times"></span> La catégorie d\'actualités a bien été supprimé.',
			]);
        }
        else 
        {
	        return redirect()->route('admin.category_news.index')->with([
				'type' 		=> 'danger',
				'message' 	=> '<span class="fa fa-times"></span> La catégorie d\'actualités sélectionnée n\'existe pas.',
			]);
        }
	}
}