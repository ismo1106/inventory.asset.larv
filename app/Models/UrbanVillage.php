<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrbanVillage extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];


    public $fillable = [        
        'name',
        'postcode',
        'value',
        'sub_districts_id',        
		'created_by',
		'updated_by'
    ];

   
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
		'postcode' => 'string',
		'value' => 'integer',
		'sub_districts_id' => 'integer',
		'created_by' => 'integer',
		'updated_by' => 'integer'		
    ];
}
