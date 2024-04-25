<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Infant;
use App\Models\Schedule;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $users = User::get();
        $infants = Infant::get();
        $schedule = Schedule::get();

        $data = [
            'title' => "Infant's Information",
            'date' => date('m/d/Y'),
            'users' => $users,
            'infants' => $infants,
            'schedule' => $schedule
        ];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('bakunako.pdf');
    }
}
