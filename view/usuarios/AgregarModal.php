
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	
        <div class="modal-content">
            <div class="modal-header">
				<div class="d-flex justify-content-center">
					<h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4>
				</div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			
                <div class="card-body">
	<form method="POST" autocomplete="off" enctype="multipart/form-data" >
					<div class="row">
						
						<div class="col-md-6 pr-0">
							<div class="form-group form-group-default">
								<label>Nombre</label>
								<input name="nombre" type="text" class="form-control" required placeholder="Ingrese nombre">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Usuario</label>
								<input name="usuario" type="text" class="form-control" required placeholder="Ingrese usuario">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Cargo</label>
								<select class="form-control" name="cargo">
									<option value="1">Administrador</option>
									<option value="3">Secretaria</option>
									<option value="4">Medico</option>
						</select>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Correo</label>
								<input name="email" type="text" class="form-control" required placeholder="Ingrese correo">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Password</label>
								<input name="clave" type="password" class="form-control" required placeholder="Ingrese contraseña">
							</div>
						</div>
						
						
						
						
					</div>
			
            </div>

        </div>
			<div class="modal-footer">
                
                <button type="submit" name="agregar" class="btn btn-primary" style="border-radius: 50%"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Registro</button>
				<button type="button" class="btn btn-danger" style="border-radius: 50%" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
				
			</form>
                </div>
			
            </div>

        </div>
		
    </div>
</div>
</div>
