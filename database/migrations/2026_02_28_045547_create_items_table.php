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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique(); 
             $table->foreignId('location_id')->nullable()
            ->constrained('locations')->nullOnDelete()
            ->cascadeOnUpdate();
            $table->string('item_name');
            $table->enum('category', ['tools', 'electronic', 'transportation', 'etc']);
            $table->enum('condition', ['good', 'broke', 'maintenance']);
            $table->integer('stock')->default(0);
            $table->string('image');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
