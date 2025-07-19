<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            $table->dropColumn('restricted_industry_type');
        });
    }

    public function down(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            $table->text('restricted_industry_type')->nullable(); // Re-add it if needed
        });
    }
};
