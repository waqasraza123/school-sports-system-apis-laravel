<?php

namespace App\Http\Controllers;

use App\Social;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::where('school_id', $this->schoolId)->get();

        return view('sponsors.show', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sponsors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($_POST['name'])) {
            $url = "https://twitter.com/users/username_available?username=Microsoftasdasd";
            $content = @file_get_contents($url);

            if (($json_data = json_decode($content, 1)) == NULL) {
                echo 0;
            } else {
                //print_r($json_data);
                if (!empty($json_data[0]['screen_name'])) {
                    // user exists
                    echo 1;
                }
            }

            exit;
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'bio' => 'required',
            'email' => 'required|email|unique:sponsors,email',
            'address' => 'required',
            'phone' => 'required',
            'photo' => 'required',
            'logo' => 'required'
        ]);

        $photo = "";
        $logo = "";

        $json = json_decode(Input::get('image_scale'), true);
        $fileName = "";
        if (Input::file('photo') != null) {

            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;

            $destinationPath = "/uploads/sponsors/"; // upload path

            $img = Image::make(Input::file('photo'));
            $img->widen((int)($img->width() * $json['scale']));
            $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
            $img->encode();

            $filesystem = Storage::disk('s3');
            $filesystem->put($destinationPath . $fileName, $img->__toString(), 'public');
        }

        $json1 = json_decode(Input::get('image_scale'), true);
        if(Input::file('logo') != null){
            $extension1 = Input::file('photo')->getClientOriginalExtension();
            $fileName1 = rand(1111, 9999) . '.' . $extension1;

            $destinationPath1 = "/uploads/sponsors/"; // upload path

            $img1 = Image::make(Input::file('school_logo'));
            $img1->widen((int)($img1->width() * $json1['scale']));
            $img1->crop((int)$json1['w'], (int)$json1['h'], (int)$json1['x'], (int)$json1['y']);
            $img1->encode();

            $filesystem1 = Storage::disk('s3');
            $filesystem1->put($destinationPath1 . $fileName1, $img1->__toString(), 'public');
        }


        $sponsor = Sponsor::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'logo' => $fileName == ""? null : 'https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName,
            'photo' => $fileName == ""? null : 'https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName,
            'address' => $request->input('address'),
            'school_id' => $this->schoolId,
            'color' => $request->input('color'),
            'video' => $request->input('video'),
            'tagline' => $request->input('tagline'),
            'bio' => $request->input('bio'),
            'url' => $request->input('url'),
            'order' => $request->input('order')
        ]);

        Social::create([
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'socialLinks_id' => $sponsor->id,
            'socialLinks_type' => 'App\Sponsor',
        ]);

        $response = array(
            'status' => 'success',
            'msg' => 'Sponsor Added successfully',
        );

        return Response::json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = Sponsor::where('id', $id)->first();
        $social = Social::where('socialLinks_id', $id)->where('socialLinks_type', 'App\Sponsor')->first();

        return view('sponsors.update', compact('sponsor', 'social'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'bio' => 'required',
            'email' => 'required|email|unique:sponsors,email,'.$id,
            'address' => 'required',
            'phone' => 'required'
        ]);

        $photo = "";
        $logo = "";
        $logo2 = "";

        $checkImages = Sponsor::where('id', $id)->first();

        $json = json_decode(Input::get('image_scale'), true);
        if (Input::file('photo') != null) {
            //delete old picture
            $fileName = $checkImages->photo;
            $filesystem = Storage::disk('s3');
            $imagePath = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName);
            $filesystem->delete(end($imagePath));

            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;

            $destinationPath = "/uploads/sponsors/"; // upload path

            $img = Image::make(Input::file('photo'));
            $img->widen((int)($img->width() * $json['scale']));
            $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
            $img->encode();

            $filesystem = Storage::disk('s3');
            $filesystem->put($destinationPath . $fileName, $img->__toString(), 'public');
            $photo='https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName;
        }
        //check if image is already in db
        else{
            if($checkImages->photo != null){
                $photo = $checkImages->photo;
            }
            else{
                $photo = null;
            }
        }

        $json1 = json_decode(Input::get('image_scale1'), true);
        if (Input::file('school_logo') != null) {

            //delete old picture
            $fileName2 = $checkImages->school_logo;
            $filesystem1 = Storage::disk('s3');
            $imagePath1 = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName2);
            $filesystem1->delete(end($imagePath1));

            $extension1 = Input::file('school_logo')->getClientOriginalExtension();
            $fileName1 = rand(1111, 9999) . '.' . $extension1;

            $destinationPath1 = "/uploads/sponsors/"; // upload path

            $img1 = Image::make(Input::file('school_logo'));
            $img1->widen((int)($img1->width() * $json1['scale']));
            $img1->crop((int)$json1['w'], (int)$json1['h'], (int)$json1['x'], (int)$json1['y']);
            $img1->encode();

            $filesystem1 = Storage::disk('s3');
            $filesystem1->put($destinationPath1 . $fileName1, $img1->__toString(), 'public');
            $logo='https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName;
        }
        //check if image is already in db
        else{
            if($checkImages->logo != null){
                $logo = $checkImages->logo;
            }
            else{
                $logo = null;
            }
        }

        Sponsor::find($id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'logo' => $logo,
            'photo' => $photo,
            'address' => $request->input('address'),
            'school_id' => $this->schoolId,
            'color' => $request->input('color'),
            'video' => $request->input('video'),
            'tagline' => $request->input('tagline'),
            'bio' => $request->input('bio'),
            'url' => $request->input('website'),
            'order' => $request->input('order')
        ]);

        Social::where('socialLinks_id', $id)->where('socialLinks_type', 'App\Sponsor')->update([
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'socialLinks_id' => $id,
            'socialLinks_type' => 'App\Sponsor',
        ]);

        $response = array(
            'status' => 'success',
            'msg' => 'Sponsor Updated successfully',
        );

        return Response::json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);

        $social = Social::where('socialLinks_id', $id)->where('socialLinks_type', 'App\Sponsor')->first();

        if ($social){
            $social->delete();
        }

        //delete old picture
        $fileName2 = $sponsor->school_logo;
        $filesystem1 = Storage::disk('s3');
        $imagePath1 = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName2);
        $filesystem1->delete(end($imagePath1));

        //delete old picture
        $fileName = $sponsor->photo;
        $filesystem = Storage::disk('s3');
        $imagePath = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName);
        $filesystem->delete(end($imagePath));

        $sponsor->delete();

        return redirect('/sponsors')->with('success', 'Sponsor Deleted Successfully');
    }
}
