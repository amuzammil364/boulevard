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
            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id")->references("id")->on("employees");
            $table->string('type')->nullable();
            $table->enum('status',array('Paid','Pending'))->nullable();
            $table->string('payment_id')->nullable();
            $table->double('amount')->nullable();
            $table->enum('mode_of_payment',array('Cash','Card','Bank Transfers','Mobile Payment','Cheque'))->nullable();
            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();
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
