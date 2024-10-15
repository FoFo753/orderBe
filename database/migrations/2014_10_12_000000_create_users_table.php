<?php

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); //chỉ duy nhất 1 lần
            $table->string('phoneNumber')->unique();
            $table->dateTime('birth')->nullable();  //cho truong nay rong
            $table->integer('role')->default(UserRole::STAFF); //Mac dinh 
            $table->integer('status')->default(UserStatus::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
