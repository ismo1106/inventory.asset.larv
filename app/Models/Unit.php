<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];


    public $fillable = [                
        'type', 
        'name',  
        'code',  
        'short_name',  
        'address',  
        'active',
        'created_by',
        'updated_by'
    ];
   
    protected $casts = [
        'id' => 'integer',        
        'type' => 'integer',
        'name' => 'string',
        'code' => 'string',
        'short_name' => 'string',
        'address' => 'string',        
        'active' => 'integer',  
        'created_by' => 'integer',
        'updated_by' => 'integer'		
    ];
}
