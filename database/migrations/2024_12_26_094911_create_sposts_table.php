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
        Schema::create('sposts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('image');
            $table->string('title');
            $table->text('description');
            $table->integer('scategory_id');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sposts');
    }
};
