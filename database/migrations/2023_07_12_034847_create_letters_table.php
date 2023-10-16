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
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("signed_id")->constrained("users");
            $table->foreignId("letter_category_id")->constrained("letter_categories");
            $table->foreignId("role_id")->constrained("roles");
            $table->foreignId("unit_id")->constrained('units');
            $table->string("title", 100);
            $table->date("date")->index();
            $table->text("file");
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
