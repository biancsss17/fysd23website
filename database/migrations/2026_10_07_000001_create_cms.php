<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', fn (Blueprint $t) => $t->boolean('is_admin')->default(false));
        Schema::create('media', function (Blueprint $t) {
            $t->id();
            $t->string('path')->unique();
            $t->string('name');
            $t->string('alt')->nullable();
            $t->timestamps();
        });
        Schema::create('contents', function (Blueprint $t) {
            $t->id();
            $t->string('type')->index();
            $t->string('title');
            $t->string('slug')->unique();
            $t->text('excerpt')->nullable();
            $t->longText('content')->nullable();
            $t->string('category')->nullable();
            $t->foreignId('cover_id')->nullable()->constrained('media')->nullOnDelete();
            $t->dateTime('published_at')->nullable()->index();
            $t->date('event_date')->nullable();
            $t->string('location')->nullable();
            $t->string('status')->default('draft')->index();
            $t->boolean('featured')->default(false);
            $t->unsignedInteger('sort_order')->default(0);
            $t->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamps();
        });
        Schema::create('activity_images', function (Blueprint $t) {
            $t->id();
            $t->foreignId('content_id')->constrained('contents')->cascadeOnDelete();
            $t->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $t->unsignedInteger('sort_order')->default(0);
            $t->unique(['content_id', 'media_id']);
        });
        Schema::create('officers', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('position');
            $t->text('biography')->nullable();
            $t->string('email')->nullable();
            $t->string('social_url')->nullable();
            $t->string('term')->nullable();
            $t->foreignId('photo_id')->nullable()->constrained('media')->nullOnDelete();
            $t->unsignedInteger('hierarchy_level')->default(1);
            $t->unsignedInteger('sort_order')->default(0);
            $t->string('status')->default('draft');
            $t->timestamps();
        });
        Schema::create('site_settings', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->longText('value')->nullable();
            $t->timestamps();
        });
        Schema::create('page_sections', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->string('title');
            $t->text('description')->nullable();
            $t->boolean('visible')->default(true);
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['page_sections', 'site_settings', 'officers', 'activity_images', 'contents', 'media'] as $name) {
            Schema::dropIfExists($name);
        }
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn('is_admin'));
    }
};
