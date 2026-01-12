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

        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->string('url', 500);
            $table->string('short_url', 6);
            $table->integer('created_by');
            $table->timestamps();

        });

        Schema::create('url_stats', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('url_id');
            $table->date('stat_date');
            $table->string('referrer_url', 300)->nullable();
            $table->unsignedInteger('click_count')->default(0);

            $table->unique([
                'url_id',
                'stat_date',
                'referrer_url'
            ], 'url_stats_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_stats');
        Schema::dropIfExists('urls');
    }
};
