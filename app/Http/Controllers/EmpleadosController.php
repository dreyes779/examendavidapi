<?php

namespace App\Http\Controllers;
use App\Empleados;
use App\Skillss;
use Illuminate\Http\Request;
use DB;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emple = DB::table('skillss')
                            ->join('empleados', 'empleados.id', '=', 'skillss.id_empleado')
                            ->select('empleados.*', 'skillss.nombre as skillnombre','skillss.calificacion')
                            ->get();
        return $emple;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(count($request->skills) >= 1){
            $empleados = new Empleados;
            //Declaramos el nombre con el nombre enviado en el request
            $empleados->nombre = $request->nombre;
            $empleados->email = $request->email;
            $empleados->puesto = $request->puesto;
            $empleados->fecha_nacimiento = $request->fecha_nacimiento;
            $empleados->domicilio = $request->domicilio;
            //Guardamos el cambio en nuestro modelo
            $empleados->save();

            foreach ($request->skills as $key => $values) {
                $ins = Skillss::create(['id_empleado' => $empleados->id, 'nombre' => $values['nombre'], 'calificacion' => $values['calificacion']]);
            }
        }else{
            $empleados = new Empleados;
            //Declaramos el nombre con el nombre enviado en el request
            $empleados->nombre = $request->nombre;
            $empleados->email = $request->email;
            $empleados->puesto = $request->puesto;
            $empleados->fecha_nacimiento = $request->fecha_nacimiento;
            $empleados->domicilio = $request->domicilio;
            //Guardamos el cambio en nuestro modelo
            $empleados->save();
        }

        return response([
        'status' => 'success',
        'data' => $empleados,
        'code' => 200
       ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Empleados::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
