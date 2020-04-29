<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{

    use HasSlug;

    protected $fillable = ['name','description','phone','slug'];

	public function getSlugOptions() 
	{
		return SlugOptions::create()
		                  ->generateSlugsFrom('name')
		                  ->saveSlugsTo('slug');
	}
    
    //Estabelecendo Relacionemanto Um para Um
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //Estabelecendo Relacionemanto Um para Muitos
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
