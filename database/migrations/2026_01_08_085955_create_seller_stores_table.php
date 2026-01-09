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
        Schema::create('seller_stores', function ($table) {
            $table->id();
            $table->foreignId('seller_profile_id')->constrained()->cascadeOnDelete();

            $table->string('store_logo')->nullable();
            $table->string('website')->nullable();
            $table->string('whatsapp_number')->nullable();

            $table->enum('shipping_method', ['self_ship', 'platform_ship'])->default('self_ship');
            $table->decimal('default_tax_rate', 5, 2)->nullable();

            $table->boolean('is_completed')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_stores');
    }
};
