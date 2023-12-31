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
            $table->string("security_level");
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
            $table->foreignId("role_id")->constrained("roles");
            $table->foreignId("user_id")->constrained("users");
            $table->enum("read", [0, 1])->default(0);
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

        Schema::create('disposition_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId("disposition_id")->constrained("dispositions");
            $table->string("information");
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
        Schema::dropIfExists('disposition_to');
        Schema::dropIfExists('letter_receivers');
        Schema::dropIfExists('disposition_information');
    }
};
