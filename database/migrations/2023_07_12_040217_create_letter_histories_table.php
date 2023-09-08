<?php

use App\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('letter_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("letter_receiver_id")->constrained('letter_receivers');
            $table->string("note");
            $table->enum("status", $this->constants->letter_status);
            $table->foreignId("approver_id")->nullable()->constrained("user_roles");
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
