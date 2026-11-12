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
        Schema::table('json_translations', function (Blueprint $table) {

            $stores = DB::table('stores')->get();

            foreach ($stores as $store) {
                $nameJson = json_encode(['en' => $store->name], JSON_UNESCAPED_UNICODE);
                $descJson = $store->description ? json_encode(['en' => $store->description], JSON_UNESCAPED_UNICODE) : null;

                DB::table('stores')->where('id', $store->id)->update([
                    'name' => $nameJson,
                    'description' => $descJson,
                ]);
            }

            Schema::table('stores', function (Blueprint $table) {
                $table->json('name')->change();
                $table->json('description')->nullable()->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('json_translations', function (Blueprint $table) {
            Schema::table('stores', function (Blueprint $table) {
                $table->string('name')->change();
                $table->text('description')->nullable()->change();
            });
        });
    }
};
