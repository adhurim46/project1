<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class FileStore extends Model {


    protected $fillable = ['filename','filepath'];

    public function fileserver(){
        return $this->belongsTo(FileServer::class);
    }

    public function file(){
        $this->belongsTo(File::class);
    }

}