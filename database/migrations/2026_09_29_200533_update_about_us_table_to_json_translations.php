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
        $rows = DB::table('about_us')->get();
        foreach ($rows as $row) {
            DB::table('about_us')->where('id', $row->id)->update([
                'title'            => $row->title ? json_encode(['en' => $row->title], JSON_UNESCAPED_UNICODE) : null,
                'paragraph_1'      => $row->paragraph_1 ? json_encode(['en' => $row->paragraph_1], JSON_UNESCAPED_UNICODE) : null,
                'paragraph_2'      => $row->paragraph_2 ? json_encode(['en' => $row->paragraph_2], JSON_UNESCAPED_UNICODE) : null,
                'team_title'       => $row->team_title ? json_encode(['en' => $row->team_title], JSON_UNESCAPED_UNICODE) : null,
                'team_description' => $row->team_description ? json_encode(['en' => $row->team_description], JSON_UNESCAPED_UNICODE) : null,
            ]);
        }

        Schema::table('about_us', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('paragraph_1')->nullable()->change();
            $table->json('paragraph_2')->nullable()->change();
            $table->json('team_title')->nullable()->change();
            $table->json('team_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->text('paragraph_1')->nullable()->change();
            $table->text('paragraph_2')->nullable()->change();
            $table->string('team_title')->nullable()->change();
            $table->text('team_description')->nullable()->change();
        });
    }
};
