<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    protected $table = 'folio_pages_types';
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
