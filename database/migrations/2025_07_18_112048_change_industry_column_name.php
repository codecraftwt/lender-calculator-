<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Use raw SQL to rename the column
        DB::statement("ALTER TABLE lender_models CHANGE industry_type allowed_industry_type VARCHAR(255) NULL");
    }

    public function down(): void
    {
        // Reverse the rename
        DB::statement("ALTER TABLE lender_models CHANGE allowed_industry_type industry_type VARCHAR(255) NULL");
    }
};
