<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
	public function index() {
		$data['meta_title'] = 'Tableau de bord';
		return view('admin.dashboard.index', $data);
	}
}