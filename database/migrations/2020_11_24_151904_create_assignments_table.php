<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');
            $table->string('class_name');
            $table->string('assignment_name');
            $table->string('assignment_description');
            $table->dateTime('final_report_due_date');
            $table->dateTime('peer_marks_due_date');
            $table->dateTime('final_report_grace_period');
            $table->dateTime('peer_marks_grace_period');
            $table->longtext('rubric')->nullable();
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
        Schema::dropIfExists('assignments');
    }
}
