<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('paper_reviewer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('paper_id')->constrained('papers')->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('review_submitted_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->unique(['paper_id','reviewer_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('paper_reviewer');
    }
};