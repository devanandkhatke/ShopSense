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
        Schema::create('seller_kyc', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_profile_id')
                ->constrained()
                ->cascadeOnDelete();

            // Documents
            $table->string('gst_certificate')->nullable();
            $table->string('business_registration_doc')->nullable();
            $table->string('id_proof')->nullable();
            $table->string('cancelled_cheque')->nullable();

            // Verification
            $table->enum('status', [
                'not_submitted',
                'submitted',
                'verified',
                'rejected'
            ])->default('not_submitted');

            $table->text('admin_remark')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_kyc');
    }
};
