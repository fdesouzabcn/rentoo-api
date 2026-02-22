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
        Schema::create('contracts', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('property_id')
                    ->constrained('properties')
                    ->onDelete('cascade');

            $table->enum('status',['draft','active','finalized'])
                    ->default('draft');

            // Contract Specific Details
            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->decimal('monthly_rent', 8, 2);
            $table->decimal('legal_deposit', 8, 2);
            $table->decimal('additional_deposit', 8, 2)->nullable();

            $table->boolean('tenant_pays_ibi')->default(false);
            $table->boolean('tenant_pays_community_fees')->default(false);
            $table->boolean('tenant_pays_garbage_fees')->default(false);

            $table->decimal('irpa_value', 8, 2)->nullable();
            $table->boolean('is_tensioned_area')->default(false);

            // Tenants
            $table->string('tenant1_name', 100);
            $table->string('tenant1_dni', 20);
            $table->string('tenant1_email', 100);
            $table->string('tenant1_phone', 20);

            $table->string('tenant2_name', 100)->nullable();
            $table->string('tenant2_dni', 20)->nullable();
            $table->string('tenant2_email', 100)->nullable();
            $table->string('tenant2_phone', 20)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
