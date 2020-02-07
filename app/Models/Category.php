<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'category';

    public function types(){
        return $this->hasMany('Type', 'category_id', 'id');
    }
}
