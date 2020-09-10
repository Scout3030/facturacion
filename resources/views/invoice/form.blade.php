@extends('layouts.app')

@push('styles')

@endpush

@section('content')


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">{{__('Facturar orden')}}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('invoices.preview', ['order' => $order->id]) }}">
                    @csrf
                    <div class="form-group">
                        <h5>{{__("Tipo de comprobante")}}</h5>
                        @foreach(\App\Proof::whereStatus(\App\Proof::ACTIVE)->get() as $proof)
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="proof_id" class="custom-control-input" value="{{$proof->code}}">
                            <span class="custom-control-label">{{__($proof->name)}}</span>
                        </label>
                        @endforeach
{{--                        <label class="custom-control custom-radio custom-control-inline">--}}
{{--                            <input type="radio" name="radio-inline" class="custom-control-input"><span class="custom-control-label">{{__("Nota de crédito")}}</span>--}}
{{--                        </label>--}}
{{--                        <label class="custom-control custom-radio custom-control-inline">--}}
{{--                            <input type="radio" name="radio-inline" class="custom-control-input"><span class="custom-control-label">{{__("Nota de débito")}}</span>--}}
{{--                        </label>--}}
                    </div>

                    <div class="form-group">
                        <h5>{{__("Documento")}}</h5>
                        <div class="form-row">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom03">{{__("Serie")}}</label>
                                <input type="text" class="form-control" id="validationCustom03" name="serie" required="">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom04">{{__("Número")}}</label>
                                <input type="text" class="form-control" id="validationCustom04" name="number" required="">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom05">{{__("Fecha emisión")}}</label>
                                <input type="date" class="form-control" id="validationCustom05" name="date" required="">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom06">{{__("Moneda")}}</label>
                                <input type="text" class="form-control" id="validationCustom06" required="" value="{{$order->currency->name}}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>{{__("Cliente")}}</h5>
                        <div class="form-row">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom03">{{__("Tipo de documento")}}</label>
                                <input type="text" class="form-control" id="validationCustom03" value="{{ $order->client->document->name }}" readonly>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom04">{{__("N. de documento")}}</label>
                                <input type="text" class="form-control" id="validationCustom04" value="{{ $order->client->document_number }}" readonly>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom05">{{__("Nombre de cliente")}}</label>
                                <input type="text" class="form-control" id="validationCustom05" value="{{ $order->client->title }}"readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom03">{{__("Dirección")}}</label>
                                <input type="text" class="form-control" id="validationCustom03" value="{{ $order->client->address }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>{{__("Detalle documento")}}</h5>
                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{__("Código")}}</th>
                                                <th scope="col">{{__("Descripción")}}</th>
                                                <th scope="col">{{__("Unidad/Medida")}}</th>
                                                <th scope="col">{{__("Precio")}}</th>
                                                <th scope="col">{{__("Cantidad")}}</th>
                                                <th scope="col">{{__("Subtotal")}}</th>
                                                <th scope="col">{{__("IGV")}}</th>
                                                <th scope="col">{{__("Importe")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->orderLines as $orderLine)
                                            <tr>
                                                <th scope="row">{{$orderLine->product->code}}</th>
                                                <td>{{$orderLine->product->name}}</td>
                                                <td>Otto</td>
                                                <td>{{$orderLine->price}}</td>
                                                <td>{{$orderLine->qty}}</td>
                                                <td>{{($orderLine->price * $orderLine->qty)/1.18}}</td>
                                                <td>{{($orderLine->price * $orderLine->qty)/1.18 * 0.18}}</td>
                                                <td>{{($orderLine->price * $orderLine->qty)}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom03">{{__("Observación")}}</label>
                                <textarea type="text" class="form-control" name="observation" rows="3" ></textarea>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2 offset-lg-1">
                                <label for="validationCustom04">{{__("Resumen")}}</label>
                                <hr>
                                <ul class="list-unstyled">
                                    <li>{{__("Subtotal")}}</li>
                                    <p class="float-right"><strong>{{$order->total/1.18}}</strong></p>
                                    <hr>
                                    <li>{{__("IGV")}}</li>
                                    <p class="float-right"><strong>{{($order->total/1.18) * 0.18}}</strong></p>
                                    <hr>
                                    <li>{{__("Total")}}</li>
                                    <p class="float-right"><strong>{{$order->total}}</strong></p>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-3" type="submit">{{ __("Continuar") }}</button>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sunat-data').click( function () {
                $('#loader').addClass('d-block')
                jQuery.ajax({
                    url: `{{ route('clients.sunat') }}`,
                    type: 'POST',
                    headers: {
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    data: {
                        document : $('#document_number').val()
                    },
                    success: (res) => {
                        $('#loader').removeClass('d-block')
                        console.log(res)
                        $('#title').val(res.razon_social)
                    }
                })
            })
        })
    </script>
@endpush
