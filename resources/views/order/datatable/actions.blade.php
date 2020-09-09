<div class="d-flex">
    <a href="{{ route('orders.edit', ['order' => $id]) }}" class="btn btn-rounded btn-warning">{{__("Editar")}}</a>
    <form action="{{ route('orders.delete', ['order' => $id]) }}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-rounded btn-danger" type="submit">{{__('Eliminar')}}</button>
    </form>
    <a href="{{ route('invoices.create', ['order' => $id]) }}" class="btn btn-rounded btn-warning">{{__("Facturar")}}</a>
</div>
