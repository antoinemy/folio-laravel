<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $table = 'folio_projects_categories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
	    'is_visible',
	    'has_image',
      'meta_title',
      'meta_desc',
      'name',
	    'created_by',
	    'updated_by',
    ];

    protected $hidden = [];

    public function projects() {
    return $this->hasMany('App\Http\Models\Project');
    }

    public function creator() {
		return $this->belongsTo('App\Http\Models\Admin', 'created_by');
    }

    public function updater() {
		return $this->belongsTo('App\Http\Models\Admin', 'updated_by');
    }
}
