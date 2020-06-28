<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'content_galleries';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title')
            ->nullable(true)
            ->comment('ชื่อรูป');
            $table->text('intro')
            ->nullable(true)
            ->comment('intro รูป');
            $table->text('image')
            ->comment('รูป');
            $table->bigInteger('content');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Content Gallery table'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_galleries');
    }
}
