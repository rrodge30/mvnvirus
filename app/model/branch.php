<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $table="table_branches";
    protected $primaryKey = "id_branch";
   
    public function lists(){
        return $this->hasMany('App\model\item','branch_id');
    }

}
