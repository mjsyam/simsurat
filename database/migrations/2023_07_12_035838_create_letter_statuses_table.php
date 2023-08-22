<?php

use App\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function up(): void
    {
        Schema::create('letter_statuses', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            // $table->foreignUuid("letter_receiver_id")->constrained("letter_receivers");
            $table->foreignId("letter_receiver_id")->constrained("letter_receivers");
            $table->enum("status", $this->constants->letter_status);
            $table->boolean("read")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_statuses');
    }
};
