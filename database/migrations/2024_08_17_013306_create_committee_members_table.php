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
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('committee_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('position');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('role');
            $table->text('profile');
            $table->string('member_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_members');
    }
};
