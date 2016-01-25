<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;

use Image;
use File;

class ImageController extends Controller
{
	public function admin_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/admin/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function page_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/page/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function news_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/news/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function news_photos($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/news/'.$id.'/photos/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function category_news_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/categories/news/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}



	// Products

	public function product_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/product/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function product_photos($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/product/'.$id.'/photos/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	// Category Product

	public function category_product_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/categories/product/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}
}
