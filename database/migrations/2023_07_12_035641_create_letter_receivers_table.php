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
        Schema::create('letter_receivers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid("user_id")->constrained("users");
            $table->foreignUuid("role_id")->constrained("roles");
            $table->foreignUuid("disposition_id")->constrained("users")->default(null);
            $table->foreignUuid("letter_id")->constrained("letters");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_receivers');
    }
};
