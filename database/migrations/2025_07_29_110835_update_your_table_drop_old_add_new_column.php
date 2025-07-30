<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('main_lender_tables', function (Blueprint $table) {
            // Drop old column
            $table->dropColumn('GST_registration');

            // Add new column (example: string, nullable)
            $table->string('deleted_flag')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('main_lender_tables', function (Blueprint $table) {
            // Add old column back (you must specify the type)
            $table->string('GST_registration')->nullable();

            // Drop new column
            $table->dropColumn('deleted_flag');
        });
    }
};
