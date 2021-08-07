<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\FileStore;
use App\Models\Attachment;
use App\Models\DownloadRequest;
class DownloadRequestController extends Controller {



    public function downloadRequests($id){

        $attachment = Attachment::find($id);
        $attachment_files = $attachment->file;


        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $client_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $client_ip = $_SERVER['REMOTE_ADDR'];
        }



        foreach($attachment_files as $file){

            $random = Str::random(40);
            $hash = Hash::make($random);

            DownloadRequest::create([
                'file_id' => $file->id,
                'hash' => $hash,
                'client_ip' => $client_ip
            ]);

            
            $filetostore = FileStore::where('file_id','=', $file->id)->fileserver->server_name;


            return redirect()->away("Http://127.0.0.1:84/api/download",302,[

                'file' => $file,
                'hash' => $hash
            ]);

        }

        return response()->json([

            'status' => 'success',
            'message' => "Product $attachment->attachment_name succesfuly downloaded"
        ]);
        
    }
}