<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
		 
	protected $rules = [
				'name' => 'required|max:255'
			];

	 /**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$cities = \App\City::where('hidden', 0)
               			->orderBy('name', 'desc')
              			               ->get();
		return view('city/index',array('cities'=>$cities));
	}

	 /**
	 * Show the region add form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function cityForm()
	{
		$regions = \App\Region::where('hidden', 0)
               			->orderBy('name', 'desc')
              			               ->get();
        		$regionsArray = array();
          		foreach ($regions as $key => $region) {
          			$regionsArray[$region->id] = $region->name;
          		}
		return view('city/cityForm',array('regionsArray'=>$regionsArray));
	}

	 /**
	 * Show the region add form.
	 * @params Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function createCity(Request $request)
	{
		$this->validate($request,$this->rules);

		\App\City::create($request->all());
		return redirect('index');
	}

	 /**
	 * Show the region add form.
	 * @params integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function editForm($id)
	{
		$city = \App\City::find($id);
		$regions = \App\Region::where('hidden', 0)
               			->orderBy('name', 'desc')
              			               ->get();
        		$regionsArray = array();
          		foreach ($regions as $key => $region) {
          			$regionsArray[$region->id] = $region->name;
          		}
		               	
		return view('city/editForm',array('city'=>$city,'regionsArray'=>$regionsArray));
	}

	 /**
	 * Show the region add form.
	 * @params Request $request
	 * @params integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateCity(Request $request, $id)
	{
		$this->validate($request,$this->rules);
		
		$city = \App\City::find($id);
		$city->name = $request->name;
		$city->region_id = $request->region_id;
		$city->save();
		return redirect('listcity');
	}
}
