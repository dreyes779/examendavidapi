<form method="POST" v-on:submit.prevent="createKeep">
	<div class="modal fade" id="create">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Crear</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="keep">Nombre</label>
					<input type="text" class="form-control" v-model="newKeep.usuario" name="usuario">
					<label for="keep">Apellidos</label>
					<input type="text" class="form-control" v-model="newKeep.apellidos" name="apellidos">
					<label for="email">Correo</label>
					<input type="text" class="form-control" v-model="newKeep.email" name="email">
					<label for="telefono">Telefono</label>
					<input type="text" class="form-control" v-model="newKeep.telefono" name="telefono">
				</div>
				<div class="col-sm-7">

				        <button class="btn btn-info" v-on:click.prevent="addRow">+ Habilidad</button>
				        	<div v-if="rows !== ''">
					            <div v-for="row in rows">
					                <input type="text" v-model="row.habilidades" name="habilidades">
					                <a v-on:click="removeElement(row);" style="cursor: pointer" title="Borrar">x</a>
					            </div>
					        </div>
					        <div v-else>
					        	<div v-for="row in rows">
					                <input type="text" v-model="row.habilidades" name="habilidades">
					                <a v-on:click="removeElement(row);" style="cursor: pointer" title="Borrar">x</a>
					            </div>
					        </div>
					        @{{$data.rows}}
				</div>
				    
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Guardar">
				</div>
			</div>
		</div>
	</div>
</form>