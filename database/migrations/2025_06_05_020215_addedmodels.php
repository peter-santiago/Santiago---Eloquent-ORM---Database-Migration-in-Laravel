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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 1);
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->timestamp('publication_date')->nullable();
            $table->timestamp('last_modified_date')->nullable();
            $table->string('status', 1); //(D - Draft, P - Published, I - Inactive)
            $table->text('featured_image_url');
            $table->integer('views_count')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 30);
            $table->string('slug');
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_name', 45);
            $table->string('slug');
            $table->timestamps();
        });
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->text('comment_content');
        $table->timestamp('comment_date')->useCurrent();
        $table->string('reviewer_name')->nullable();
        $table->string('reviewer_email')->nullable();
        $table->boolean('is_hidden')->default(false);
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
        });
    Schema::create('media', function (Blueprint $table) {
        $table->id();
        $table->string('file_name');
        $table->string('file_type', 10);
        $table->integer('file_size')->default(0);
        $table->string('url');
        $table->timestamp('upload_date')->useCurrent();
        $table->string('description')->nullable();
        $table->foreignId('post_id')->nullable()->constrained('posts')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('media');
    }
    
};
