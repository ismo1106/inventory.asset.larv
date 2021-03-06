<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $fillable = [
        'name',
        'url',
        'header',
        'order',
        'icon',
        'updated_by'
    ];

}
