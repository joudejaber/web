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
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('damage_id')->nullable()->after('user_id');
        });
    
        // Add the constraint separately AFTER ensuring existing rows are compatible
        DB::statement('UPDATE appointments SET damage_id = 1 WHERE damage_id IS NULL'); // Or use a real existing damage_id from damage_reports
    
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('damage_id')
                  ->references('id')
                  ->on('damage_reports')
                  ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('appointments', function (Blueprint $table) {
        $table->dropForeign(['damage_id']);
        $table->dropColumn('damage_id');
    });
}
};
