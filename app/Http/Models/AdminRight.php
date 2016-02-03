<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRight extends Model
{
    protected $table = 'folio_admins_rights';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
	    'admin_id',
	    'right_id',
	    'can_show',
	    'can_create',
	    'can_edit',
	    'can_delete',
	    'can_right',
	    'created_by',
	    'updated_by',
    ];

    protected $hidden = [];

    public function admin() {
		return $this->belongsTo('App\Http\Models\Admin', 'admin_id');
    }

    public function right() {
		return $this->belongsTo('App\Http\Models\Right', 'right_id');
    }

    public function creator() {
		return $this->belongsTo('App\Http\Models\Admin', 'created_by');
    }

    public function updater() {
		return $this->belongsTo('App\Http\Models\Admin', 'updated_by');
    }
}
