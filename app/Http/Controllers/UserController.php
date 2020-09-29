<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Rules\StrengthPassword;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.index');
    }

    public function create()
    {
        $user = new User();
        $btnText = __("Registrar usuario");
        return view('user.form', compact('user', 'btnText'));
    }

    public function edit(User $user)
    {
        $btnText = __("Actualizar datos");
        return view('user.form', compact('user', 'btnText'));
    }

    public function update(Request $request, User $user)
    {
//        dd($request->all());
//        $this->validate(request(), [
//            'password' => ['confirmed', new StrengthPassword]
//        ]);
        if ($request->has('password')){
            $request->merge(['password' => bcrypt(request('password'))]);
        }
        if($request->hasFile('picture')) {
            \Storage::delete('profile/' . $request->picture);
            $picture = Helper::uploadFile( "picture", 'users');
            $request->merge(['picture' => $picture]);
        }
        $user->fill($request->input())->save();
        $user->save();

        return back()->with('message', ['success', __("Datos de usuario actualizados correctamente")]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect( route('users.index') )
            ->with('message', ['success', __("Categorìa eliminada correctamente")]);
    }

    public function datatable () {
        $users = User::with(['role'])->get();
        return \DataTables::of($users)
            ->editColumn('role', function(User $user) {
                return __($user->role->name);
            })
            ->editColumn('image', 'user.datatable.image')
//            ->addColumn('actions', 'user.datatable.actions')
            ->addColumn('actions', function(User $user) {
                return '<div class="d-flex">
                            <a href="'. route('users.edit', ['user' => $user]) .'" class="btn btn-rounded btn-warning">'.__("Editar").'</a>
                            <form action="'. route('users.delete', ['user' => $user]) .'" method="POST">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-rounded btn-danger" type="submit">'.__('Eliminar').'</button>
                            </form>
                        </div>';
            })
            ->rawColumns(['actions', 'image'])
            ->toJson();
    }
}
