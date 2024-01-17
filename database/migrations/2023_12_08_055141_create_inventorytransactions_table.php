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
        Schema::create('inventorytransactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type_asset');
            $table->string('name_inventory');
            $table->string('code_inventory')->unique();
            $table->string('type_inventory');
            $table->string('quantity_type');
            $table->integer('quantity');
            $table->string('photo_product');
            $table->string('photo_receive');
            $table->string('type_transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventorytransactions');
    }
};
