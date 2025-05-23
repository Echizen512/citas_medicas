<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="card-body">
                        <form method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Fecha</label>
                                        <input id="fecha" name="dates" type="date" class="form-control" required
                                            placeholder="Ingrese fecha">
                                    </div>
                                </div>

                                <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    let today = new Date().toISOString().split("T")[0];
                                    document.getElementById("fecha").setAttribute("min", today);
                                });
                                </script>


                                <div class="col-md-6 pr-0">
                                    <div class="form-group form-group-default">
                                        <label>Hora</label>
                                        <input name="hour" type="time" class="form-control" required
                                            placeholder="Ingrese la hora">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Paciente</label>
                                        <select class="form-control" id="paciente" required name="codpaci">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Especialidad</label>
                                        <select class="form-control" id="continentes" required name="codespe">


                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Médico</label>
                                        <select class="form-control" id="paises" required name="coddoc">
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" name="agregar" style="border-radius: 50%" class="btn btn-primary"><span
                            class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                    <button type="button" class="btn btn-danger" style="border-radius: 50%" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>