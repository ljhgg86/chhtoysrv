<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'type';

    public function section(){
        return $this->belongsTo('Section','section_id','id');
    }

    public function category(){
        return $this->belongsTo('Category','category_id','id');
    }

    public function infomations(){
        return $this->hasMany('Infomation', 'type_id', 'id');
    }

    public function yellowpages(){
        return $this->hasMany('Yellowpage', 'type_id', 'id');
    }
}
