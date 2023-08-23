<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckInOut extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','start_time','end_time','reason_late','reason_early', 'OT', 'late'];

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
