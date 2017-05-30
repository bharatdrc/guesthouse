<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected $fillable = [
			'image_name',
			'image_path',
			'image_extension',
			'field_name',
			'foriegn_table',
			'foriegn_id'
		];

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules()
	{
	   return [
		   'image_name' => 'alpha_num | required | unique:images',
	   ];
	}
}
