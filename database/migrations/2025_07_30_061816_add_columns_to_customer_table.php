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
        Schema::table('customer_models', function (Blueprint $table) {
            $table->date('abn_date')->nullable();
            $table->date('gst_date')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('credit_score')->nullable();
            $table->enum('property_owner', ['Yes', 'No'])->nullable();
            $table->string('restricted_industries')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_models', function (Blueprint $table) {
            //
        });
    }
};
