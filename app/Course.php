<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

    protected $fillable  = [
        'title',
        'author_id',
        'banner',
        'about',
    ];

    public function author()
    {
        return $this->belongsTo('App\Admin');
    }
}
