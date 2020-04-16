<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDomicilioRequest;
use App\Models\UserDomicilio;

class UserDomicilioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campos = [
            'users_domicilios.id',
            'users_domicilios.calle',
            'users_domicilios.colonia',
            'users_domicilios.cp',
            'users.name as usuario'
        ];

        $domicilios = UserDomicilio::select($campos)
            ->joinUser()
            ->get();

        return response()->json($domicilios, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDomicilioRequest $request)
    {
        $data = $request->all();

        UserDomicilio::create($data);

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
            'users_domicilios.id',
            'users_domicilios.calle',
            'users_domicilios.colonia',
            'users_domicilios.cp',
            'users.name as usuario'
        ];


        $domicilio = UserDomicilio::select($campos)
            ->joinUser()
            ->findOrFail($id);

        return response()->json($domicilio, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserDomicilioRequest $request, $id)
    {
        $data = $request->all();

        $domicilio = UserDomicilio::findOrFail($id);

        $domicilio->update($data);

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
        UserDomicilio::findOrFail($id)->delete();

        return response()->json(['result' => 'ok'], 200);
    }
}
