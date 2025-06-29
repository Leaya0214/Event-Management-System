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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->bigInteger('category_id');
            $table->bigInteger('event_id')->nullable();
            $table->string('expense_type')->nullable();
            $table->string('remarks');
            $table->bigInteger('amount');
            $table->string('date');
            $table->string('payment_type');
            $table->string('transaction_id')->nullable();
            $table->string('account_no')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
