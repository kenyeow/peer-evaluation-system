<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'class_id', 'class_name', 'assignment_name','assignment_description','final_report_due_date','peer_marks_due_date','final_report_grace_period', 'peer_marks_grace_period','rubric',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
       
        'final_report_due_date' => 'datetime',
        'peer_marks_due_date' => 'datetime',
        'final_report_grace_period' => 'datetime',
        'peer_marks_grace_period' => 'datetime',
        'rubric'=> 'array',
    ];
}
