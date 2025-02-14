<?php

namespace App\Models;

use App\Traits\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasThumbnail;
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'content',
    ];
    protected $appends = [
        'permalink',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPermalinkAttribute()
    {
        return route('site.post', $this);
    }
    public function getAuthorNameAttribute()
    {
        return $this->user?->name;
    }
    public function getDateAttribute()
    {
        return $this->created_at->format('d M, Y');
    }
    public static function generateSlug($name)
    {
        return Str::slug($name);
    }
    public function registerMediaCollections(): void
    {
        $this->registerThumbnail();

        //pdf
        $this->addMediaCollection('pdf')
            ->singleFile()
            ->acceptsMimeTypes([
                'application/pdf',
                'text/plain',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ]);
    }
    /*public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->format('webp')
            ->greyscale()
            ->quality(80)
            ->withResponsiveImages();
    }*/

}