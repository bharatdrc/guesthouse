<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the comments for the blog post.
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }

}
