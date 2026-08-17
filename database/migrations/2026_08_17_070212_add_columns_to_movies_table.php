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
        Schema::table('movies', function (Blueprint $table) {
            $table->string('title', 255)->notNull();
            $table->text('description')->nullable();
            $table->date('release_date')->nullable();
            $table->string('poster', 255)->nullable();
            $table->string('trailer_url', 255)->nullable();
            $table->foreignId('director_id')->constrained('directors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('release_date');
            $table->dropColumn('poster');
            $table->dropColumn('trailer_url');
            $table->dropForeignIdFor('director_id');
        });
    }
};
