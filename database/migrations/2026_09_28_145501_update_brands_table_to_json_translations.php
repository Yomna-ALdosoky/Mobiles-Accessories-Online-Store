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
        $brands = DB::table('brands')->get();

        foreach ($brands as $brand) {
            $nameJson = json_encode(['en' => $brand->name], JSON_UNESCAPED_UNICODE);

            DB::table('brands')->where('id', $brand->id)->update([
                'name' => $nameJson,
            ]);
        }

        Schema::table('brands', function (Blueprint $table) {
            $table->json('name')->change();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('name')->change();
        });
    }
};
