<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $customers = Customer::with(['hobbies'])->get();
        $pdf = PDF::loadView('customer-report', ['customers' => $customers]);
        return $pdf->download('customer-report.pdf');
    }
}
