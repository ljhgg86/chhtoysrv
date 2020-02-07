<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInfomationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('infomation', function (Blueprint $table) {
            $table->integer('order')->default(0)->comment('排序');
            $table->index(['type_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('infomation', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
