<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'addresses';
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
            $table->integer('customer_id')
                ->nullable(false)
                ->comment('รหัสลูกค้า');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'ที่อยู่'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
