<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'products';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('alias')
                ->comment('alias ดึงข้อมูล');
            $table->string('sku')
                ->comment('sku');
            $table->string('title_th')
                ->comment('title ภาษาไทย');
            $table->string('title_en')
                ->nullable(true)
                ->comment('title ภาษาอังกฤษ');
            $table->text('intro_th')
                ->nullable(true)
                ->comment('intro ภาษาไทย');
            $table->text('intro_en')
                ->nullable(true)
                ->comment('intro ภาษาอังกฤษ');
            $table->text('detail_th')
                ->nullable(true)
                ->comment('รายละเอียดภาษาไทย');
            $table->text('detail_en')
                ->nullable(true)
                ->comment('รายละเอียดภาษาอังกฤษ');
            $table->double('price')
                ->comment('ราคา');
            $table->text('thumbnail')
                ->nullable(true)
                ->comment('รูป thumbnail');
            $table->text('seokey')
                ->nullable(true)
                ->comment('seo key');
            $table->text('seodescription')
                ->nullable(true)
                ->comment('seo description');
            $table->boolean('hilight')
                ->default(false)
                ->nullable(true)
                ->comment('hilignt product');
            $table->boolean('publish')
                ->default(true)
                ->nullable(true)
                ->comment('แสดงผลหรือไม่');
            $table->date('publish_date')
                ->nullable(true)
                ->comment('วันที่แสดงผล');
            $table->boolean('status')
                ->default(true)
                ->nullable(true)
                ->comment('ใช้งานหรือไม่');
            $table->bigInteger('category')
                ->comment('category');
            $table->timestamps();
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
        Schema::dropIfExists('products');
    }
}
