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

        Schema::create('LNCL_LEAKANDROOT_TBL', function (Blueprint $table) {
            $table->string('LNCL_LEAKANDROOT_ID')->primary();
            $table->string('LNCL_HREC_ID')->index();
            $table->foreign('LNCL_HREC_ID')->references('LNCL_HREC_ID')->on('LNCL_HREC_TBL');
            $table->string('LNCL_LEAKANDROOT_SECTION');
            $table->string('LNCL_LEAKANDROOT_NAME');
            $table->string('LNCL_LEAKANDROOT_EMPID');
            $table->string('LNCL_LEAK_WHY1');
            $table->string('LNCL_LEAK_WHY2');
            $table->string('LNCL_LEAK_WHY3');
            $table->string('LNCL_LEAK_WHY4');
            $table->string('LNCL_LEAK_WHY5');
            $table->string('LNCL_LEAK_ACTION');
            $table->string('LNCL_ESC_WHY1');
            $table->string('LNCL_ESC_WHY2');
            $table->string('LNCL_ESC_WHY3');
            $table->string('LNCL_ESC_WHY4');
            $table->string('LNCL_ESC_WHY5');
            $table->string('LNCL_ESC_ACTION');
            $table->string('LNCL_LEAKANDROOT_LSTDT');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_n_c_l_l_e_a_k_a_n_d_r_o_o_t_t_b_l');
    }
};
