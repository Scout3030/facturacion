<?php


namespace App\Services;
use Illuminate\Support\Collection;

class InvoiceService
{
    /**
     * @var Collection
     */
    protected $invoice;

    /**
     * Cart constructor.
     */
    public function __construct() {
        if (session()->has("invoice")) {
            $this->invoice = session("invoice");
        } else {
            $this->invoice = new Collection;
        }
    }

    /**
     *
     * Get cart contents
     *
     */
    public function getContent() {
        return $this->invoice;
    }

    /**
     * Save the data on sessions
     */
    protected function save(): void {
        session()->put("invoice", $this->invoice);
        session()->save();
    }

    /**
     * @param $key
     * @param $value
     */
    public function addData($key, $value): void{
        $this->invoice->put($key, $value);
        $this->save();
    }

    /**
     * Deleting invoice sessions
     */
    public function deleteInvoice(): void {
        $this->invoice = new Collection;
        $this->save();
    }
}
