<?php

namespace App\Traits;

use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\Log;

trait ConsumeSunatServices
{
    public function makeRequest($invoice)
    {
        $see = new See();
        $see->setCertificate(file_get_contents(__DIR__.'/../Services/certificate.pem'));
        $see->setService(SunatEndpoints::FE_BETA);
        $see->setClaveSOL($this->ruc, $this->username, $this->password);

        $response = $see->send($invoice);

        if(method_exists($this, 'decodeResponse'))
        {
            $response = $this->decodeResponse($response);
        }

        /** storing the xml document */
        \Storage::disk('public')->put('invoices'.'/'.$invoice->getName().'.xml', $see->getFactory()->getLastXml());

        return $response;
    }
}
