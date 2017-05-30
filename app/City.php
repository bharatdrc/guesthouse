<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    protected $fillable = ['name','region_id'];

     /**
     * Get the user that owns the task.
     */
    public function region()
    {
        return $this->belongsTo(\App\Region::class);
    }

}
