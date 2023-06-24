<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    use HasFactory;
    protected $table = 'category_contents';
    protected $fillable = ['id', 'title', 'id_priority', 'section_id',  'created_at', 'updated_at'];


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function contents()
    {
        return $this->morphMany(Content::class, 'contentable')->orderBy('id_priority','asc')->orderBy('id','asc');
    }
    public function languages()
    {
        return $this->morphMany(Languages::class, 'languageable');
    }
}
