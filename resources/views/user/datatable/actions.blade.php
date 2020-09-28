<div class="d-flex">
    <a href="{{ route('users.edit', ['user' => $id]) }}" class="btn btn-rounded btn-warning">{{__("Editar")}}</a>
    <form action="{{ route('users.delete', ['user' => $id]) }}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-rounded btn-danger" type="submit">{{__('Eliminar')}}</button>
    </form>
</div>
