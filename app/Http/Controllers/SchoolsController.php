<?php

namespace App\Http\Controllers;

use App\Opponent;
use App\School;
use App\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

$GLOBALS['admin'] = false;
class SchoolsController extends Controller
{

    //check if the user is admin
    public function checkAdmin(){
        if(Auth::check()){
            if(Auth::user()->email == 'admin@gmail.com'){
                $GLOBALS['admin'] = true;
            }
        }
    }

    //show all schools
    public function index()
    {
        $this->checkAdmin();
        if(!($GLOBALS['admin'])){

            if(Auth::check()){
                $schoolId = Auth::user()->school_id;
            }
            $social = Social::where('socialLinks_id', $schoolId)->first();
            $schools = School::where('school_email', '<>', 'admin@gmail.com')->get();
            $userSchool = School::where('id', $schoolId)->first();
            return view('pages.home', compact('schools', 'userSchool', 'social'))->with('success', 'please login as admin to add schools');
        }
        $schools = School::where('school_email', '<>', 'admin@gmail.com')->get();
        return view('schools.show', compact('schools'));
    }

    /**
     * generate api key
     * @return Redirect
     */
    function apiKey($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return ''.$randomString;
    }

    //save school to db
    public function store()
    {
        //al inputs
        $file = Input::all();
        $rules = array(
            'name' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'short_name' => 'required',
            'bio' => 'required',
            'phone' => 'required',
            'website' => 'required',
            'school_color' => 'required',
            'school_color2' => 'required',
            'school_color3' => 'required',
            'school_tagline' => 'required',
            'app_name' => 'required',
            'school_email' => 'required',
            'livestream_url' => 'required',
            'school_logo' => 'required',
            'photo' => 'required',
            'phone' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        //validate
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            // send back to the page with the input data and errors
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else
        {
            //get the api key
            $api = $this->apiKey();
            if (School::where('api_key', $api)->first()){
                $api = $this->apiKey();
            }

            $photo = "";
            $logo = "";

            $json = json_decode(Input::get('image_scale'), true);
            if (Input::file('photo') != null) {

                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;

                $destinationPath = "/uploads/schools/"; // upload path

                $img = Image::make(Input::file('photo'));
                $img->widen((int)($img->width() * $json['scale']));
                $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
                $img->encode();

                $filesystem = Storage::disk('s3');
                $filesystem->put($destinationPath . $fileName, $img->__toString(), 'public');
                $photo='https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName;
            }

            $json1 = json_decode(Input::get('image_scale'), true);
            if (Input::file('school_logo') != null) {

                $extension1 = Input::file('photo')->getClientOriginalExtension();
                $fileName1 = rand(1111, 9999) . '.' . $extension1;

                $destinationPath1 = "/uploads/schools/"; // upload path

                $img1 = Image::make(Input::file('school_logo'));
                $img1->widen((int)($img1->width() * $json1['scale']));
                $img1->crop((int)$json1['w'], (int)$json1['h'], (int)$json1['x'], (int)$json1['y']);
                $img1->encode();

                $filesystem1 = Storage::disk('s3');
                $filesystem1->put($destinationPath1 . $fileName1, $img1->__toString(), 'public');
                $logo='https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath1 . $fileName1;
            }

            $school = School::create(array('name' => $file['name'],
                'short_name' => $file['short_name'],
                'bio' => $file['bio'],
                'adress' => $file['adress'],
                'city' => $file['city'],
                'state' => $file['state'],
                'zip' => $file['zip'],
                'phone' => $file['phone'],
                'website' => $file['website'],
                'school_color'=>$file['school_color'],
                'school_color2'=>$file['school_color2'],
                'school_color3'=>$file['school_color3'],
                'school_tagline'=>$file['school_tagline'],
                'app_name'=>$file['app_name'],
                'school_email'=>$file['school_email'],
                'video'=>$file['video'],
                'livestream_url'=>$file['livestream_url'],
                'api_key'=> $api,
                'school_logo' => $logo,
                'photo' => $photo
            ));

            //save the social media links to social_links table
            Social::create(array(
                'twitter' => $file['twitter'],
                'facebook' => $file['facebook'],
                'instagram' => $file['instagram'],
                'youtube' => $file['youtube'],
                'vimeo' => $file['vimeo'],
                'socialLinks_id' => $school->id,
                'socialLinks_type' =>'App\School',
            ));

            Session::flash('success', 'Created successfully');
            if($GLOBALS['admin']){
                return redirect('/schools');
            }
            else{
                return redirect('/home');
            }
        }
    }

    //show edit form
    public function showEditForm($id){
        $schools = School::find($id);

        $social = Social::where('socialLinks_id', $id)->where('socialLinks_type', 'App\Sponsor')->first();

        return view('schools.update_schools_form', compact('schools', 'social'));
    }

    public function edit($id){

        //al inputs
        $file = Input::all();
        $rules = array(
            'name' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        //validate
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            // send back to the page with the input data and errors
            return redirect()->back()->withInput()->withErrors($validator);
        }

        else{
            //get the api key
            $apiKey = School::select('api_key')->where('id', $id)->first();
            $apiKey = $apiKey->api_key;

            $school = School::where('id','=', $id)->first();
            $photo = $school->photo;
            $logo = $school->school_logo;

            $json = json_decode(Input::get('image_scale'), true);
            if (Input::file('photo') != null) {
                //delete old picture
                $fileName = $school->photo;
                $filesystem = Storage::disk('s3');
                $imagePath = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName);
                $filesystem->delete(end($imagePath));

                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;

                $destinationPath = "/uploads/schools/"; // upload path

                $img = Image::make(Input::file('photo'));
                $img->widen((int)($img->width() * $json['scale']));
                $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
                $img->encode();

                $filesystem = Storage::disk('s3');
                $filesystem->put($destinationPath . $fileName, $img->__toString(), 'public');
                $photo='https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName;
            }

            $json1 = json_decode(Input::get('image_scale'), true);
            if (Input::file('school_logo') != null) {

                //delete old picture
                $fileName2 = $school->school_logo;
                $filesystem1 = Storage::disk('s3');
                $imagePath1 = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName2);
                $filesystem1->delete(end($imagePath1));

                $extension1 = Input::file('photo')->getClientOriginalExtension();
                $fileName1 = rand(1111, 9999) . '.' . $extension1;

                $destinationPath1 = "/uploads/schools/"; // upload path

                $img1 = Image::make(Input::file('school_logo'));
                $img1->widen((int)($img1->width() * $json1['scale']));
                $img1->crop((int)$json1['w'], (int)$json1['h'], (int)$json1['x'], (int)$json1['y']);
                $img1->encode();

                $filesystem1 = Storage::disk('s3');
                $filesystem1->put($destinationPath1 . $fileName1, $img1->__toString(), 'public');
                $logo='https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath1 . $fileName1;
            }

                $school = School::where('id', '=', $id)->first()->update(array(

                    'name' => $file['name'],
                    'short_name' => $file['short_name'],
                    'bio' => $file['bio'],
                    'adress' => $file['adress'],
                    'city' => $file['city'],
                    'state' => $file['state'],
                    'zip' => $file['zip'],
                    'phone' => $file['phone'],
                    'website' => $file['website'],
                    'school_color'=>$file['school_color'],
                    'school_color2'=>$file['school_color2'],
                    'school_color3'=>$file['school_color3'],
                    'school_tagline'=>$file['school_tagline'],
                    'app_name'=>$file['app_name'],
                    'school_email'=>$file['school_email'],
                    'video'=>$file['video'],
                    'api_key'=>$apiKey,
                    'livestream_url'=>$file['livestream_url'],
                    'school_logo' => $logo,
                    'photo' => $photo));

                //save the social media links to social_links table
                Social::where('socialLinks_id', $id)->first()->update(array(
                    'twitter' => $file['twitter'],
                    'facebook' => $file['facebook'],
                    'instagram' => $file['instagram'],
                    'youtube' => $file['youtube'],
                    'vimeo' => $file['vimeo'],
                    'socialLinks_id' => $id,
                    'socialLinks_type' =>'App\School',
                ));


                Session::flash('success', 'Updated successfully');
                if($GLOBALS['admin']){
                    return redirect('/schools');
                }
                else{
                    return redirect('/home');
                }
        }
    }

    /**
     * delete school
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $school = School::findOrFail($id);

        $fileName = $school->photo;
        $filesystem = Storage::disk('s3');
        $imagePath = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName);
        $filesystem->delete(end($imagePath));

        $fileName2 = $school->school_logo;
        $filesystem1 = Storage::disk('s3');
        $imagePath1 = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName2);
        $filesystem1->delete(end($imagePath1));

        foreach ($school->opponents as $op){
            $op->delete();
        }
        foreach ($school->staff as $op){
            $op->delete();
        }
        $school->delete();
        Session::flash('flash_message_s', 'School successfully deleted!');
        return redirect()->back();
    }

    //add school view
    public function showForm(){
        return view('schools.modals.schools_form');
    }
}
