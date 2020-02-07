<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'section';

    public function types(){
        return $this->hasMany('Type', 'section_id', 'id');
    }
}
