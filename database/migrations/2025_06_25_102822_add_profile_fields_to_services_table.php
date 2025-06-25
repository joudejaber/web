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
    Schema::table('services', function (Blueprint $table) {
        $table->string('shop_name')->nullable()->after('type');
        $table->string('location')->nullable()->after('shop_name');
        $table->text('description')->nullable()->after('location');
        $table->string('contact_info')->nullable()->after('description');
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn(['shop_name', 'location', 'description', 'contact_info']);
    });
}

};
