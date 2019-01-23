
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Facturas </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}"> -->

	
	<!-- 	<link rel="stylesheet" href="css/custom.css"> -->
	<link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">
</head>
<body>
	<nav class="navbar navbar-success ">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->

		</div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="btn-group pull-right">
					<div class="pull-right">
						<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-add-factura" title="Agregar Factura"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</button> -->
					</div>
				</div>
				<h4><i class='glyphicon glyphicon-search'></i> Buscar Facturas</h4>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="{{ ROUTE('report') }}">
					{{ csrf_field() }}
					<div class="form-group row">
						<label for="q" class="col-md-2 control-label">Cliente</label>
						<div class="col-md-5">
							<input type="text" class="form-control" id="cliente" name="cliente" placeholder="id">
						</div>

						<div class="col-md-3">
							<button type="submit" class="btn btn-success">
								<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
						</div>
							
						</div>

						<div class="form-group row">
							<label class="col-sm-2 control-label">Fecha Inicio</label>
							<div class="col-sm-4">
								<input type="text" class="form-control calendario" name="fecha_inicio" autocomplete="off">
							</div>
							<label class="col-sm-2 control-label">Fecha Final</label>
							<div class="col-sm-4">
								<input type="text" class="form-control calendario" name="fecha_final" autocomplete="off">
							</div>
						</div>

					</form>
					<div id="resultados"></div><!-- Carga los datos ajax -->
					<div class='outer_div'></div><!-- Carga los datos ajax -->
					<div class="table-responsive">
						<table class="table table-hover">
							<tbody><tr style="background-color: #337ab7; color: #ffffff;">
								<th>Folio</th>
								<th>Fecha pago</th>
								<th>Cliente</th>
								<th>Vendedor</th>
								<th>Estatus</th>
								<th class="text-right">Total</th>
								<!-- 								<th class="text-right">Acciones</th> -->

							</tr>
							@foreach( $datos as $fila)
							<tr>
								<td data-toggle="modal" data-target="#modal-detail-factura">{{ $fila->folio }}</td>
								<td data-toggle="modal" data-target="#modal-detail-factura">{{ $fila->fecha_pago }}</td>
								<td><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="<i class='glyphicon glyphicon-phone'></i> 444<br><i class='glyphicon glyphicon-envelope'></i>  444@44.44">{{ $fila->razon_social }}</a></td>
								<td>{{ $fila->name }}</td>
								<td><span class="label label-success">Pagada</span></td>
								<td class="text-right">{{ $fila->total }}</td>					
<!-- 								<td class="text-right">
									<a href="editar_factura.php?id_factura=4792" class="btn btn-default" title="Editar factura"><i class="glyphicon glyphicon-edit"></i></a> 
									<a href="#" class="btn btn-default" title="Descargar factura" onclick="imprimir_factura('4792');"><i class="glyphicon glyphicon-download"></i></a> 
									<a href="#" class="btn btn-default" title="Borrar factura" onclick="eliminar('2517')"><i class="glyphicon glyphicon-trash"></i> </a>
								</td> -->

							</tr>
							@endforeach
							<tr>
								<td colspan="7"><span class="pull-right"><ul class="pagination pagination-large"><li class="disabled"><span><a>‹ Prev</a></span></li><li class="active"><a>1</a></li><li><a href="javascript:void(0);" onclick="load(2)">2</a></li><li><a href="javascript:void(0);" onclick="load(3)">3</a></li><li><a href="javascript:void(0);" onclick="load(4)">4</a></li><li><a href="javascript:void(0);" onclick="load(5)">5</a></li><li><a>...</a></li><li><a href="javascript:void(0);" onclick="load(225)">225</a></li><li><span><a href="javascript:void(0);" onclick="load(2)">Next ›</a></span></li></ul></span></td>
							</tr>
						</tbody></table>
					</div>
				</div>
			</div>	

		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>	


<script type="text/javascript">
	upload_file = function (params, path_url, maxfile, type_file, methods){
		//path_url = "Upload/Upload_file";
		jQuery('#modal_dialog').css('width','60%');
		Dropzone.autoDiscover = false;
		jQuery('#div_dropzone_file').html('<div class="dropzone" id="dropzone_xlsx_file" height="20px"><div class="fallback"><input name="file" type="file"/></div></div>').ready(function(){
			var jsonResponse;
			jQuery("#dropzone_xlsx_file").dropzone({
				uploadMultiple: true,
				url: path_url,
				maxFiles: maxfile,
				paramName: "file",
				acceptedFiles: type_file,
				dictDefaultMessage: "Dar Click aqui o arrastrar archivo",
				dictFallbackMessage: "layoutLang['mjs_navegador']",
				dictFileTooBig: "layoutLang['file_size']",
				dictInvalidFileType: "archivo incorrecto",
				dictResponseError: "layoutLang['error_server']",
				dictCancelUpload: "layoutLang['cancel']",
				dictCancelUploadConfirmation: "layoutLang['confirmacion']",
				dictRemoveFile: "layoutLang['eliminar_file']",
				dictMaxFilesExceeded: "No se puede subir mas archivos de los permitidos",
				headers: {
					'usuario': jQuery('#id_usuario').val()
					,'token':  jQuery('#token').val()
					,'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				//dictRemoveFile:true,
				success:function( data, datos ) {
					var jsonRequest = JSON.parse(datos);
					if (jsonRequest.success === true) {
						//toastr.success( 'El archivo seleccionado se cargo con exito', '¡Archivo Cargado.!' );
					}else{
						// toastr.error( 'El archivo no se cargo con exito', '¡No se Cargo Correctamente.!' );
					}
					methods(jsonRequest);

				},
				accept: function(file, done){
					if (file.name == "imagen.jpg") {done("Archivo Incorrecto");}else {done();}
					},
					sending: function(parmt1,parmt2,data){
						data.append('datos', {params} );
						//$('.loader').show();
						//$('#dropzone_div').hide();
					},
					init: function() {
						this.on("complete", function(file) {
							//this.removeAllFiles(true);
						});
					},
					complete: function(data) {
						//pnotify('Archivo Cargado.!','El archivo seleccionado se cargo con exito','success');
                                    /* swal(
                                      'Archivo Cargado Correctamente.!',
                                      datos.response.mgs,
                                      'success'
                                      );*/
                                  }

                              });

		});

	}

</script>
<script type="text/javascript">
	var upload_url = 'createFactura';   
	upload_file('',upload_url,1,'.pdf,.xml',function( request ){  
		//console.log(request);      
		// var parse = JSON.parse(request);
		$('input[name=fecha_pago]').val(request.fecha_pago);
		$('input[name=pago]').val(request.pago);
		$('input[name=pago_menos_impuestos]').val(request.pago_menos_impuestos);
		$('input[name=folio_factura]').val(request.folio_factura);
		$('input[name=fecha_factura]').val(request.fecha_factura);

	});
</script>
<script type="text/javascript"> 
$(document).ready(function() {
    $('.calendario').datepicker({
      format: 'yyyy-mm-dd',
   	  autoclose: true,
      pickTime: false,
      autoclose: true,
      language: 'es'
    });
  });
</script>
<script type="text/javascript" src="{{ asset('js/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/locales/bootstrap-datepicker.es.min.js') }}"></script>
</body>
</html>