<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    // public function __construct(array $attributes = [])
    // {
    //     $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

    //     parent::__construct($attributes);
    // }

     public function users() {
    
        return $this->morphedByMany(
            User::class,
            'model',
            'model_has_permissions',
            'permission_id',
            'model_id'
        );
            
     }
}
