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

        Schema::create('LNCL_APPROVE_TBL', function (Blueprint $table) {
            $table->string('LNCL_APP_ID')->primary();
            $table->string('LNCL_APP_SECTION')->comment('สายแผนก');
            $table->string('LNCL_RANKTYPE')->comment('rank type');
            $table->string('LNCL_EMP_LEVEL')->comment('รหัสผ่านผู้อนุมัติลำดับที่ 1');
            $table->string('LNCL_APP_EMPID');
            $table->integer('LNCL_CREATE_STD')->comment('สถานะการสร้าง master');
            $table->integer('LNCL_CREATE_LSTDT')->comment('วันที่-เวลาการสร้าง master');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_n_c_l_a_p_p_r_o_v_e_t_b_l');
    }
};
