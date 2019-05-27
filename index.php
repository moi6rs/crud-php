<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        include 'conexion.php';
        $sql = "select * from persona";
        $resultado = mysqli_query($conexion, $sql);
    ?>  
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>EMAIL</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
                <?php while ($filas= mysqli_fetch_assoc($resultado)){
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $filas['id'] ?></td>
                        <td><?php echo $filas['usuario'] ?></td>
                        <td><?php echo $filas['email'] ?></td>
                        <td>
                            <a href="">Editar</a>
                            <a href="">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
                <?php }
                ?>
        </table>
    </div>  
</body>
</html>