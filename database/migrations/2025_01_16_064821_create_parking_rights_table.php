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
        Schema::create('parking_rights', function (Blueprint $table) {
            $table->id();
            $table->string('parking_id');
            $table->string('plate_number');
            $table->string('start_date');
            $table->string('start_time');
            $table->string('end_date');
            $table->string('end_time');
            $table->string('paid_amount');
            $table->string('creation_date');
            $table->string('creation_time');
            $table->string('zone');
            $table->string('terminal');
            $table->string('transaction_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_rights');
    }
};
