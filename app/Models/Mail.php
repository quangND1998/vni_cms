<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;
    protected $table = 'mails';
    protected $fillable = ['id', 'title', 'content', 'type', 'created_at', 'updated_at'];
}
