<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentAssignment extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'student_id', 'class_id', 'assignment_id', 
        'draft_report_name', 'final_report_name', 'draft_report', 'final_report', 
        'peer_marks_given', 'peer_marks_received', 
        'grade', 'grade_calculation', 'grade_appeal', 'grade_appeal_date',
        'submit_status', 'feedback_status', 'evaluate_status', 'grade_appeal_status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'peer_name_feedback'=> 'array',
        'feedback'=> 'array',
    ];
   
}
