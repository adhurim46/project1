<?php

namespace  App\Models;
use Illuminate\Database\Eloquent\Model;

class File extends Model{


    protected $fillable = ['name', 'file', 'mime','error','attachments_id'];


    public function filestore(){
        return $this->hasOne(FileStore::class);
    }

    public function downloadrequest(){
        return $this->belongsTo(DownloadRequest::class);
    }

    public function downloads(){
        return $this->hasMany(Download::class);
    }

    public function uploads(){
        return $this->hasMany(Upload::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

}

