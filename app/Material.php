<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //

    protected $fillable = [
        'author_id',
        'media',
        'course_id',
        'info',
        'title',
    ];
}
