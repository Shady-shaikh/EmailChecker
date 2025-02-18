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
        Schema::create('email_data_bank', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->longText('response')->nullable();
            $table->tinyInteger('status')->comment('0 -> Not Validated, 1 -> Valid, 2 -> Invalid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_data_bank');
    }
};
