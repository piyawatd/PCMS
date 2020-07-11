<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmphuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'amphures';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('code')
                ->nullable(false)
                ->comment('รหัสอำเภอ');
            $table->string('name_th')
                ->nullable(false)
                ->comment('อำเภอภาษาไทย');
            $table->string('name_en')
                ->nullable(false)
                ->comment('อำเภอภาษาอังกฤษ');
            $table->integer('province_id')
                ->nullable(false)
                ->comment('จังหวัด');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'อำเภอ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amphures');
    }
}
