<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'orders';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('order_no')
                ->nullable(false)
                ->comment('รหัสสั่งซื้อ');
            $table->timestamp('order_date')
                ->useCurrent()
                ->comment('วันเวลาที่สั่ง');
            $table->integer('customer')
                ->nullable(false)
                ->comment('ผู้สั่ง');
            $table->text('note')
                ->nullable(true)
                ->comment('note เพิ่มเติม');
            $table->integer('order_status')
                ->nullable(true)
                ->default(0)
                ->comment('สถานะใบสั่งสินค้า 0 = ใบใหม่,1 = ยืนยันการโอนเงิน,2 = จัดส่งแล้ว');
            $table->string('coupon')
                ->nullable(true)
                ->comment('รหัสคูปอง');
            $table->double('total')
                ->nullable(true)
                ->default(0)
                ->comment('จำนวนเงินรวม');
            $table->double('grand_total')
                ->nullable(true)
                ->default(0)
                ->comment('จำนวนเงินหลังหักคูปอง');
            $table->boolean('status')
                ->nullable(true)
                ->default(true)
                ->comment('สถานะ');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'orders'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
