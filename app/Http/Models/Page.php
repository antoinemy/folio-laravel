<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'folio_pages';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
	    'page_type_id',
	    'is_visible',
	    'has_image',
      'link_github',
      'link_bitbucket',
	    'created_by',
	    'updated_by',
    ];

    protected $hidden = [];

    public function type() {
		return $this->belongsTo('App\Http\Models\PageType', 'page_type_id');
    }

    public function creator() {
		return $this->belongsTo('App\Http\Models\Admin', 'created_by');
    }

    public function updater() {
		return $this->belongsTo('App\Http\Models\Admin', 'updated_by');
    }
}
