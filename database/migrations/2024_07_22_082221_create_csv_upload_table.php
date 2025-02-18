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
        Schema::create('csv_upload', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path')->nullable();
            $table->bigInteger('uploaded_by')->unsigned()->index()->nullable();
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('processed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_uploaded');
    }
};
