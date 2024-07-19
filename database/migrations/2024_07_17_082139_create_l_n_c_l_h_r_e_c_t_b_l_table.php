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

        Schema::create('LNCL_HREC_TBL', function (Blueprint $table) {
            $table->string('LNCL_HREC_ID')->primary();
            $table->string('LNCL_HREC_EMPID')->comment('รหัสพนักงาน');
            $table->bigInteger('LNCL_HREC_SECTION')->comment('แผนกผู้บันทึก');
            $table->string('LNCL_HREC_LINE')->comment('line การผลิต');
            $table->string('LNCL_HREC_CUS')->comment('ลูกค้า');
            $table->string('LNCL_HREC_WON')->comment('Work order');
            $table->string('LNCL_HREC_MDLNM')->comment('Model Name');
            $table->string('LNCL_HREC_MDLCD')->comment('Model Code');
            $table->string('LNCL_HREC_NGCD')->comment('NG Code');
            $table->string('LNCL_HREC_NGPRCS')->comment('NG Process');
            $table->string('LNCL_HREC_NGPST')->comment('NG Position');
            $table->integer('LNCL_HREC_QTY')->comment('จำนวนงานทั้งหมด');
            $table->integer('LNCL_HREC_DEFICT')->comment('จำนวนงานเสีย');
            $table->integer('LNCL_HREC_PERCENT')->comment('คิดเป็นกี่ %');
            $table->string('LNCL_HREC_SERIAL')->comment('เลข Serial');
            $table->string('LNCL_HREC_REFDOC')->comment('Reference Document');
            $table->string('LNCL_HREC_PROBLEM')->comment('Problem ปัญหา');
            $table->string('LNCL_HREC_CAUSE')->comment('Cause สาเหตุ');
            $table->string('LNCL_HREC_ACTION')->comment('temporary action');
            $table->integer('LNCL_HREC_STD')->comment('Status Record');
            $table->date('LNCL_HREC_DATE')->comment('วันที่บันทึกปัจจุบัน');
            $table->string('LNCL_HREC_LSTDT')->comment('Date Input now');
            $table->string('LNCL_EMP_UPDATE')->comment('รหัสพนักงานที่อัพเดทข้อมูล');
            $table->bigInteger('LNCL_UPDATE_STD')->comment('สถานะการอัพเดท');
            $table->string('LNCL_HREC_RANKTYPE')->comment('ประเภท Rank');
            $table->integer('LNCL_HREC_TRACKING')->comment('ลำดับที่ที่อนุมัติ');
            $table->integer('LNCL_FINAL_STD')->comment('สถานะเมื่อจบกระบวนการอนุมัติครบทุกลำดับ');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_n_c_l_h_r_e_c_t_b_l');
    }
};
