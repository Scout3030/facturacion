<form action="{{ route('clients.delete', ['client' => $id]) }}" method="POST">
    @csrf
    @method('delete')
    <button class="btn btn-rounded btn-danger" type="submit">{{__('Eliminar')}}</button>
</form>
