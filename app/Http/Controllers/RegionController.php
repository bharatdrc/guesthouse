<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionController extends Controller
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
		$regions = \App\Region::where('hidden', 0)
               			->orderBy('name', 'desc')
              			               ->get();
		return view('region/index',array('regions'=>$regions));
	}

	 /**
	 * Show the region add form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function regionForm()
	{
		return view('region/regionForm');
	}

	 /**
	 * Show the region add form.
	 * @params Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function createRegion(Request $request)
	{
		$this->validate($request,$this->rules);

		\App\Region::create($request->all());
		return redirect('index');
	}

	 /**
	 * Show the region add form.
	 * @params integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function editForm($id)
	{
		$region = \App\Region::find($id);
        			
               	
		return view('region/editForm',array('region'=>$region));
	}

	 /**
	 * Show the region add form.
	 * @params Request $request
	 * @params integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateRegion(Request $request, $id)
	{
		$this->validate($request,$this->rules);
		
		$region = \App\Region::find($id);
		$region->name = $request->name;
		$region->save();
		return redirect('index');
	}
}
