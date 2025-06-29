<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->bigInteger('category_id');
            $table->mediumText('remarks');
            $table->bigInteger('amount');
            $table->date('date');
            $table->string('payment_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('account_no')->nullable();
            $table->string('document')->nullable();
            $table->string('created_by')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
