<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::boot();
        static::creating(function (self $article){
            $article->slug = Str::slug($article->name);
            if (self::query()->where('slug', $article->slug)->exists()){
                $article->slug = $article->slug . '-' . Str::random(5); // guaranteed unique slug
            }
        });
    }

    public function getPublishedAtAttribute($value)
    {
        return Carbon::parse($value)->isoFormat('D MMM YYYY');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }
}
