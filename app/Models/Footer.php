<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $table = 'footers';
    protected $fillable = ['id',  'name', 'created_at', 'updated_at'];

    public function sections()
    {
        return $this->hasMany(Section::class, 'footer_id');
    }
}
