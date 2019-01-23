<form method="">
<div class="modal fade" id="edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
		        <h5 class="modal-title">Datos empleado</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
			</div>
			<div class="modal-body">
				<label for="keep">Nombre</label>
				<input type="text" name="usuario" class="form-control" v-model="fillKeep.nombre">
				
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control" v-model="fillKeep.email">
				
				<label for="puesto">Puesto</label>
				<input type="text" name="puesto" class="form-control" v-model="fillKeep.puesto">
				
				<label for="fecha_nacimiento">Telefono</label>
				<input type="text" name="fecha_nacimiento" class="form-control" v-model="fillKeep.fecha_nacimiento">
				<br>
				
				
			</div>
				<input type="text" id="latitude" placeholder="latitude" name="lat">
                <input type="text" id="longitude" placeholder="longitude" name="lng">
                <div class="col-md-4">

                    <h5><b>localización</b> <i class="tip" data-tip-content="Puede escribir su ubicación más el municipio o arrastrar el punto rojo para encontrar su domicilio."></i></h5>
                    <input class="postcode" id="Postcode" name="Postcode" type="text" value="" v-model="fillKeep.domicilio">
                    <input type="submit" id="findbutton" value="Buscar" />

                </div>
                <div class="col-md-6">          
                    <div id="map" style="width:350px; height:150px"></div>
                </div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" data-dismiss="modal" value="Cancelar cerrar">
			</div>
		</div>
	</div>
</div>
</form>