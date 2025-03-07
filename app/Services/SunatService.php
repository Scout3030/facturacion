<?php

namespace App\Services;

use App\Traits\ConsumeSunatServices;
use DateTime;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\SaleDetail;
use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SunatService
{
    use ConsumeSunatServices;

    protected $ruc;
    protected $username;
    protected $password;
//    protected $certificate_password;

    public function __construct()
    {
        $this->ruc = (string) config('services.sunat.ruc');
        $this->username = (string) config('services.sunat.username');
        $this->password = (string) config('services.sunat.password');
//        $this->certificate_password = (string) config('services.sunat.password');
    }

    public function sendInvoice($data) {

        $client = new Client();
        $client->setTipoDoc('6')
            ->setNumDoc($data['client']['document_number'])
            ->setRznSocial($data['client']['title']);
        // Emisor
        $address = new Address();
        $address->setUbigueo('150101')
            ->setDepartamento('LIMA')
            ->setProvincia('LIMA')
            ->setDistrito('LIMA')
            ->setUrbanizacion('-')
            ->setDireccion('Av. Villa Nueva 221')
            ->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 de lo contrario.

        $company = new Company();
        $company->setRuc('20123456789')
            ->setRazonSocial('GREEN SAC')
            ->setNombreComercial('GREEN')
            ->setAddress($address);

        // Venta
        $invoice = (new Invoice())
            ->setUblVersion('2.1')
            ->setTipoOperacion('0101') // Venta - Catalog. 51
            ->setTipoDoc('01') // Factura - Catalog. 01
            ->setSerie('F001')
            ->setCorrelativo('1')
            ->setFechaEmision(new DateTime('2020-08-24 13:05:00'))
            ->setTipoMoneda('PEN') // Sol - Catalog. 02
            ->setCompany($company)
            ->setClient($client)
            ->setMtoOperGravadas(100.00)
            ->setMtoIGV(18.00)
            ->setTotalImpuestos(18.00)
            ->setValorVenta(100.00)
            ->setSubTotal(118.00)
            ->setMtoImpVenta(118.00)
        ;

        $item = (new SaleDetail())
            ->setCodProducto('P001')
            ->setUnidad('NIU') // Unidad - Catalog. 03
            ->setCantidad(2)
            ->setDescripcion('PRODUCTO 1')
            ->setMtoBaseIgv(100)
            ->setPorcentajeIgv(18.00) // 18%
            ->setIgv(18.00)
            ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
            ->setTotalImpuestos(18.00)
            ->setMtoValorVenta(100.00)
            ->setMtoValorUnitario(50.00)
            ->setMtoPrecioUnitario(59.00)
        ;

        $legend = (new Legend())
            ->setCode('1000') // Monto en letras - Catalog. 52
            ->setValue('SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES');

        $invoice->setDetails([$item])
            ->setLegends([$legend]);

        $invoiceService = new InvoiceService();
        $invoiceService->addData('generatedInvoice', $invoice);

        return $this->makeRequest($invoice);
    }

    public function sunatRuc ($ruc) {

        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.sunat.cloud',
        ]);

        $ruc = (string) $ruc;

        $response = $client->request(
            'GET',
            "/ruc/{$ruc}"
        );

        $response = $response->getBody()->getContents();

        return json_decode($response, true);
    }


}
