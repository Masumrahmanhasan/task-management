<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::boot();

        static::creating(function (self $category){
            $category->slug = Str::slug($category->name);
            if (self::query()->where('slug', $category->slug)->exists()){
                $category->slug = $category->slug . '-' . Str::random(5); // guaranteed unique slug
            }
        });
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category')
            ->withTimestamps();
    }

}
