<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuesthouseController extends Controller
{
//http://stackoverflow.com/questions/32857619/validating-dynamically-added-input-fields-in-laravel-5
    protected $rules = [
        'name' => 'required|max:255',
        'sender_name' => 'required|max:255',
        'sender_email' => 'required|email',
       // 'image' => 'required',
       // 'gallery' => 'required',
        'appartments.*.name' => 'required',
        //'appartments.*.image' => 'required',
      //  'appartments.*.gallery' => 'required'
    ];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guesthouses = \App\Guesthouse::where('hidden', 0)
            ->orderBy('name', 'desc')
            ->get();
        return view('guesthouse/index', array('guesthouses' => $guesthouses));
    }

    /**
     * Show the region add form.
     *
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        $cities = \App\City::where('hidden', 0)
            ->orderBy('name', 'desc')
            ->get();
        $citiesArray = array();
        foreach ($cities as $key => $city) {
            $citiesArray[$city->id] = $city->name;
        }
        return view('guesthouse/newForm', array('citiesArray' => $citiesArray));
    }

    /**
     * Show the region add form.
     * @params Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $imageRules = [
           'image' => 'required',
           'gallery' => 'required',
           'appartments.*.image' => 'required',
           'appartments.*.gallery' => 'required'
        ];
        $this->rules = array_merge($this->rules,$imageRules);

        $this->validate($request, $this->rules);

        $guesthouse = ['name' => $request->name, 'sender_name' => $request->sender_name, 'sender_email' => $request->sender_email, 'city_id' => $request->city_id, 'image' => 1, 'gallery' => 1];

        $currentGuesthouse = \App\Guesthouse::create($guesthouse);

        $currentGuesthouseId = $currentGuesthouse->id;
        /* save image and gallery for guesthouse start*/
        if($request->hasFile('gallery')){

            foreach ( $request->file('gallery') as $singleImage) {
                if ($singleImage->isValid()) {
                    $this->saveImage($singleImage,$currentGuesthouseId,'guesthouses','gallery');
                }
            }

        }
        if($request->hasFile('image')){
            $this->saveImage($request->file('image'),$currentGuesthouseId,'guesthouses','image');
        }
        /* save image and gallery for guesthouse end */


        $appartments = [];
        foreach ($request->appartments as $key => $appartment) {
            $appartment = new \App\Appartment(['name' => $appartment['name'], 'image' => 1, 'gallery' => 1,'guesthouse_id'=>$currentGuesthouseId]);
            $appartment->save();
            /* save image and gallery for guesthouse start*/
            if($request->hasFile('appartments.'.$key.'.gallery')){
                foreach ( $request->file('appartments.'.$key.'.gallery') as $singleImage) {
                    if ($singleImage->isValid()) {
                        $this->saveImage($singleImage,$appartment->id,'appartments','gallery');
                    }
                }

            }
            if($request->hasFile('appartments.'.$key.'.image')){
                $this->saveImage($request->file('appartments.'.$key.'.image'),$appartment->id,'appartments','image');
            }
            /* save image and gallery for guesthouse end */
        }

        //$currentGuesthouse->appartments()->saveMany($appartments);
        return redirect('listguesthouse');
    }


    /**
     * Show the region add form.
     * @params UploadedFile $files
     * @params integer $id
     * @params string $table
     * @params string $field
     * @return void
     */
    public function saveImage($file,$id,$table,$field){
        $destinationFolder = public_path('imgs\\');
        if ($file->isValid()) {
            $random =rand(1,100);
            $image = new \App\Image([
                'image_name' => $random.$file->getClientOriginalName(),
                'image_extension' => $file->getClientOriginalExtension(),
                'field_name' => $field,
                'image_path' => $destinationFolder,
                'foriegn_table' => $table,
                'foriegn_id' => $id,
            ]);

            $file->move($destinationFolder, $random . $file->getClientOriginalName());
            //dd($destinationFolder);
            $image->save();
        }
    }

    /**
     * Show the region add form.
     * @params integer $id
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        $cities = \App\City::where('hidden', 0)
            ->orderBy('name', 'desc')
            ->get();
        $citiesArray = array();
        foreach ($cities as $key => $city) {
            $citiesArray[$city->id] = $city->name;
        }

        $guesthouse = \App\Guesthouse::find($id);
        return view('guesthouse/editForm', array('citiesArray' => $citiesArray, 'guesthouse' => $guesthouse));
    }

    /**
     * Show the region add form.
     * @params Request $request
     * @params integer $id
     * @return \Illuminate\Http\Response
     */
    public function updateGuesthouse(Request $request, $id)
    {
        $destinationFolder = public_path('imgs//');

        foreach ($request->appartments as $key => $appartment) {

            if(!\App\Appartment::find($appartment['appartment_id'])) {


                $imageRules = [
                    'appartments.'.$key.'.gallery' => 'required',
                    'appartments.'.$key.'.image' => 'required',
                ];

                $this->rules = array_merge($this->rules,$imageRules);

            }


        }



       // dd($this->rules);
        $this->validate($request, $this->rules);

        $guesthouse = \App\Guesthouse::find($id);
        $guesthouse->name = $request->name;
        $guesthouse->sender_name = $request->sender_name;
        $guesthouse->sender_email = $request->sender_email;
        $guesthouse->city_id = $request->city_id;
        $guesthouse->save();

        if ($request->hasFile('gallery')) {
            $galleries = $guesthouse->galleries;

            //Delete all physical copy of old image
            foreach ($galleries as $gallery) {
                \File::delete($destinationFolder . $gallery->image_name);
            }
            // Delete from Database
            $galleries->delete();

            foreach ($request->file('gallery') as $singleImage) {
                if ($singleImage->isValid()) {
                    $this->saveImage($singleImage,$guesthouse->id,'guesthouses','gallery');
                }
            }

        }
        if ($request->hasFile('image')) {
            $images = $guesthouse->images;

            foreach ($images as $image) {
                \File::delete($destinationFolder . $image->image_name);
            }
            $images->delete();
            $this->saveImage($request->file('image'),$guesthouse->id,'guesthouses','image');
        }

        $apartmentIds = [];
        //dd($request);
        foreach ($request->appartments as $key => $appartment) {
            $appartmentObject =  \App\Appartment::firstOrNew(['id'=>$appartment['appartment_id']]);
            //$appartment->name = $appartment['name'];
            //(['name' => $appartment['name'],'id'=>$key]);
            $appartmentObject->fill(['name' => $appartment['name'],'gallery' => 1,'image'=>1,'guesthouse_id'=>$guesthouse->id])->save();
           // $appartmentObject->updateOrCreate(['id'=>$appartment['appartment_id']], ['name' => $appartment['name'],'gallery' => 1,'image'=>1,'guesthouse_id'=>$guesthouse->id]);
            //dd($appartmentObject);
            $apartmentIds[] = $appartment['appartment_id'];
            /* save image and gallery for guesthouse start*/
            if($request->hasFile('appartments.'.$key.'.gallery')){
                $galleries = $appartmentObject->galleries();
                //dd($galleries);
                foreach ($galleries as $gallery) {
                    \File::delete($destinationFolder . $gallery->image_name);
                }

                if(count($galleries)>0)
                    $galleries->delete();
                foreach ( $request->file('appartments.'.$key.'.gallery') as $singleImage) {
                    if ($singleImage->isValid()) {
                        $this->saveImage($singleImage,$appartmentObject->id,'appartments','gallery');
                    }
                }

            }
            if($request->hasFile('appartments.'.$key.'.image')){
                $images = $appartmentObject->images();

                foreach ($images as $image) {
                    \File::delete($destinationFolder . $image->image_name);
                }
                if(count($images)>0)
                    $images->delete();
                $this->saveImage($request->file('appartments.'.$key.'.image'),$appartmentObject->id,'appartments','image');
            }
            /* save image and gallery for guesthouse end */
        }
        \App\Appartment::where('guesthouse_id', $guesthouse->id)->whereNotIn('id', $apartmentIds)->delete();
        return redirect('listguesthouse');
    }
}
