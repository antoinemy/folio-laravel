<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;

use Image;
use File;

class ImageController extends Controller
{
	// Admins

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

	// Pages

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

	public function page_normal($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/page/'.$id.'/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/original.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	// Articles

	public function article_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/article/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function article_normal($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/article/'.$id.'/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/original.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	// Projects

	public function project_small($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/project/'.$id.'/small/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/small.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}

	public function project_normal($id, $name) {
		$img = Image::cache(function($image) use ($id, $name) {
			$file = public_path('images').'/project/'.$id.'/'.$name.'.jpg';
			if(File::exists($file)) {
				$image->make($file);
			}
			else {
				$image->make(public_path('/images/default/original.jpg'));
			}
		}, 10, true);
		return $img->response('jpg');
	}
}
