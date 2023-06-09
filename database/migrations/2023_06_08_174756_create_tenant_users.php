<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tenant_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenant_id');
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->timestamps();
        });
    }

};
