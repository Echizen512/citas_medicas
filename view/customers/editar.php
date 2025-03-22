<div class="modal fade" id="editRowModal<?php echo $row['codpaci']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Editar</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../view/customers/obtener.php?codpaci=<?php echo $row['codpaci']; ?>">
                    <input class="form-control" name="codpaci" type="hidden" value="<?php echo $row['codpaci']; ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Cédula del Representante</label>
                                <input type="number" maxlength="8" class="form-control" name="dnipa" value="<?php echo $row['dnipa']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Nombres</label>
                                <input type="text" class="form-control" name="nombrep" value="<?php echo $row['nombrep']; ?>" pattern="[A-Za-zÁ-ÿ\s]+" title="El nombre debe contener solo letras y espacios, incluyendo acentos.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" name="apellidop" value="<?php echo $row['apellidop']; ?>" pattern="[A-Za-zÁ-ÿ\s]+" title="El nombre debe contener solo letras y espacios, incluyendo acentos.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Seguro</label>
                                <select class="form-control" name="seguro">
                                    <option value="Si" <?php echo ($row['seguro'] == 'Si') ? 'selected' : ''; ?>>Si</option>
                                    <option value="No" <?php echo ($row['seguro'] == 'No') ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Teléfono</label>
                                <input type="number" class="form-control" name="tele" value="<?php echo $row['tele']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Sexo</label>
                                <select class="form-control" name="sexo">
                                    <option value="Masculino" <?php echo ($row['sexo'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="Femenino" <?php echo ($row['sexo'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Fecha de Nacimiento</label>
								<input 
									type="date" 
									class="form-control" 
									name="fecha_nacimiento" 
									value="<?php echo $row['fecha_nacimiento']; ?>" 
									min="2006-01-01" 
									max="2050-12-31" 
									required
								>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Usuario</label>
                                <input type="text" required class="form-control" name="usuario" value="<?php echo $row['usuario']; ?>" placeholder="Usuario">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Clave</label>
                                <input 
									type="password" 
									class="form-control" 
									name="clave" 
									placeholder="Clave" 
									required 
									pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}" 
									title="La clave debe tener al menos 6 caracteres, una letra mayúscula, una letra minúscula y un número."
								>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="editar" class="btn btn-primary" style="border-radius: 50%">Editar</button>
                        <button type="button" class="btn btn-danger" style="border-radius: 50%" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
