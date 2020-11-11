<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Image;
 
class AjaxImageController extends Controller
{
    public function index() {
        return view('create');
    }
 
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $response =  Response()->json([
                "success" => false,
                "image" => ''
         ]);

         if ($files = $request->file('image')) 
         {
               $destinationPath = 'public/image/'; // upload path
               $imageName = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $imageName);
               $save['title'] = "$imageName";
         }
         
         $check = Image::insertGetId($save);

          $response =  Response()->json([
                "success" => true,
                "image" => $check
          ]);

 
        return Response()->json($response);
 
    }
}
