<?php
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
use App\Models\UploadRequest;
use App\Models\File;
use App\Models\Upload;
use App\Models\FileStore;
use App\Models\DownloadRequest;
use App\Models\Download;

class FileServerController extends Controller {

    public function download(Request $request){

        $hash = $request->hash;
        $client_ip = $request->client_ip;
        $file_id = $request->file_id;

        $downloadrequest = Downloadrequest::where('hash', $hash)->where('client_ip',$client_ip)->where('file_id',$file_id);

        if($downloadrequest){

            $filestore =  FileStore::where('file_id',$file_id)->get();
            $filename = $filestore->file->file_name;
            $filepath = $filestore->file->file_path;
            $fileserver = $filestore->fileserver->server_name;

            Download::create([

                'file_id ' => $file_id,
                'client_ip' => $client_ip
            ]);

            return [

                'filename' => $filename,
                'filepath' => $filepath,
                'fileserver' => $fileserver

            ];
            



    }else {
        return false;
    }
}


    public function upload(Request $request){
        $hash  = $request->hash;
        $client_ip = $request->client_ip;

        $file = $request->file('file');
        $fileName = $request->file('file')->getOriginalName();

        $uploadRequest = UploadRequest::where('hash', $hash)->where('client_ip', $client_ip);

        if($uploadRequest) {
            File::create([

                'name' => $fileName
            ]);
            $file = File::where('fileName', $fileName)->get();

            Upload::create([

                'hash' => $hash,
                'client_ip' => $client_ip,
                'file_id' => $file->id
            ]);
            return [
                'file' => $file
            ];

        }else {
            return false;
        }
    }


}