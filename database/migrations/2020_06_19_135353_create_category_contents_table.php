<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'category_contents';

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('alias')
                ->comment('alias ดึงข้อมูล');
            $table->string('name_th')
                ->comment('name ภาษาไทย');
            $table->string('name_en')
                ->nullable(true)
                ->comment('name ภาษาอังกฤษ');
            $table->text('image')
                ->nullable(true)
                ->comment('รูป');
            $table->text('detail_th')
                ->nullable(true)
                ->comment('รายละเอียดภาษาไทย');
            $table->text('detail_en')
                ->nullable(true)
                ->comment('รายละเอียดภาษาอังกฤษ');
            $table->integer('order_number')
                ->default(0)
                ->nullable(true)
                ->comment('ลำดับแสดงผล');
            $table->boolean('status')
                ->default(true)
                ->nullable(true)
                ->comment('ใช้งานหรือไม่');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'category for content'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_contents');
    }
}
