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
        Schema::table('profile_images', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->morphs('imageable');
        });
        Schema::rename('profile_images', 'images');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('images', 'profile_images');
        Schema::table('profile_images', function (Blueprint $table) {
            $table->dropMorphs('imageable');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->after('id');
        });
    }
};
