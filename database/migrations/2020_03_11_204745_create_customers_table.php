<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'customers';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('username')
                ->nullable(false)
                ->comment('username');
            $table->string('password')
                ->nullable(false)
                ->comment('password');
            $table->string('firstname')
                ->nullable(false)
                ->comment('ชื่อ');
            $table->string('lastname')
                ->nullable(false)
                ->comment('นามสกุล');
            $table->string('email')
                ->nullable(false)
                ->comment('email ติดต่อ');
            $table->string('phone')
                ->nullable(true)
                ->comment('เบอร์โทรศัพท์');
            $table->boolean('status')
                ->nullable(true)
                ->default(true)
                ->comment('สถานะ');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'customer'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
