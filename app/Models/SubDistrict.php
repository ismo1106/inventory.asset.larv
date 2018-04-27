<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDistrict extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];


    public $fillable = [        
        'name',
        'value',
        'city_id',        
		'created_by',
		'updated_by'
    ];

   
    protected $casts = [
        'id' => 'integer',        
		'name' => 'string',
		'value' => 'integer',
		'city_id' => 'integer',
		'created_by' => 'integer',
		'updated_by' => 'integer'		
    ];
}
