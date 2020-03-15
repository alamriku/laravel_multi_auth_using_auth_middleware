<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function addImage(){
        $images = file_get_contents(base_path('resources/jsondata/data.json'));

        if(!empty($images)){

            $images=json_decode($images,true);
            $desc_images=array_reverse($images,true);
            $data=$desc_images;
        }else{

            $data=null;
        }

        return view('add_image')->with('images',$data);
    }
    public function submitData(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png|max:5000',
             'image_title'=>'required'
        ]);
        ;
        if($validation->fails()){
            return Response::json(array(
                'success' => false,
                'errors' => $validation->getMessageBag()->toArray()

            ));
        }else{
            if ($request->hasFile('image')) {
                $path = $this->uploadFile($request, 'image');
            } else {
                $path = '';
            }
            $jsonString = file_get_contents(base_path('resources/jsondata/data.json'));
            $data = json_decode($jsonString, true);
            $data[] = [$request->image_title,$path];
            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents(base_path('resources/jsondata/data.json'), stripslashes($newJsonString));
            $images = file_get_contents(base_path('resources/jsondata/data.json'));
            $images=json_decode($images,true);
            $desc_images=array_reverse($images,true);
            $data='';
            foreach ($desc_images as $key=>$r){
                $img_url = $r[1];
                $title = $r[0];
                $data .='<div class="card" id="'.$key.'" style="width: 20rem;">
                                <img class="card-img-top preview" src="'.$img_url.'" alt="Card image cap" width="150" height="150">
                                <div class="card-body">
                                <div id="marquee'.$key.'" class="height" style="height: 36px;">
                                <p id="str'.$key.'" class="card-title" style="white-space: nowrap;">'.$title.'</p>
                                </div>
                                    
                                      <input type="hidden" name="json_index" value="'.$key.'"/>
                                    <button  class="btn btn-danger btn_del">Delete</button>
                                </div>
                            </div>';
                $data .='<script>
                        var width =$("#marquee'.$key.'").innerHeight();
                            var str = $("#str'.$key.'").text().length;

                            if(str >= width){

                                $("#marquee'.$key.'").addClass(\'bounce\');
                                $(".height").innerHeight(50);

                            }else if(str <= width){

                              
                                $("#str'.$key.'").addClass("none_marquee");
                            }
                        </script>';
            }
            $data .='<script>
                         var heights = $(".height").map(function ()
                            {
                                return $(this).height();
                            }).get();

                            maxHeight = Math.max.apply(null, heights);
                            $(".height").innerHeight(maxHeight);
                            $(".none_marquee").css("padding-top","15px");
                        
                        </script>';
            return Response::json(array(
                'errors' => false,
                'success' => 'Record inserted successfully',
                'desc_images'=>$data

            ));
        }
    }

    public function deleteData(Request $request){
        $jsonString = file_get_contents(base_path('resources/jsondata/data.json'));
        $data = json_decode($jsonString, true);
        foreach ($data as $key=>$value){
            if($request->id == $key){
                $image_path =$value[1];  // Value is not URL but directory file path

                if(File::exists($image_path)) {
                     File::delete($image_path);

                }
                unset($data[$key]);
                $newdata=json_encode($data, JSON_PRETTY_PRINT);
                file_put_contents(base_path('resources/jsondata/data.json'), stripslashes($newdata));
                return Response::json(array(
                    'errors' => false,
                    'success' => 'Record inserted deleted',
                ));
                break;
            }
        }
    }
    public function uploadFile(Request $request, $file){
        if($request->file($file))
        {
            $image = $request->file($file);
            $destination = 'public/uploads/';

            $filename = Str::lower(
                pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                . '-'
                . uniqid()
                . '.'
                . $image->getClientOriginalExtension()
            );
            $image->move($destination, $filename);

            $path = 'public/uploads/' . $filename;

            return $path;
        }
    }
    public function searchImage(Request $request){
        $jsonString = file_get_contents(base_path('resources/jsondata/data.json'));
        $desc_images = json_decode($jsonString, true);
        $pattern = "/[".$request->text."]/";

        $data='';

        foreach ($desc_images as $key=>$r){

            if(preg_match($pattern, $r[0])){
                $img_url = $r[1];
                $title = $r[0];
                $data .='<div class="card" id="'.$key.'" style="width: 20rem;">
                                <img class="card-img-top preview" src="'.$img_url.'" alt="Card image cap" width="150" height="150">
                                <div class="card-body">
                                <div id="marquee'.$key.'" class="height" style="height: 36px;">
                                <p id="str'.$key.'" class="card-title" style="white-space: nowrap;">'.$title.'</p>
                                </div>
                                    
                                      <input type="hidden" name="json_index" value="'.$key.'"/>
                                    <button  class="btn btn-danger btn_del">Delete</button>
                                </div>
                            </div>';
                $data .='<script>
                        var width =$("#marquee'.$key.'").innerHeight();
                            var str = $("#str'.$key.'").text().length;

                            if(str >= width){

                                $("#marquee'.$key.'").addClass(\'bounce\');
                                $(".height").innerHeight(50);

                            }else if(str <= width){

                              
                                $("#str'.$key.'").addClass("none_marquee");
                            }
                        </script>';

            }

        }
        $data .='<script>
                         var heights = $(".height").map(function ()
                            {
                                return $(this).height();
                            }).get();

                            maxHeight = Math.max.apply(null, heights);
                            $(".height").innerHeight(maxHeight);
                            $(".none_marquee").css("padding-top","15px");

                        </script>';

        return Response::json(array(
            'desc_images'=>$data

        ));


    }

}
