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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            // $table->foreignUuid("user_id")->constrained("users");
            $table->foreignId("user_id")->constrained("users");
            // $table->foreignUuid("letter_category_id")->constrained("letter_categories");
            $table->foreignId("letter_category_id")->constrained("letter_categories");
            $table->foreignId("role_id")->constrained("roles");
            $table->foreignId('identifier_id')->constrained("identifiers");
            $table->date("date");
            $table->string("title", 50);
            $table->string("refrences_number", 30);
            $table->string("letter_destination", 40)->nullable();
            $table->text("body");
            $table->string("sender", 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
