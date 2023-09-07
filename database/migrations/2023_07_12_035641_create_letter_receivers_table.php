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
            $table->id();
            // $table->uuid('id')->primary();
            $table->foreignId("user_id")->constrained("users");
            // $table->foreignUuid("user_id")->constrained("users");
            $table->foreignId("role_id")->constrained("roles");
            // $table->foreignUuid("disposition_id")->nullable()->constrained("users");
            $table->foreignId("disposition_id")->nullable()->constrained("users");
            $table->foreignId("letter_id")->constrained("letters");
            $table->foreignId('indetifier_id')->constrained("indetifiers");
            $table->foreignId('role_id')->constrained("roles");
            // $table->foreignUuid("letter_id")->constrained("letters");
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
