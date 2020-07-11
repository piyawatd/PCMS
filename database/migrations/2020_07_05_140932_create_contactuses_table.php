<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'contact';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->text('fullname')
                ->nullable(false)
                ->comment('ชื่อผู้ติดต่อ');
            $table->string('email')
                ->nullable(false)
                ->comment('email ตอบกลับ');
            $table->string('phone')
                ->nullable(true)
                ->comment('เบอร์ติดต่อกลับ');
            $table->text('detail')
                ->nullable(false)
                ->comment('รายละเอียด');
            $table->integer('record_status')
                ->nullable(true)
                ->default(0)
                ->comment('สถานะ contact 0 = new,1 = view,2 = close');
            $table->boolean('status')
                ->nullable(true)
                ->default(true)
                ->comment('สถานะ record');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Contact Us'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
