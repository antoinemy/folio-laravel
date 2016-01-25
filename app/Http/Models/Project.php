<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'folio_projects';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
	    'project_category_id',
	    'is_visible',
	    'has_image',
      'meta_title',
      'meta_desc',
      'name',
      'desc',
      'content',
	    'created_by',
	    'updated_by',
    ];

    protected $hidden = [];

    public function category() {
		return $this->belongsTo('App\Http\Models\ArticleCategory', 'project_category_id');
    }

    public function creator() {
		return $this->belongsTo('App\Http\Models\Admin', 'created_by');
    }

    public function updater() {
		return $this->belongsTo('App\Http\Models\Admin', 'updated_by');
    }
}
