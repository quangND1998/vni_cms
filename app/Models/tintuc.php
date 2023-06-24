<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tintuc extends Model
{
    use HasFactory;
    protected $table = "tintucs";
    protected $fillable = ['id', 'TieuDe', 'TieuDeKhongDau', 'NoiDung', 'Hinh', 'NoiBat', 'SoLuotXem', 'idTheLoai', 'created_at', 'updated_at'];
    public function theloai()
    {
        return $this->belongsTo(theloai::class, 'idTheLoai');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_tintuc', 'tintuc_id', 'tag_id');
    }

    public function languages()
    {
        return $this->morphMany(Languages::class, 'languageable');
    }
}
