<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $fillable = ['id', 'title', 'sub_title', 'description','active', 'id_priority', 'page_id', 'theme_id', 'created_at', 'updated_at'];

    public function contents()
    {
        return $this->morphMany(Content::class, 'contentable')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');;
    }
    public function category_contents()
    {

        return $this->hasMany(CategoryContent::class, 'section_id');
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function languages()
    {
        return $this->morphMany(Languages::class, 'languageable');
    }

    public function cate_contents()
    {
        return $this->hasManyThrough(Content::class, CategoryContent::class, 'section_id', 'contentable_id')->where('contentable_type', "App\Models\CategoryContent");
    }
}
