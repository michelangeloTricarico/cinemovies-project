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
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating')->notNull();
            $table->string('title', 255)->nullable();
            $table->text('comment')->notNull();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_movie_id_foreign');
            $table->dropForeign('reviews_user_id_foreign');
            $table->dropColumn('movie_id');
            $table->dropColumn('user_id');
            $table->dropColumn('rating');
            $table->dropColumn('title');
            $table->dropColumn('comment');
        });
    }
};
