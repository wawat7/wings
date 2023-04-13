<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $transactions = TransactionHeader::with('details.product')->get();
        return view('report.index', [
            'transactions' => $transactions
        ]);
    }
}
