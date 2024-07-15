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
        Schema::create('signature_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('signatory_id');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('document_id')->references('id')->on('documents')
                ->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('signatory_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signature_requests');
    }
};
