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
        Schema::create('borrowing_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');

            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('cascade');

                $table->unsignedBigInteger('member_id');

                $table->foreign('member_id')
                    ->references('id')->on('members')
                    ->onDelete('cascade');
    
            $table->date('borrowed_at')->useCurrent();
            $table->date('returned_at')->nullable();
            // $table->boolean('returned')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_records');
    }
};
