<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam_sched extends Model
{
    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
