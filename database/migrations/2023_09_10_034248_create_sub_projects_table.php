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
        Schema::create('sub_projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('title');
            $table->mediumText('description')->nullable();
            $table->enum('priority',['High', 'Medium', 'Low'])->nullable();
            $table->enum('status', ['ReadyForPlanning', 'ToDo', 'InProgress','TestPhase', 'CodeReview', 'Merged'])->default('ReadyForPlanning');
            $table->string('total_time', '255')->nullable();

            $table->unsignedBigInteger('main_project_id');
            $table->foreign('main_project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_projects');
    }
};
