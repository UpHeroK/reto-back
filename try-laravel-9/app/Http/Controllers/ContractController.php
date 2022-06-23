<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $contrato = Contract::get();
            return $contrato;
        } catch (\Throwable $th) {
            return $th;
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tipo' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $contrato = Contract::create(
                [
                    'tipo' => $request->tipo
                ]
            );
            return response()->json([
                'message' => 'Contrato registrado correctamente',
                'contrato' => $contrato,
                'successfull' => true
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $contrato = Contract::findOrFail($id);
        $contrato = $contrato->update([
            'tipo' => $request->tipo,

        ]);
        return response()->json([
            'message' => '¡Contrato actualizado correctamente',
            'contrato' => $contrato,
            'successfull' => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            //return "id a borrar: ".$id;
            $contrato = Contract::findOrFail($id);
            //return $usuario;
            $contrato = $contrato->delete();
            return response()->json([
                'message' => 'contrato eliminado correctamente',
                'successfull' => true
            ], 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
