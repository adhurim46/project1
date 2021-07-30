<?php
 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DownloadRequest extends Model
{
    use HasFactory;


    public function file(){
        return $this->belongsTo(File::class);
    }
}
