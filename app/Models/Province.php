<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];


    public $fillable = [        
        'name',
        'value',           
        'created_by',
        'updated_by'
    ];
   
    protected $casts = [
        'id' => 'integer',        
        'name' => 'string',
        'value' => 'integer',        
        'created_by' => 'integer',
        'updated_by' => 'integer'		
    ];
}
