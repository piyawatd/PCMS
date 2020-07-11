<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'districts';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name_th')
                ->nullable(false)
                ->comment('ตำบลภาษาไทย');
            $table->string('name_en')
                ->nullable(false)
                ->comment('ตำบลภาษาอังกฤษ');
            $table->integer('amphure_id')
                ->nullable(false)
                ->comment('อำเภอ');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'ตำบล'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
