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
        $products = DB::table('products')->get();

        foreach ($products as $product) {
            $nameJson = json_encode(['en' => $product->name], JSON_UNESCAPED_UNICODE);
            $descriptionJson = $product->description ? json_encode(['en' => $product->description], JSON_UNESCAPED_UNICODE) : null;

            DB::table('products')->where('id', $product->id)->update([
                'name' => $nameJson,
                'description' => $descriptionJson,
            ]);
        }

        Schema::table('products', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
        });
    }
};
