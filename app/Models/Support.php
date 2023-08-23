<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','type','subject','body','priority','status', 'expired'];

    public static $priority = [
        'Low',
        'Medium',
        'High',
        'Critical',
    ];

    public static $status = [
        '1' => 'Open',
        '0' => 'Close',
        '2' =>  'On Hold',
    ];

    public function createdBy()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    public static function status() {
        $status['1'] = __ ('Open');
        $status['0'] = __ ('Close');
        $status['2'] = __ ('On Hold');
        return $status;
    }
}
