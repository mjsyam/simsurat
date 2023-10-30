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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("letter_id")->constrained("letters");
            $table->integer("agenda_number");
            $table->date("receive_date");
            $table->string("purpose");
            $table->string("from");
            $table->string("point");
            $table->string("information");
            $table->timestamps();
        });

        Schema::create('disposition_to', function (Blueprint $table) {
            $table->id();
            $table->foreignId("disposition_id")->constrained("dispositions");
            $table->foreignId("identifier_id")->constrained("identifiers");
            $table->foreignId("user_id")->constrained("users");
            $table->timestamps();
        });

        Schema::create('letter_receivers', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            $table->foreignId("letter_id")->constrained("letters");
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("disposition_id")->nullable()->constrained("dispositions");
            $table->foreignId("identifier_id")->constrained("identifiers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
        Schema::dropIfExists('letter_receivers');
        Schema::dropIfExists('letter_receivers');
    }
};
