<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;
    
    protected $fillable=['name','description','slug'];

    
    public function getSlugOptions()
    {
        return SlugOptions::create()
                            ->generateSlugFrom('name')
                            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
