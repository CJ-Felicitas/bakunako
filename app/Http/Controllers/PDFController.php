<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Infant;
use App\Models\Schedule;

class PDFController extends Controller
{
    public function generatePDF($id)
    {

        $users = User::get();

        $infant = Infant::where('id', $id)->first();
        $schedule = Schedule::where('infants_id', $id)->get();

        $data = [
            'title' => "Infant's Information",
            'date' => date('m/d/Y'),
            'users' => $users,
            'infant' => $infant,
            'schedules' => $schedule
        ];

        $pdf = PDF::loadView('myPDF', $data);
        $pdf->setBasePath(public_path());

        return $pdf->download('BakunAko.pdf');
    }
}
