<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('student_profiles', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users');
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('company_profiles');
        });

        Schema::table('job_skills', function (Blueprint $table) {
            $table->foreign('skill_id')->references('id')->on('skills');
        });

        Schema::table('job_skills', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        Schema::table('student_apply_jobs', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('stu_id')->references('id')->on('student_profiles');
        });

        Schema::table('student_joined_jobs', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('stu_id')->references('id')->on('student_profiles');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
