<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    protected $table = 'folio_rights';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
	    'name',
	    'created_by',
	    'updated_by',
    ];

    protected $hidden = [];

    public function creator() {
		return $this->belongsTo('App\Http\Models\Admin', 'created_by');
    }

    public function updater() {
		return $this->belongsTo('App\Http\Models\Admin', 'updated_by');
    }
}
