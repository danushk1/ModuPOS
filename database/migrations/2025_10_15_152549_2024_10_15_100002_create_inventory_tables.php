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
       Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('isbn')->unique(); 
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->decimal('selling_price', 8, 2);
            $table->unsignedInteger('stock_level')->default(0); 
            $table->unsignedInteger('low_stock_threshold')->default(10); // Low Stock Alert
            $table->timestamps();
        });
        
        // GRN (Goods Received Note)
        Schema::create('grns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->string('invoice_no');
            $table->decimal('total_cost', 10, 2);
            $table->foreignId('received_by')->constrained('users'); // ලැබුණේ කාටද
            $table->timestamps();
        });

        Schema::create('grn_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grn_id')->constrained('grns')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedInteger('quantity');
            $table->decimal('purchase_price', 8, 2); // මිලදී ගත් මිල
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grn_items');
        Schema::dropIfExists('grns');
        Schema::dropIfExists('products');
        Schema::dropIfExists('suppliers');
    }
};
