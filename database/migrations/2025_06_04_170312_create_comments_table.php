<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->text('comment_content');
        $table->timestamp('comment_date')->useCurrent();
        $table->string('reviewer_name')->nullable();
        $table->string('reviewer_email')->nullable();
        $table->boolean('is_hidden')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
