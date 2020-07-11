<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'provinces';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('code')
                ->nullable(false)
                ->comment('รหัสจังหวัด');
            $table->string('name_th')
                ->nullable(false)
                ->comment('จังหวัดภาษาไทย');
            $table->string('name_en')
                ->nullable(false)
                ->comment('จังหวัดภาษาอังกฤษ');
        });
        DB::statement("ALTER TABLE `$tableName` comment 'จังหวัด'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
