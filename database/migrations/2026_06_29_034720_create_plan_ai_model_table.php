<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAiModelTable extends Migration
{
    public function up()
    {
        Schema::create('plan_ai_model', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ai_model_id')->constrained()->cascadeOnDelete();
            $table->unique(['plan_id', 'ai_model_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_ai_model');
    }
}
