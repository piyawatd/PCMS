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
                ->comment('ที่อยู่จัดส่ง');
            $table->integer('province_id')
                ->nullable(false)
                ->comment('รหัสจังหวัด');
            $table->integer('amphure_id')
                ->nullable(false)
                ->comment('รหัสอำเภอ');
            $table->integer('district_id')
                ->nullable(false)
                ->comment('รหัสตำบล');
            $table->string('zipcode')
                ->nullable(false)
                ->comment('รหัสไปรษณีย์');
            $table->integer('order_id')
                ->nullable(false)
                ->comment('รหัส order');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'ที่จัดส่ง'");
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
