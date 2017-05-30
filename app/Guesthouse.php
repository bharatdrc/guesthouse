<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guesthouse extends Model
{
	protected $fillable = [
		'name',
		'sender_name',
		'sender_email',
		'city_id',
		'image',
		'gallery'
	];

	/**
	 * Get the user that owns the task.
	 */
	public function city()
	{
		return $this->belongsTo(\App\City::class);
	}

	/**
	 * Get the user that owns the task.
	 */
	public function images()
	{
		return $this->hasMany(\App\Image::class,'foriegn_id')->where(['foriegn_table'=>'guesthouses','field_name'=>'image']);
	}

	/**
	 * Get the user that owns the task.
	 */
	public function galleries()
	{
		return $this->hasMany(\App\Image::class,'foriegn_id')->where(['foriegn_table'=>'guesthouses','field_name'=>'gallery']);
	}

    /**
     * Get the user that owns the task.
     */
    public function appartments()
    {
        return $this->hasMany(\App\Appartment::class);
    }
}
