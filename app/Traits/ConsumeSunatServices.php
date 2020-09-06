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

        // Guardar XML firmado digitalmente.
        \Storage::disk('public')->put('invoices'.'/'.$invoice->getName().'.xml', $see->getFactory()->getLastXml());

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$response->isSuccess()) {
            // Mostrar error al conectarse a SUNAT.
            Log::debug('Ocurrió un error al enviar la factura a la SUNAT '.json_encode($response->getError()));
            return false;
        }
        // Guardamos el CDR
        \Storage::disk('public')->put('invoices'.'/R-'.$invoice->getName().'.zip', $response->getCdrZip());

        $cdr = $response->getCdrResponse();

        $code = (int) $cdr->getCode();

        if ($code === 0) {
            Log::info('FACTURA aceptada '.PHP_EOL);
        } else if ($code >= 4000) {
            Log::info('FACTURA ACEPTADA CON OBSERVACIONES '.json_encode($cdr->getNotes()).PHP_EOL);
        } else if ($code >= 2000 && $code <= 3999) {
            Log::info('FACTURA RECHAZADA '.json_encode($cdr->getNotes()).PHP_EOL);
        } else {
            /* Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción. */
            /*code: 0100 a 1999 */
            echo 'Excepción';
        }
        Log::info(json_encode($cdr->getDescription()).PHP_EOL);

        return true;
    }
}
