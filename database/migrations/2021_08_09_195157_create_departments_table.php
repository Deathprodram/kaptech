<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->string('name')->nullable();
            $table->text('background')->nullable();
            $table->integer('head_id')->nullable();
            $table->integer('displayorder')->default(10000);
            $table->tinyInteger('hidden')->default(0);
            $table->timestamps();

            $table->index(['parent_id', 'lft', 'rgt'], 'index_departments_on_parent_id_and_lft_and_rgt');
            $table->index('head_id', 'index_departments_on_head_id');
            $table->index('displayorder', 'index_departments_on_displayorder');
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
