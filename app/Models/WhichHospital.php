<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhichHospital extends Model
{
    protected $guarded = [];
    public function adminCreatedBy()
    {
        return $this->belongsTo('App\Models\Admin', 'created_by', 'id');
    }

    public function adminEditedBy()
    {
        return $this->belongsTo('App\Models\Admin', 'edited_by', 'id');
    }
    public function hospitalSchedule()
    {
        return $this->hasmany('App\Models\scheduleHospital',  'hospitals_schedule_id' ,'id');
    }
}
