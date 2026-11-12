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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->text('contact_section_desc')->nullable();
            $table->text('address')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('support_email')->nullable();
            $table->string('career_email')->nullable();
            $table->string('working_hours_weekday')->nullable();
            $table->string('working_hours_weekend')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
