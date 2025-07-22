<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE `lender_models` CHANGE `number_of_dushonours` `number_of_dishonours` INT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `lender_models` CHANGE `number_of_dishonours` `number_of_dushonours` INT NULL");
    }
};
