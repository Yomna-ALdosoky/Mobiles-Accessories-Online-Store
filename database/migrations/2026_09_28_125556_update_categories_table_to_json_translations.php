<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = DB::table('categories')->get();

        foreach ($categories as $category) {
            $nameJson = json_encode(['en' => $category->name], JSON_UNESCAPED_UNICODE);
            $descJson = $category->description ? json_encode(['en' => $category->description], JSON_UNESCAPED_UNICODE) : null;

            DB::table('categories')->where('id', $category->id)->update([
                'name' => $nameJson,
                'description' => $descJson,
            ]);
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
        });
    }
};
