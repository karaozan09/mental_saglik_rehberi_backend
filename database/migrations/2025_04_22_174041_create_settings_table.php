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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('home_image');
            $table->string('home_title');
            $table->text('home_text');
            $table->string('aim_title');
            $table->text('aim_text');
            $table->string('aim_image');
            $table->string('purpose_image');
            $table->string('purpose_title');
            $table->string('purpose_subheading');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
