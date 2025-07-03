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
        Schema::table('studies', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'stop_date']);

            $table->integer('start_month');
            $table->integer('start_year');
            $table->integer('stop_month');
            $table->integer('stop_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
