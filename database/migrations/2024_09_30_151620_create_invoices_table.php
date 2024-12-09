<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date'); // تاريخ الاستحقاق
            $table->string('product');
            $table->string('section');
            $table->string('discount');
            $table->string('rate_vat'); // نسبة الضريبة
            $table->decimal('value_vat',8,2); // قيمة الضريبة
            $table->decimal('Total',8,2);
            $table->string('Status', 50);
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};