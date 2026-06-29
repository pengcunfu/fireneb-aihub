<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanBenefitTable extends Migration
{
    public function up()
    {
        Schema::create('plan_benefit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('benefit_id')->constrained()->cascadeOnDelete();
            $table->unique(['plan_id', 'benefit_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_benefit');
    }
}
