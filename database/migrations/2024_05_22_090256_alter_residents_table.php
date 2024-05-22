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
        Schema::table('residents', function (Blueprint $table) {
            $table->enum('status',array('Active','Vacant (Paid)','Vacant (Arrears)','Active (Arrears)', 'Active (Rented)', 'TBC','Inactive'))->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->enum('status',array('Active','Vacant (Paid)','Vacant (Arrears)','Active (Arrears)','TBC'))->nullable()->change();
        });
    }
};
