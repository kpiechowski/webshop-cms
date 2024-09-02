<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'page_sections' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }


    public function metas()
    {
        return $this->hasMany(PageMeta::class);
    }

    public function getAuthorName()
    {
        return $this->author()->first()->name;
    }
}
