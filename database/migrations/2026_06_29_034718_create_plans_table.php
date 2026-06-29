<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('action_url');
            $table->decimal('first_month_price', 10, 2)->nullable();
            $table->decimal('monthly_price', 10, 2);
            $table->decimal('quarterly_price', 10, 2)->nullable();
            $table->decimal('yearly_price', 10, 2)->nullable();
            $table->string('hourly_requests')->default('0');
            $table->string('monthly_requests')->default('0');
            $table->text('note')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
