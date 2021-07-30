<?php

namespace App\Models;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Request;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    protected $fillable = ['hash','client_ip','file_id'];


    public function file(){
        return $this->belongsTo(File::class);
    }



}