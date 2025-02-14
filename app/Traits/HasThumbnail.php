<?php

namespace App\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasThumbnail
{
    public function getThumbnail()
    {
        return $this->getFirstMedia('thumbnail');
    }
    public function getThumbnailUrl($conversion = '')
    {
        return $this->getFirstMediaUrl('thumbnail', $conversion);
    }
    public function setThumbnail($file)
    {
        return $this->addMedia($file)->toMediaCollection('thumbnail');
    }
    public function deleteThumbnail()
    {
        return $this->clearMediaCollection('thumbnail');
    }

    public function registerThumbnail()
    {

        $config = array_merge(config('thumbnails.default', []), config("thumbnails.{$this->table}", []));
        //dd($config);
        $collection_name = data_get($config, 'collection_name');
        if ($collection_name) {
            $collection = $this->addMediaCollection($collection_name);
            $mime_types = data_get($config, 'mime_type');
            if ($mime_types) {
                $collection->acceptsMimeTypes($mime_types);
            }
            $single = data_get($config, 'single', false);
            if ($single) {
                $collection->singleFile();
            }
            $fallback_url = data_get($config, "fallback_url");
            if ($fallback_url) {
                $collection->useFallbackUrl($fallback_url);
            }
            $fallback_path = data_get($config, "fallback_path");
            if ($fallback_path) {
                $collection->useFallbackPath($fallback_path);
            }
            $conversions = data_get($config, 'conversions');
            $conversions_format = data_get($config, 'format');
            $conversions_quality = data_get($config, 'quality');
            $conversions_queued = data_get($config, 'queued');
            $conversions_responsive = data_get($config, 'responsive');
            //dd($conversions_responsive);
            if ($conversions) {
                $collection->registerMediaConversions(function (?Media $media = null) use ($collection_name, $conversions, $conversions_format, $conversions_quality, $conversions_responsive, $conversions_queued) {
                    foreach ($conversions as $key => $value) {
                        //create conversion
                        $conversion = $this->addMediaConversion($key);

                        //width
                        $width = data_get($value, 'width');
                        if ($width) {
                            $conversion->width($width);
                        }

                        //height
                        $height = data_get($value, 'height');
                        if ($height) {
                            $conversion->height($height);
                        }

                        //quality
                        $quality = data_get($value, 'quality', $conversions_quality);
                        if ($quality) {
                            $conversion->quality($quality);
                        }

                        //format
                        $format = data_get($value, "format", $conversions_format);
                        if ($format) {
                            $conversion->format($format);
                        }

                        //responsive
                        $responsive = data_get($value, "responsive", $conversions_responsive);
                        //dd($responsive);
                        if ($responsive) {
                            $conversion->withResponsiveImages(true);
                        }

                        //queued
                        $queued = data_get($value, "queued", $conversions_queued);
                        if ($queued) {
                            $conversion->queued();
                        } else {
                            $conversion->nonQueued();
                        }
                    }
                });
            }
        }
    }
}
