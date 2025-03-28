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
        Schema::create('invoices_details', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->string("invoice_number", 50);
            $table->foreignId("invoice_detail_id")->constrained("invoices")->cascadeOnDelete();
            $table->string("product", 50);
            $table->string("section", 999);
            $table->string("status", 50);
            $table->integer("value_status");
            $table->date("payment_date")->nullable();// تاريخ الدفع
            $table->text("note")->nullable();
            $table->string("user", 300);
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
        Schema::dropIfExists('invoices_details');
    }
};