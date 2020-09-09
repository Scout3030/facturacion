<div class="d-flex">
    <a href="{{ route('categories.edit', ['category' => $id]) }}" class="btn btn-rounded btn-warning">{{__("Editar")}}</a>
    <form action="{{ route('categories.delete', ['category' => $id]) }}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-rounded btn-danger" type="submit">{{__('Eliminar')}}</button>
    </form>
</div>
