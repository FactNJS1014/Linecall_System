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

        Schema::create('LNCL_HREC_APP', function (Blueprint $table) {
            $table->string('LNCL_RECAPP_ID')->primary();
            $table->string('LNCL_HREC_ID')->index()->comment('เลขการบันทึก');
            $table->foreign('LNCL_HREC_ID')->references('LNCL_HREC_ID')->on('LNCL_HREC_TBL');
            $table->string('LNCL_APP_ID')->index()->comment('approve id');
            $table->foreign('LNCL_APP_ID')->references('LNCL_APP_ID')->on('LNCL_APPROVE_TBL');
            $table->string('LNCL_RECAPP_EMPLV')->comment('แสดงข้อมูลผู้อนุมัติลำดับที่ 1');
            $table->string('LNCL_EMPID_RECAPP')->comment('รหัสผู้อนุมัติตามลำดับ');
            $table->integer('LNCL_RECAPP_STD')->comment('สถานะการอนุมัติ');
            $table->string('LNCL_RECAPP_LSTDT')->comment('วันที่และเวลาอนุมัติ');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_n_c_l_h_r_e_c_a_p_p');
    }
};
