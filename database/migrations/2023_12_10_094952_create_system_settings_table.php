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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('email');
            $table->string('logo');
            $table->string('favicon')->nullable();
            $table->string('phone')->nullable();
            $table->string('office_address')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_tag_author')->nullable();
            $table->string('meta_tag_name')->nullable();
            $table->string('meta_tag_description')->nullable();
            $table->string('copy_right')->nullable();
            $table->string('website_banner')->nullable();
            $table->string('website_link')->nullable();
            $table->text('map_link')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('you_tube_link')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
