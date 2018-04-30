<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lookup extends Model {

    use SoftDeletes;

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    public $fillable = [
        'type',
        'name',
        'value',
        'order_no',
        'created_by',
        'updated_by'
    ];
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'name' => 'string',
        'value' => 'integer',
        'order_no' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

}
