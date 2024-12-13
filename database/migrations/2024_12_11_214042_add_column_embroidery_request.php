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
        Schema::table('embroidery_request_submit', function (Blueprint $table) {
            $table->integer('embroidery_request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('embroidery_request_submit', function (Blueprint $table) {
            $table->dropColumn('embroidery_request_id');
        });
    }
};
