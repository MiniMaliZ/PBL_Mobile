<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('check_clock_setting_times', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ck_settings_id');
            $table->date('day');
            $table->time('clock_in');
            $table->time('clock_out');
            $table->time('break_start');
            $table->time('break_end');
            $table->timestamps();
            $table->string('deleted_at', 30)->nullable();

            $table->foreign('ck_settings_id')
                ->references('id')->on('check_clocks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_clock_setting_times');
    }
};
