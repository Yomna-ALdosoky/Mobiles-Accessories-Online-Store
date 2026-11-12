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
            // Top Header
            $table->string('hotline')->nullable();

            // Footer Info (Get In Touch With Us)
            $table->string('footer_phone')->nullable();
            $table->string('work_hours_weekdays')->nullable(); // Monday-Friday
            $table->string('work_hours_saturday')->nullable(); // Saturday
            $table->string('footer_email')->nullable();        // support@shopgrids.com

            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('skype_url')->nullable();
            $table->string('google_url')->nullable();

            // App Links
            $table->string('app_store_url')->nullable();
            $table->string('play_store_url')->nullable();
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
