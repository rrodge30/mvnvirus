<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $table="table_items";
    protected $primaryKey = "id_items";

    public function branch(){
        return $this->belongsTo('App\model\branch','branch_id','id_branch');
    }

}
