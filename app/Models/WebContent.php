<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebContent extends Model
{
    protected $fillable = ['page', 'section', 'slug', 'title', 'value', 'type'];

    /**
     * Helper to get content easily with fallback
     */
    public static function get($slug, $default = '')
    {
        $content = self::where('slug', $slug)->first();
        
        if ($content && !empty($content->value)) {
            // For images, return asset path if not absolute
            if ($content->type === 'image' && !str_starts_with($content->value, 'http')) {
                return asset('storage/' . $content->value);
            }
            return $content->value;
        }

        return $default;
    }
}
