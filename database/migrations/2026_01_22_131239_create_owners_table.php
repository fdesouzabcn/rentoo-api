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
        Schema::create('owners', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string ('name', 100);
            $table->string ('dni', 20)->unique();
            $table->string ('email', 100)->unique();
            $table->string ('phone', 20);

            // Owner Address
            $table->string ('address', 250);
            $table->string ('city', 100);
            $table->string ('postal_code', 10);
            $table->string ('province', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
