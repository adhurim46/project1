<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UploadRequest extends Model {

    protected $fillable = ['hash', 'client_ip','filename'];

    public function upload(){
        return $this->belongsTo(Upload::class);
    }
   
}