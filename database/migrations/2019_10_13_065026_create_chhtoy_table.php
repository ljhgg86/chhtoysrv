<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChhtoyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //用户
        Schema::create('clientusers', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('phone')->comment('电话');
            $table->integer('openid')->comment('微信用户唯一标识')->unique();
            $table->string('nickname')->comment('昵称');
            $table->string('headimgurl')->comment('头像');
            $table->integer('sex')->default(0)->comment('性别');
            $table->string('province');
            $table->string('city');
            $table->string('country');
            $table->boolean('status')->default(0)->comment('用户状态：0正常，1禁止');
            $table->index('phone');
            $table->timestamps();
        });

        //板块
        Schema::create('section', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',20)->comment('名称')->unique();
            $table->integer('order')->comment('排序');
            $table->boolean('delflag');
            $table->timestamps();
        });

        //类别：轮播图，资讯，滚动条。。。
        Schema::create('category', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name',20);
            $table->boolean('delflag')->default(0);
            $table->timestamps();
        });

        //具体板块种类：热门-轮播图。。。
        Schema::create('type', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name',20);
            $table->integer('section_id');
            $table->integer('category_id');
            $table->boolean('delflag')->default(0);
            $table->index(['section_id', 'category_id']);
            $table->timestamps();
        });

        //资讯信息
        Schema::create('infomation', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('type_id');
            $table->string('title',60)->comment('标题');
            $table->string('cover1',255)->comment('封面1');
            $table->string('cover2',255)->comment('封面2');
            $table->string('cover3',255)->comment('封面3');
            $table->longText('content')->comment('内容');
            $table->integer('readnum')->comment('阅读数');
            $table->integer('realnum')->comment('真实阅读数');
            $table->integer('toporder')->default(0)->comment('精华顺序');
            $table->tinyInteger('status')->default(0)->comment('状态：0草稿，1发布，2删除');
            $table->timestamp('publishtime')->comment('发布时间');
            $table->string('keywords')->comment('关键词');
            $table->string('subscripts')->comment('下角标');
            $table->boolean('commentflag')->default(0)->comment('开放评论');
            $table->index('type_id');
            $table->timestamps();
        });

        //产品种类
        Schema::create('producttype', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name',60);
            $table->boolean('delflag')->default(0);
            $table->timestamps();
        });

        //黄页
        Schema::create('yellowpage', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('type_id');
            $table->string('title',60)->comment('标题');
            $table->string('address')->comment('地址');
            $table->point('postion')->comment('位置');
            $table->string('phone')->comment('联系电话');
            $table->string('contactperson')->comment('联系人');
            $table->string('cover1',255)->comment('封面1');
            $table->string('cover2',255)->comment('封面2');
            $table->string('cover3',255)->comment('封面3');
            $table->longText('content')->comment('内容');
            $table->integer('readnum')->comment('阅读数');
            $table->integer('realnum')->comment('真实阅读数');
            $table->integer('toporder')->default(0)->comment('精华顺序');
            $table->tinyInteger('status')->default(0)->comment('状态：0草稿，1发布，2删除');
            $table->timestamp('publishtime')->comment('发布时间');
            $table->string('keywords')->comment('关键词');
            $table->string('subscripts')->comment('下角标');
            $table->boolean('commentflag')->default(0)->comment('开放评论');
            $table->index('type_id');
            $table->timestamps();
        });

        //产品种类-黄页
        Schema::create('producttype_yellowpage', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('producttype_id');
            $table->integer('yellowpage_id');
            $table->boolean('delflag')->default(0);
            $table->index(['producttype_id', 'yellowpage_id']);
            $table->timestamps();
        });

        //评论
        Schema::create('comment', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('yellowpage_id');
            $table->integer('clientusers_id');
            $table->string('content')->comment('内容');
            $table->boolean('status')->default(0)->comment('状态：0未审，1已审');
            $table->boolean('topflag')->default(0)->comment('置顶标志');
            $table->boolean('delflag')->default(0);
            $table->index(['clientusers_id', 'yellowpage_id']);
            $table->timestamps();
        });

        //记录
        Schema::create('visistlog', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('clientusers_id');
            $table->integer('infomation_id');
            $table->integer('yellowpage_id');
            $table->index(['clientusers_id', 'infomation_id']);
            $table->index(['clientusers_id', 'yellowpage_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientusers');
        Schema::dropIfExists('section');
        Schema::dropIfExists('category');
        Schema::dropIfExists('type');
        Schema::dropIfExists('infomation');
        Schema::dropIfExists('producttype');
        Schema::dropIfExists('yellowpage');
        Schema::dropIfExists('producttype_yellowpage');
        Schema::dropIfExists('comment');
        Schema::dropIfExists('visistlog');
    }
}
