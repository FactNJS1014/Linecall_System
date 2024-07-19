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
        Schema::disableForeignKeyConstraints();

        Schema::create('LNCL_IMAGES', function (Blueprint $table) {
            $table->string('LNCL_IMAGES_ID')->primary();
            $table->string('LNCL_HREC_ID')->index();
            $table->foreign('LNCL_HREC_ID')->references('LNCL_HREC_ID')->on('LNCL_HREC_TBL');
            $table->string('LNCL_IMAGES_FILES');
            $table->string('LNCL_IMAGES_TYPE');
            $table->string('LNCL_IMAGES_LSTDT');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_n_c_l_i_m_a_g_e_s');
    }
};
