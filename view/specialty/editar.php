
									<div class="modal fade" id="editRowModal<?php echo $row['codespe']; ?>"  aria-labelledby="myModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														Editar</span> 
														
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form  method="POST" action="../view/specialty/obtener.php?codespe=<?php echo $row['codespe']; ?>">
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group form-group-default">
																	<label>Nombre</label>
															<input type="text" class="form-control" name="nombrees" value="<?php echo $row['nombrees']; ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras, acentos y espacios">
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer no-bd">
														<button type="submit" name="editar" class="btn btn-primary">Editar</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
													</div>
												</form>
											</div>
										</div>
									</div>
									