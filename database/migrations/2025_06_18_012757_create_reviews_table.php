<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('paper_id')->constrained('papers')->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->integer('version')->default(1);
            $table->text('comments');
            $table->string('recommendation');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->unique(['paper_id','reviewer_id','version']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};