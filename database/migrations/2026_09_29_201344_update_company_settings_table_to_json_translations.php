<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = DB::table('company_settings')->get();

        foreach ($settings as $setting) {
            DB::table('company_settings')->where('id', $setting->id)->update([
                'contact_section_desc'  => $setting->contact_section_desc ? json_encode(['en' => $setting->contact_section_desc], JSON_UNESCAPED_UNICODE) : null,
                'address'               => $setting->address ? json_encode(['en' => $setting->address], JSON_UNESCAPED_UNICODE) : null,
                'working_hours_weekday' => $setting->working_hours_weekday ? json_encode(['en' => $setting->working_hours_weekday], JSON_UNESCAPED_UNICODE) : null,
                'working_hours_weekend' => $setting->working_hours_weekend ? json_encode(['en' => $setting->working_hours_weekend], JSON_UNESCAPED_UNICODE) : null,
            ]);
        }

        Schema::table('company_settings', function (Blueprint $table) {
            $table->json('contact_section_desc')->nullable()->change();
            $table->json('address')->nullable()->change();
            $table->json('working_hours_weekday')->nullable()->change();
            $table->json('working_hours_weekend')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->text('contact_section_desc')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('working_hours_weekday')->nullable()->change();
            $table->string('working_hours_weekend')->nullable()->change();
        });
    }
};
