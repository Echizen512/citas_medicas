<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4></center>
            </div>
			<div class="container-fluid">
                <div class="card-body">
				<form method="POST" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>C.I:</label>
								<input name="dnidoc" required type="number" class="form-control" maxlength="8" placeholder="C.I" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
							</div>
						</div>
						<div class="col-md-6 pr-0">
							<div class="form-group form-group-default">
								<label>Nombre</label>
								<input name="nomdoc" required type="text" class="form-control" placeholder="Ingrese nombre" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}"  title="La clave debe tener al menos 6 caracteres, una letra mayúscula, una letra minúscula y un número.">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Apellidos</label>
								<input name="apedoc" required type="text" class="form-control" placeholder="Ingrese apellidos" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}"  title="La clave debe tener al menos 6 caracteres, una letra mayúscula, una letra minúscula y un número.">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default" required>
								<label>Especialidad</label>
								<select class="form-control" id="doctor" name="codespe">
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Sexo</label>
						<select class="form-control" name="sexo" required>
							<option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
						</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Teléfono</label>
								<input name="telefo" required type="number" class="form-control" maxlength="9" placeholder="Ingrese teléfono" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Fecha nacimiento</label>
								<input 
									name="fechanaci" 
									type="date" 
									class="form-control" 
									placeholder="Ingrese fecha"
									min="1940-01-01" 
									max="2050-12-31"
									required
								>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Correo</label>
								<input 
									name="correo" 
									type="email" 
									class="form-control" 
									placeholder="Ingrese correo"
									required
								>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Municipio</label>
						<select class="form-control" name="naciona" required>
							<option value="Castor Nieves Rios">Castor Nieves Rios</option>
							<option value="Zuata">Zuata</option>
						</select>
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