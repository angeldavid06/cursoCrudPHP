<?php 
    class crud {
        public function agregar($datos) {
            $obj = new conectar();
            $conexion = $obj->conexion();

            $sql = "INSERT INTO t_juegos (nombre,anio,empresa) 
                    VALUES ('$datos[0]',
                            '$datos[1]',
                            '$datos[2]')";
            return mysqli_query($conexion,$sql);
        }

        public function obtenDatos($idJuego) {
            $obj = new conectar();
            $conexion = $obj->conexion();
            $sql = "SELECT * FROM t_juegos WHERE id_juego = '$idJuego'";
            $result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array (
                'id_juego' => $ver[0],
                'nombre' => $ver[1],
                'anio' => $ver[2],
                'empresa' => $ver[3]
            );
            return $datos;
        }

        public function Actualizar ($datos) {
            $obj = new conectar();
            $conexion = $obj->conexion();
            $sql = "UPDATE t_juegos 
                    SET nombre = '$datos[1]', anio = '$datos[2]', empresa = '$datos[3]' 
                    WHERE id_juego = '$datos[0]'";
            return mysqli_query($conexion,$sql);
        }

        public function eliminar ($idJuego) {
            $obj = new conectar();
            $conexion = $obj->conexion();
            $sql = "DELETE FROM t_juegos WHERE id_juego = '$idJuego'";
            return mysqli_query($conexion,$sql);
        }
    }
?>