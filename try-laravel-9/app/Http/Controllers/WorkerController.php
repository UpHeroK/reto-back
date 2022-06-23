<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Worker;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worker = Worker::with(['pay', 'pay.contract'])->get([
            'id',
            'nombre',
            'pay_id',

        ]);
        return $worker;
    }

    public function show($id)
    {
        $worker = Worker::with(['pay', 'pay.contract'])->find(['id', $id]);
        return $worker;
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
                'nombre' => 'required',
                'direccion' => 'required',
                'documento' => 'required|unique:workers,documento',
                'telefono' => 'required',
                'edad' => 'required',
                'hobby' => 'required',
                'sueldo' => 'required',
                'duracion' => 'integer',
                'contract_id' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            return DB::transaction(function () use ($request) {
                if ($request->contract_id == 4) {
                    $contract = Pay::create([
                        'sueldo' => $request->sueldo,
                        'contract_id' => $request->contract_id,
                    ]);
                } else {
                    $contract = Pay::create([
                        'sueldo' => $request->sueldo,
                        'contract_id' => $request->contract_id,
                        'duracion' => $request->duracion
                    ]);
                }
                $worker = Worker::create([
                    'nombre' => $request->nombre,
                    'direccion' => $request->direccion,
                    'documento' => $request->documento,
                    'telefono' => $request->telefono,
                    'pay_id' => $contract->id,
                    'edad' => $request->edad,
                    'hobby' => $request->hobby,
                ]);
                return response()->json([
                    'message' => 'Trabajador registrado correctamente',

                    'successfull' => true
                ], 200);
            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'direccion' => 'required',
                'documento' => 'required',
                'telefono' => 'required',
                'edad' => 'required',
                'hobby' => 'required',
                'sueldo' => 'required',
                'duracion' => 'integer',
                'contract_id' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $worker = Worker::findOrFail($id);
            $pay = Pay::findOrFail($worker->pay_id);
            return DB::transaction(function () use ($request, $worker, $pay) {
                if ($request->contract_id == 4) {
                    $pay = $pay->update([
                        'sueldo' => $request->sueldo,
                        'contract_id' => $request->contract_id,
                        'duracion' => null
                    ]);
                } else {
                    $pay = $pay->update([
                        'sueldo' => $request->sueldo,
                        'contract_id' => $request->contract_id,
                        'duracion' => $request->duracion
                    ]);
                }
                $worker = $worker->update([
                    'nombre' => $request->nombre,
                    'direccion' => $request->direccion,
                    'documento' => $request->documento,
                    'telefono' => $request->telefono,
                    'edad' => $request->edad,
                    'hobby' => $request->hobby,
                ]);
            });
            return response()->json([
                'message' => 'Trabajador registrado correctamente',
                'successfull' => true
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {

        //return "id a borrar: ".$id;
        $worker = Worker::findOrFail($id);
        //return $usuario;
        $worker = $worker->delete();
        return response()->json([
            'message' => 'Trabajador eliminado correctamente',
            'successfull' => true
        ], 201);
    }
    public function generatePDF(request $request)
    {

        $data = [
            'title' => 'Trabajadores COEX',
            'date' => date('m/d/Y'),
            'worker' => $request
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('reporte.pdf');
    }
}
