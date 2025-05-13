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
            $table->string('logo')->nullable();
            $table->string('home_img')->nullable();
            $table->string('home_title')->nullable();
            $table->text('home_text')->nullable();
            $table->string('aim_title')->nullable();
            $table->text('aim_text')->nullable();
            $table->string('aim_img')->nullable();
            $table->string('purpose_img')->nullable();
            $table->string('purpose_title')->nullable();
            $table->string('purpose_subheading_1')->nullable();
            $table->string('purpose_subheading_2')->nullable();
            $table->string('purpose_subheading_3')->nullable();
            $table->string('purpose_subheading_4')->nullable();
            $table->string('footer_top_title')->nullable();
            $table->text('footer_top_text')->nullable();
            $table->text('footer_bottom_text')->nullable();

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
