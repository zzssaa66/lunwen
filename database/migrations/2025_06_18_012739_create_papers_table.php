<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('abstract');
            $table->string('file_path');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('submitted');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('decision_at')->nullable();
            $table->integer('current_version')->default(1);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('papers')->onDelete('set null');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('papers');
    }
};