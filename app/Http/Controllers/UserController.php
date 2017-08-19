<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Users\User;
use App\Domains\Users\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(UserRepository $repository)
    {
        $this->userRep = $repository;
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRep->paginate(10);

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo é obrigatório!',
            'email' => 'O email deve ter um formato válido!',
            'min' => 'A senha deve conter no mínimo :min caracteres!',
            'unique' => 'Email já foi utilizado!'
        ];

        $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6'
            ], $messages);

        if(!empty($this->errors)){
            return response()->json($this->errors);
        }

        $this->userRep->create($request->input());

        return response()->json(null, 200);
    }

    /**
     * Return user data to edit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $messages = [
            'required' => 'Este campo é obrigatório!',
            'email' => 'O email deve ter um formato válido!',
            'min' => 'A senha deve conter no mínimo :min caracteres!',
            'unique' => 'Email já foi utilizado!'
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'required|min:6',
        ], $messages);

        if(!empty($this->errors)){
            return response()->json($this->errors);
        }

        $this->userRep->update($request->input(), $user->id);
        /*$user->name = ucwords($request->input('firstName') . " " . $request->input('lastName'));
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->isAdmin = $request->input('isAdmin');
        $user->save();
*/
        return response()->json(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
