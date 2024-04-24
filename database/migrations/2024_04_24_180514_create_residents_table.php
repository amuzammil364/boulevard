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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("flat_id");
            $table->foreign("flat_id")->references("id")->on("flats");
            $table->enum('type',array('Owner','Tenant'))->nullable();
            $table->enum('status',array('Active','Vacant (Paid)','Vacant (Arrears)','Active (Arrears)','TBC'))->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('intercom')->nullable();
            $table->string('cnic')->nullable();
            $table->date('in_date')->nullable();
            $table->date('out_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
