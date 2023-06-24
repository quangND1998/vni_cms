<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    protected $table = 'headers';
    protected $fillable = ['id',  'name', 'created_at', 'updated_at'];

    public function sections()
    {
        return $this->hasMany(Section::class, 'header_id');
    }

}
