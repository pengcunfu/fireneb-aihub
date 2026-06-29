<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavLinksTable extends Migration
{
    public function up()
    {
        Schema::create('nav_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nav_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('url');
            $table->text('description')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_domestic')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nav_links');
    }
}
