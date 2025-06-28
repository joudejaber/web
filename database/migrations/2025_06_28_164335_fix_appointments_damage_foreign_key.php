<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the existing foreign key constraint to damage_reports
            $table->dropForeign(['damage_id']);
            
            // Now add the correct foreign key referencing damages.id
            $table->foreign('damage_id')
                  ->references('id')
                  ->on('damages')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the foreign key to damages
            $table->dropForeign(['damage_id']);
            
            // Optionally, add back the wrong foreign key if you want rollback (not necessary)
            $table->foreign('damage_id')
                  ->references('id')
                  ->on('damage_reports')
                  ->onDelete('cascade');
        });
    }
};
