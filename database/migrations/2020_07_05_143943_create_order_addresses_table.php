<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'order_addresses';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->text('address')
                ->nullable(false)
                ->comment('ที่อยู่');
            $table->string('province')
                ->nullable(false)
                ->comment('รหัสจังหวัด');
            $table->string('amphure')
                ->nullable(false)
                ->comment('รหัสอำเภอ');
            $table->string('district')
                ->nullable(false)
                ->comment('รหัสตำบล');
            $table->string('zipcode')
                ->nullable(false)
                ->comment('รหัสไปรษณีย์');
            $table->string('type')
                ->nullable(false)
                ->comment('ประเภทที่อยู่');
            $table->integer('order')
                ->nullable(false)
                ->comment('รหัส order');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'ที่อยู่สั่งสินค้า'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
