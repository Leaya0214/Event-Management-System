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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('client_id');
            $table->bigInteger('payment_amount');
            $table->bigInteger('advance')->nullable();
            $table->bigInteger('due_amount')->nullable();
            $table->string('payment_date');
            $table->string('payment_method')->nullable();
            $table->longText('payment_description')->nullable();
            $table->string('invoice')->nullable();
            $table->string('currency')->nullable();
            $table->text('payment_gateway_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
