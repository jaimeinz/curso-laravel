<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\UserDomicilio;
use App\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campos = [
            'name',
            'email',
            'telefono',
        ];

        $user = User::select($campos)
            ->findOrFail($id);

        Log::info($user->domicilios()->get());

        $domicilio = [
            'calle',
            'colonia',
            'cp'
        ];

        $user->domicilios = UserDomicilio::select($domicilio)
            ->where('user_id', $id)
            ->get();



        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();

        $user = User::findOrFail($id);

        $user->update($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json(['result' => 'ok'], 200);
    }

    public function contarUsuarios(){
        return User::count();
    }
}
