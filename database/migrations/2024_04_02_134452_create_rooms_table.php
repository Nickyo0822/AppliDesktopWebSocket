<?php

use App\Models\Rooms;
use App\Models\User;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("name");
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignIdFor(Rooms::class)->constrained()->cascadeOnDelete();
        });

        Rooms::create([
            'name' => 'roomtest'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
