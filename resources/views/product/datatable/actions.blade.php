<div class="d-flex">
    <a href="{{ route('products.edit', ['product' => $id]) }}" class="btn btn-rounded btn-warning">{{__("Editar")}}</a>
    <form action="{{ route('products.delete', ['product' => $id]) }}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-rounded btn-danger" type="submit">{{__('Eliminar')}}</button>
    </form>
</div>
