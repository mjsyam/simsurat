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
        Schema::create('letter_histories', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            // $table->foreignUuid("letter_id")->constrained("letters");
            $table->foreignId("letter_id")->constrained("letters");
            $table->string("note");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_histories');
    }
};
