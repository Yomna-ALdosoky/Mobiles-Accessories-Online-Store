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
        $blogs = DB::table('blogs')->get();

        foreach ($blogs as $blog) {
            $titleJson = json_encode(['en' => $blog->title], JSON_UNESCAPED_UNICODE);
            $excerptJson = $blog->excerpt ? json_encode(['en' => $blog->excerpt], JSON_UNESCAPED_UNICODE) : null;
            $contentJson = json_encode(['en' => $blog->content], JSON_UNESCAPED_UNICODE);

            DB::table('blogs')->where('id', $blog->id)->update([
                'title' => $titleJson,
                'excerpt' => $excerptJson,
                'content' => $contentJson,
            ]);
        }
        Schema::table('blogs', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('excerpt')->nullable()->change();
            $table->json('content')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('excerpt')->nullable()->change();
            $table->longText('content')->change();
        });
    }
};
