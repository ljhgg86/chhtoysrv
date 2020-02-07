<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yellowpage extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'yellowpage';

    public function type(){
        return $this->belongsTo('Type','type_id','id');
    }

    public function getInfoByTypeid($typeid){
        return $this->where('type_id',$typeid)
                    ->orderBy('toporder','desc')
                    ->orderBy('created_at','desc')
                    ->orderBy('id','desc')
                    ->paginate(20);
    }
}
