<?php
namespace App\Http\Controllers\HomeController;
namespace App\Http\Controllers;
use App\Facades\LoadExcel;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function export()
    {
        echo LoadExcel::index('hola jorge coperfields');
    }   

    public function factura()
    {
        $sql = DB::select('
            SELECT sys_users_facturacion.id_users,sys_users.name,sys_users_facturacion.id_factura,sys_users_facturacion.id_cliente,
                   sys_empresas.empresa,sys_empresas.descripcion,
                   sys_sucursales.sucursal,sys_sucursales.descripcion,
                   sys_clientes.rfc_receptor, sys_clientes.razon_social,
                   sys_facturacion.id_estatus,sys_estatus.nombre,sys_facturacion.fecha_factura,sys_facturacion.serie,sys_facturacion.folio,sys_facturacion.uuid,sys_facturacion.iva,sys_facturacion.subtotal,
                   sys_facturacion.total,sys_facturacion.comision,sys_facturacion.pago,
                   sys_parcialidades_fechas.fecha_pago,sys_parcialidades_fechas.id_factura,
                   sys_formas_pagos.clave,sys_formas_pagos.descripcion,
                   sys_metodos_pagos.clave,sys_metodos_pagos.descripcion,
                   sys_conceptos.id_producto,sys_conceptos.cantidad,sys_conceptos.precio,sys_conceptos.total
                   ,sys_productos.clave_producto_servicio,sys_productos.clave_unidad,sys_productos.nombre,
                    sys_conceptos.cantidad,sys_conceptos.precio,sys_conceptos.total
            FROM factu.sys_users_facturacion
            INNER  JOIN factu.sys_users ON sys_users_facturacion.id_users = sys_users.id
            LEFT  JOIN factu.sys_empresas ON sys_users_facturacion.id_empresa = sys_empresas.id
            LEFT  JOIN factu.sys_sucursales ON sys_users_facturacion.id_sucursal = sys_empresas.id
            LEFT  JOIN factu.sys_clientes ON sys_users_facturacion.id_cliente = sys_clientes.id
            LEFT  JOIN factu.sys_facturacion ON sys_users_facturacion.id_factura = sys_facturacion.id
            LEFT  JOIN factu.sys_parcialidades_fechas on sys_facturacion.id = sys_parcialidades_fechas.id_factura
            LEFT  JOIN factu.sys_estatus  ON sys_facturacion.id_estatus = sys_estatus.id
            LEFT  JOIN factu.sys_formas_pagos ON sys_users_facturacion.id_forma_pago = sys_formas_pagos.id
            LEFT  JOIN factu.sys_metodos_pagos ON sys_users_facturacion.id_metodo_pago = sys_metodos_pagos.id
            LEFT  JOIN factu.sys_conceptos  ON sys_users_facturacion.id_concepto = sys_conceptos.id
            LEFT  JOIN factu.sys_productos  ON sys_conceptos.id_producto = sys_productos.id
            where sys_users_facturacion.id_users');
        return view('reporte', ['datos' => $sql]);
    }

    public function report (Request $request){
        // dd($request->all());
        if(isset($request->cliente, $request->fecha_inicio, $request->fecha_final)){
                $slq_q = " = '$request->cliente' AND sys_parcialidades_fechas.fecha_pago BETWEEN '$request->fecha_inicio' AND '$request->fecha_final'  ";
        } elseif (isset($request->cliente, $request->fecha_inicio)) {
                $slq_q = "= '$request->cliente' AND sys_parcialidades_fechas.fecha_pago = '$request->fecha_inicio' ";
        } elseif (isset($request->cliente, $request->fecha_final)) {
                $slq_q = " = '$request->cliente' AND sys_parcialidades_fechas.fecha_pago = '$request->fecha_final' ";
        }elseif (isset($request->cliente)) {
                $slq_q = " = '$request->cliente' GROUP BY sys_users_facturacion.id_factura";
        } elseif (isset($request->fecha_inicio, $request->fecha_final)) {
                $slq_q = " AND sys_parcialidades_fechas.fecha_pago BETWEEN '$request->fecha_inicio' AND '$request->fecha_final' ";
        } elseif (isset($request->fecha_inicio)) {
                $slq_q = " AND sys_parcialidades_fechas.fecha_pago = '$request->fecha_inicio' ";
        } elseif (isset($request->fecha_final)) {
                $slq_q = " AND sys_parcialidades_fechas.fecha_pago = '$request->fecha_final'  ";
        }  else {
                $slq_q = "";
        }
        

        $sql = "
            SELECT sys_users_facturacion.id_users,sys_users.name,sys_users_facturacion.id_factura,sys_users_facturacion.id_cliente,
                   sys_empresas.empresa,sys_empresas.descripcion,
                   sys_sucursales.sucursal,sys_sucursales.descripcion,
                   sys_clientes.rfc_receptor, sys_clientes.razon_social,
                   sys_facturacion.id_estatus,sys_estatus.nombre,sys_facturacion.fecha_factura,sys_facturacion.serie,sys_facturacion.folio,sys_facturacion.uuid,sys_facturacion.iva,sys_facturacion.subtotal,
                   sys_facturacion.total,sys_facturacion.comision,sys_facturacion.pago,
                   sys_parcialidades_fechas.fecha_pago,sys_parcialidades_fechas.id_factura,
                   sys_formas_pagos.clave,sys_formas_pagos.descripcion,
                   sys_metodos_pagos.clave,sys_metodos_pagos.descripcion,
                   sys_conceptos.id_producto,sys_conceptos.cantidad,sys_conceptos.precio,sys_conceptos.total
                   ,sys_productos.clave_producto_servicio,sys_productos.clave_unidad,sys_productos.nombre,
                    sys_conceptos.cantidad,sys_conceptos.precio,sys_conceptos.total
            FROM factu.sys_users_facturacion
            INNER  JOIN factu.sys_users ON sys_users_facturacion.id_users = sys_users.id
            LEFT  JOIN factu.sys_empresas ON sys_users_facturacion.id_empresa = sys_empresas.id
            LEFT  JOIN factu.sys_sucursales ON sys_users_facturacion.id_sucursal = sys_empresas.id
            LEFT  JOIN factu.sys_clientes ON sys_users_facturacion.id_cliente = sys_clientes.id
            LEFT  JOIN factu.sys_facturacion ON sys_users_facturacion.id_factura = sys_facturacion.id
            LEFT  JOIN factu.sys_parcialidades_fechas on sys_facturacion.id = sys_parcialidades_fechas.id_factura
            LEFT  JOIN factu.sys_estatus  ON sys_facturacion.id_estatus = sys_estatus.id
            LEFT  JOIN factu.sys_formas_pagos ON sys_users_facturacion.id_forma_pago = sys_formas_pagos.id
            LEFT  JOIN factu.sys_metodos_pagos ON sys_users_facturacion.id_metodo_pago = sys_metodos_pagos.id
            LEFT  JOIN factu.sys_conceptos  ON sys_users_facturacion.id_concepto = sys_conceptos.id
            LEFT  JOIN factu.sys_productos  ON sys_conceptos.id_producto = sys_productos.id
            where sys_users_facturacion.id_users";
            $sql_all = $sql.$slq_q;

         $sql = DB::select($sql_all);
        return view('reporte', ['datos' => $sql]);   
    }
}
