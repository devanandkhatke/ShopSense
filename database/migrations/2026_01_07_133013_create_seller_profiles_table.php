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
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Store info
            $table->string('store_name');
            $table->string('store_slug')->unique();
            $table->text('store_description')->nullable();

            // KYC
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();

            // Address
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');

            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_profiles');
    }
};
