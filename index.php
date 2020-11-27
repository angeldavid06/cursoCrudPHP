<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla</title>
    <?php 
        require_once "scripts.php";
    ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    Tablas dinamicas con datatable
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#insertarDatos">
                        Agregar nuevo
                    </span>
                    <hr>
                    <div id="tablaDatatable"></div>
                </div>
                <div class="card-footer text-muted">
                    By Angel Martinez
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Insertar -->
    <div class="modal fade" id="insertarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega nuevos juegos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevo">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-sm" name="nom" id="nom">
                        <label for="">Año</label>
                        <input type="text" class="form-control input-sm" name="anio" id="anio">
                        <label for="">Empresa</label>
                        <input type="text" class="form-control input-sm" name="emp" id="emp">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnInsertar" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Actualizar -->
    <div class="modal fade" id="actualizarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar juegos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoU">
                        <input type="text" hidden="" name="idJuego" id="idJuego">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-sm" name="nomU" id="nomU">
                        <label for="">Año</label>
                        <input type="text" class="form-control input-sm" name="anioU" id="anioU">
                        <label for="">Empresa</label>
                        <input type="text" class="form-control input-sm" name="empU" id="empU">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnActualizar" type="button" class="btn btn-warning">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#btnInsertar').click(function () {
                datos = $('#frmnuevo').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregar.php",
                    success:function(r) {
                        if (r == 1) {
                            $('#tablaDatatable').load('tabla.php');
                            alertify.success("Agregado con exito");
                        } else {
                            alertify.error("Fallo al agregar");
                        }
                    }
                });
            });
            $('#btnActualizar').click(function() {
                datos = $('#frmnuevoU').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/actualizar.php",
                    success:function(r) {
                        if (r == 1) {
                            $('#tablaDatatable').load('tabla.php');
                            alertify.success("Actualizado con exito");
                        } else {
                            alertify.error("Fallo al actualizar");
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tablaDatatable').load('tabla.php');
        });
    </script>
    <script>
        function agregaFrmActualizar(idJuego) {
            $.ajax({
                type:"POST",
                data:"idJuego="+idJuego,
                url:"procesos/obtenDatos.php",
                success:function(r) {
                    datos = jQuery.parseJSON(r);
                    $('#idJuego').val(datos['id_juego']);
                    $('#nomU').val(datos['nombre']);
                    $('#anioU').val(datos['anio']);
                    $('#empU').val(datos['empresa']);
                }
            });
        }

        function eliminarDatos(idJuego) {
            alertify.confirm('Eliminar un juego', '¿Seguro de eliminar este juego?', function(){ 
                    $.ajax({
                    type:"POST",
                    data:"idJuego="+idJuego,
                    url:"procesos/eliminar.php",
                    success:function(r) {
                        if (r==1) {
                            $('#tablaDatatable').load('tabla.php');
                            alertify.success("Eliminado con exito");
                        } else {
                            alertify.error("No se pudo eliminar el juego");
                        }
                    }
                });
                }, function() { 
                    alertify.error('Cancel')
                });
        }
    </script>
</body>
</html>