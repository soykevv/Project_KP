<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['gudang', 'sales', 'owner'])->default('sales');

            $table->rememberToken();
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
