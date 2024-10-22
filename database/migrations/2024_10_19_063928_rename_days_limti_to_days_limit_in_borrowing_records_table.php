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
        Schema::table('borrowing_records', function (Blueprint $table) {
            $table->renameColumn('days_limti', 'days_limit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowing_records', function (Blueprint $table) {
            $table->renameColumn('days_limit', 'days_limti');
        });
    }
};
