<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;

class HealthCareProviderController extends Controller
{
    public function view_infants_schedule()
    {   
        $currentDate = Carbon::now()->toDateString();
   
        $schedules = Schedule::where('date', '2024-04-14')->get();
        return view('site.healthcare_provider.dashboard', compact('schedules'));
    }
}
