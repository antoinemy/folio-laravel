<?php

namespace App\Http\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'folio_admins';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
	    'has_image',
	    'last_name',
	    'first_name',
	    'email',
	    'created_by',
	    'updated_by',
    ];

    protected $hidden = [
    	'password',
    	'remember_token'
    ];

    public function rights() {
		return $this->hasMany('App\Http\Models\AdminRight', 'admin_id');
    }

    public function has_right($id) {
	    foreach($this->rights as $right) {
		    if($right->right_id == $id) {
			    return true;
		    }
	    }
	    return false;
    }

    public function creator() {
		return $this->belongsTo('App\Http\Models\Admin', 'created_by');
    }

    public function updater() {
		return $this->belongsTo('App\Http\Models\Admin', 'updated_by');
    }
}
