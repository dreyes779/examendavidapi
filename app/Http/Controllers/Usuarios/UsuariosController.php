<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Usuarios;
use App\Skills;
use DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Usuarios::orderBy('id', 'DESC')->paginate(10);

        return [
            'pagination' => [
                'total'         => $tasks->total(),
                'current_page'  => $tasks->currentPage(),
                'per_page'      => $tasks->perPage(),
                'last_page'     => $tasks->lastPage(),
                'from'          => $tasks->firstItem(),
                'to'            => $tasks->lastPage(),
            ],
            'tasks' => $tasks
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'usuario'   => 'required',
        // ]);

        $datos = ['usuario' => $request->usuario, 'apellidos' => $request->apellidos, 'email' => $request->email, 'telefono' => $request->telefono];
        $datos = Usuarios::create($datos);

        $user = Usuarios::orderby('created_at','DESC')->take(1)->get();
        $id_user = $user[0]['id'];

        foreach ($request->datos as $key => $values) {
            $ins = Skills::create(['nombre' => $values['habilidades'], 'id_user' => $id_user]);
        }

        // for ($i=0; $i < count($request->datos); $i++){
        //     $data[$i] = $request->datos;
        // }
        // DB::table('skills')->insert(['nombre' => 'dsd', 'id_user' => $id_user]);
        //$skills = Skills::create($d,$id_user);

        // $sql = Usuarios::get()->;

        return;
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
        $datos = ['usuario' => $request->usuario, 'apellidos' => $request->apellidos, 'email' => $request->email, 'telefono' => $request->telefono];

        Usuarios::find($id)->update($datos);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = Usuarios::findOrFail($id);
        $datos->delete();
    }

    public function obtData(){
        $users = Usuarios::select("usuario")->groupBy("usuario")->get();
        return json_encode($users);
    }
}
