<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Attachment extends Model {

    public function file(){
        return $this->hasMany(File::class);
    }

}