<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = ['id', 'category_name', 'title', 'images', 'description'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name');
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion(name: 'thumb')
            ->width(300);
    }
    public function getNextAttribute()
    {
        return static::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
    public function getPreviousAttribute()
    {
        return static::where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }
}