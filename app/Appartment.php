<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appartment extends Model
{
    protected $fillable = [
        'name',
        'image',
        'gallery',
        'guesthouse_id'
    ];

    /**
     * Get the user that owns the task.
     */
    public function images()
    {
        return $this->hasMany(\App\Image::class,'foriegn_id')->where(['foriegn_table'=>'appartments','field_name'=>'image']);
    }

    /**
     * Get the user that owns the task.
     */
    public function galleries()
    {
        return $this->hasMany(\App\Image::class,'foriegn_id')->where(['foriegn_table'=>'appartments','field_name'=>'gallery']);
    }
}
