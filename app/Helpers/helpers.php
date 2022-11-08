<?php
    function generalSettings(){
        $generalSettings = App\Models\generalSettings::latest()->first();
        return $generalSettings;
    }

use App\Models\DoctorMyself;
use App\Models\WhichHospital;
use App\Models\GeneralSettings;

function DoctorMyself()
{
    return DoctorMyself::where('status', 'Active')->first();
}
function WhichHospital()
{
    return WhichHospital::where('status', 'Active')->get();
}
function GneralSettings()
{
    return GeneralSettings::all();
}


