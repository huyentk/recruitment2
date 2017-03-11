<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentApplyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_apply_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stu_id');
            $table->unsignedInteger('job_id');
            $table->tinyInteger('result');
            #10: waiting
            #11: fail
            #12: success
            #13: ended
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_apply_jobs');
    }
}
