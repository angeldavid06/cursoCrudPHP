<?php 
    require_once "clases/conexion.php";
    $obj = new conectar();
    $conexion = $obj->conexion();

    $sql = "SELECT * FROM t_juegos";
    $result = mysqli_query($conexion,$sql);
?>

<div>
    <table class="table table-hover table-condensed table-bordered" id="iddatatable">
        <thead style="color: rgba(0,0,0,0.8); background-color: rgba(0,0,0,0.2);">
            <tr>
                <th>Nombre</th>
                <th>Año</th>
                <th>Empresa</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($mostrar=mysqli_fetch_row($result)) {
            ?>
                <tr>
                    <td><?php echo $mostrar[1];?></td>
                    <td><?php echo $mostrar[2];?></td>
                    <td><?php echo $mostrar[3];?></td> 
                    <td style="text-align: center;">
                        <span style="line-height: 0" onclick="agregaFrmActualizar(<?php echo $mostrar[0]?>)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#actualizarDatos">
                            <span class="material-icons">
                                edit
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span style="line-height: 0" onclick="eliminarDatos(<?php echo $mostrar[0]?>)" class="btn btn-danger btn-sm">
                            <span class="material-icons">
                                delete
                            </span>
                        </span>
                    </td>
                </tr>
            <?php 
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Nombre</td>
                <td>Año</td>
                <td>Empresa</td>
                <td>Editar</td>
                    <td>Eliminar</td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#iddatatable').DataTable();
    });
</script>