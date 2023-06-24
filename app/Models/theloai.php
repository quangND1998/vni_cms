<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theloai extends Model
{
    use HasFactory;
    protected $table = "theloais";
    protected $fillable = [
        "id",
        "Ten",
        "TenKhongDau",
        "created_at",
        "updated_at"
    ];

  
    public function tintucs()
    {
        return $this->hasMany(TinTuc::class, 'idTheLoai');
    }
}
