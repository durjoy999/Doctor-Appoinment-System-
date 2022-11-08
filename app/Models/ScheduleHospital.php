<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scheduleHospital extends Model
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
        return $this->hasOne('App\Models\WhichHospital', 'id' ,'hospitals_schedule_id');
    }



}
