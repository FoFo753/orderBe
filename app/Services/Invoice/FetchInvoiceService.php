<?php

namespace  App\Services\Invoice;

use App\Models\Invoice;
use App\Services\BaseService;

class FetchInvoiceService extends BaseService
{
    public function handle()
    {
        $invoice = Invoice::find($this->data);
        $data = $invoice->bookings($invoice->id_bookings);
        $invoice['bookings']  = $data;

        return $invoice;
    }
}
