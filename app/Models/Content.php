<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $table = 'contents';
    protected $fillable = ['id', 'id_priority', 'title', 'description', 'page_id', 'created_at', 'updated_at'];


    public function contentable()
    {
        return $this->morphTo();
    }

    public function languages()
    {
        return $this->morphMany(Languages::class, 'languageable');
    }
    public function images()
    {
        return $this->hasMany(Images::class, 'content_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }
}
