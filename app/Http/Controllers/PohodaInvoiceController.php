<?php

namespace App\Http\Controllers;

use App\Services\PohodaInvoiceService;
use Illuminate\Http\Request;

class PohodaInvoiceController extends Controller
{
    public function __construct(
        private readonly PohodaInvoiceService $invoices
    ) {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $filters = [
            'from'     => $request->query('from'),
            'to'       => $request->query('to'),
            'customer' => $request->query('customer'),
            'status'   => $request->query('status'),
        ];

        return view('pohoda.invoices.index', [
            'filters'   => $filters,
            'invoices'  => $this->invoices->getInvoices($filters, 25),
            'stats'     => $this->invoices->getStats($filters),
            'chart'     => $this->invoices->monthlyChart(6),
            'topCusts'  => $this->invoices->topCustomers(5),
        ]);
    }
}
