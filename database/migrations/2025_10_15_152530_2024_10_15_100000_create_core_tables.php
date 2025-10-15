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
       {
        // Feature Flags සහ පොදු Settings සඳහා
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_name')->unique();
            $table->string('setting_value');
            $table->timestamps();
        });
        
        // *Roles සහ Permissions සඳහා Spatie පැකේජය පසුව ස්ථාපනය කළ හැකිය.*
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_settings');
    }
};
