<?php

declare(strict_types=1);

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
        Schema::create('properties', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('owner_id')
                    ->constrained('owners')
                    ->onDelete('cascade');

            // Property Address
            $table->string('address', 250);
            $table->string('city', 100);
            $table->string('postal_code', 10);
            $table->string('province', 100);

            // Property Details
            $table->string('cadastral_reference', 100);
            $table->decimal('surface_area', 8, 2);
            $table->unsignedTinyInteger('bedrooms');
            $table->unsignedTinyInteger('bathrooms');
            $table->text('description')->nullable();

            $table->enum('energy_certificate_rating', ['A', 'B', 'C', 'D', 'E', 'F', 'G']);
            $table->string('energy_certificate_number', 50);
            $table->date('energy_certificate_expiry');
            $table->string('habitability_certificate_number', 50);
            $table->date('habitability_certificate_expiry');

            $table->decimal('last_rent_amount', 8, 2)->nullable();
            $table->decimal('ibi_annual_amount', 8, 2)->nullable();
            $table->decimal('community_fees_monthly', 8, 2)->nullable();
            $table->decimal('garbage_fees_annual', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
