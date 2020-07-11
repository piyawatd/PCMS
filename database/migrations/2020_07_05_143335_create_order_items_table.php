<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'order_items';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title_th')
                ->comment('title ภาษาไทย');
            $table->string('title_en')
                ->nullable(true)
                ->comment('title ภาษาอังกฤษ');
            $table->integer('quantity')
                ->nullable(false)
                ->nullable(1)
                ->comment('จำนวน');
            $table->double('price')
                ->nullable(true)
                ->nullable(0)
                ->comment('ราคา');
            $table->double('totalline')
                ->nullable(true)
                ->nullable(0)
                ->comment('ราคารวม');
            $table->boolean('status')
                ->nullable(true)
                ->default(true)
                ->comment('สถานะ');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'order item'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
