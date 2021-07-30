<?php
use Illuminate\Http\Client\Request;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Hash;
use App\Models\UploadRequests;
use Illuminate\Validation\Validator;
use App\Models\Upload;
use App\Http\Controllers\Controller;

class UploadRequest extends Controller {


    public function uploadfile(Request $request){

        $validator = Validator::make($request->all(),[
            'file' => 'required|image|image/gif|image/png|audio/wave|text/javascript|pdf',

        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()

            ],404);
        }

 
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $client_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $client_ip = $_SERVER['REMOTE_ADDR'];
        }

        $randomstring = Str::random(50);
        $hash = Hash::make($randomstring);

        $file = $request->file('file');

        UploadRequest::create([

            'client_ip' => $client_ip,
            'hash' => $hash,
        ]);


        return redirect()->away("Http://127.0.0.1:84/api/upload",'304',[
            'hash' => $hash,
            'client_ip' => $client_ip,
            'file' => $file->id

        ]);
    }
}