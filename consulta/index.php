<?php
session_start();
if (!$_SESSION['acceso']) {
    header("Location:../login/");
}
include '../conectar.php';
include '../modal/ModalConsulta.php';
include '../modal/DescripcionConsulta.php';
include '../modal/ConstanciaFConsulta.php';
include '../modal/TratamientoConsulta.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title> | Clinica Veterinaria | Listado de Consultas</title>
  <?php include '../includes/head.php'?>
</head>
<body class="nav-md">
  <?php include '../includes/nav.php'?>
  <?php include '../includes/cerrarSesion.php'?>
  <div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <section class="content-header">
            <h1>Listado de Consultas</h1>
            <ol class="breadcrumb">
              <li><a href="../home/"><i class="fa fa-home"></i> Home</a></li>
              <li>Expediente</li>
              <li>Consulta</li>
              <li class="active">Listado de Consultas</li>
            </ol>
          </section>
        </div>
      </div>
    </div>
<form id= "formulario"  role= "form" method="GET">
    <div class="">
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" id="q" name="q" class="form-control" placeholder="Buscar..."
                  value="<?php if (isset($_GET["q"])) {
    echo $_GET["q"];
}
?>">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <br>
            <div class="title_left">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                <div class="input-group">
                  <a href="nuevo.php">
                  <button class="btn btn-primary button1">
                    <i class="glyphicon glyphicon-plus-sign"></i> Agregar Consulta
                  </button>
                  </a>
                </div>
              </div>
            </div>

        </div>
        <br>



        <?php
if (isset($_GET["action"])) {
    if ($_GET["action"] == "del") {
        mysqli_query($link, "delete from consulta where idconsulta ='$_GET[id]'");
        echo "<br><div class=\"alert alert alert-info\" role=\"alert\">
                   <strong>Exito</strong>
                   Registro eliminado.
                  </div>";
    }
}

if (isset($_GET["q"])) {

    $q = $_GET["q"];
    $query = @mysqli_query($link, "SELECT consulta.idconsulta,consulta.descripcion,consulta.c_fisiologica,consulta.tratamiento,consulta.fecha_ingreso,consulta.precio, cliente.nombre AS cliente FROM consulta INNER JOIN cliente ON consulta.idcliente = cliente.idcliente WHERE consulta.idconsulta LIKE '%$q%' OR cliente.nombre LIKE '%$q%' order by idconsulta");
    if (!@mysqli_num_rows($query)) {
        echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
             <strong>Error</strong>
             No se produjeron resultados.
            </div>";
    } else {
        $nrows = mysqli_num_rows($query);

        if (isset($_GET["info"])) {
            if ($_GET["info"] == "add") {
                echo "<br><div class=\"alert alert alert-info\" role=\"alert\">
             <strong>Exito</strong>
            Registro agregado.
           </div>";
            }

            if ($_GET["info"] == "modificar") {
                echo "<br><div class=\"alert alert alert-info\" role=\"alert\">
              <strong>Exito</strong>
            Registro Modificado.
           </div>";
            }

        } else {

            echo "<br><a href=\"#\">
                              Registros encontrados:
                          <span class=\"badge\">$nrows</span>
                          </a>";
        }

        echo "<center>
       <div class=\"table-responsive\">
   <table class=\"table table-bordered table-hover\" >
        <tr>
        <td>ID Consulta</td>
        <td>Cliente</td>
        <td>Descripción</td>
        <td>Constancia Fisiologíca</td>
        <td>Tratamiento</td>
        <td>Fecha de la Consulta</td>
        <td>Precio de la consulta</td>
        <td>Acciones</td>

      </tr>";

        while ($data = mysqli_fetch_array($query)) {

            echo "<tr class=\"warning\">
                <td>$data[0]</td>
                <td>$data[cliente]</td>
                <td align='center'>
                  <button type='button' class='btn btn-link' data-toggle='modal' data-target='#DetalleConsulta'><img src='../img/detalles.png' border=0 title='Detalles' style='width: 40px; font-size:20px' title='Detalles'></button>
                  </td>

                <td align='center'>
                        <button type='button' class='btn btn-link' data-toggle='modal' data-target='#ConstanciaFConsulta'><img src='../img/detalles.png' border=0 title='Detalles' style='width: 40px; font-size:20px' title='Detalles'></button>
                        </td>

                <td align='center'>
                        <button type='button' class='btn btn-link' data-toggle='modal' data-target='#TratamientoConsulta'><img src='../img/detalles.png' border=0 title='Detalles' style='width: 40px; font-size:20px' title='Detalles'></button>
                        </td>

                <td>$data[fecha_ingreso]</td>
                <td>$data[precio]</td>

                <td>
                  </a>

                  <a href='modificar.php?id=$data[0]'><img src='../img/editar.png' border=0 title='Modificar' style='width: 40px; font-size:20px' title='Modificar'></a>


                  <a href=# onclick=\"javascript:if(window.confirm('¿Desea eliminar el equipo $data[0]?q=$q'))
                  {location.replace('$_SERVER[PHP_SELF]?action=del&id=$data[0]&q=$q')}\">
                  <img src='../img/eliminar.png' border=0 title='Eliminar' style='width: 40px; font-size:20px' title='Eliminar'></a>
          </td>

        </tr> ";
        }
        echo "</table></center> ";

    }
} else {
  $query = @mysqli_query($link, "SELECT 
  consulta.idconsulta,consulta.descripcion,consulta.c_fisiologica,consulta.tratamiento,consulta.fecha_ingreso,
  consulta.precio, cliente.nombre AS cliente FROM consulta INNER JOIN cliente ON consulta.idcliente = cliente.idcliente");
   echo "<br><div class=\"alert alert alert-info\" role=\"alert\">
   
  Lista de consultas.
 </div>";
    echo "<center>
       <div class=\"table-responsive\">
   <table class=\"table table-bordered table-hover\" >
        <tr>
        <td>ID Consulta</td>
        <td>Cliente</td>
        <td>Descripción</td>
        <td>Constancia Fisiologíca</td>
        <td>Tratamiento</td>
        <td>Fecha de la Consulta</td>
        <td>Precio de la consulta</td>
        <td>Acciones</td>

      </tr>";

    while ($data = mysqli_fetch_array($query)) {

        echo "<tr class=\"warning\">
                <td>$data[0]</td>
                <td>$data[cliente]</td>
                <td align='center'>
                  <button type='button' class='btn btn-link' data-toggle='modal' data-target='#DetalleConsulta'><img src='../img/detalles.png' border=0 title='Detalles' style='width: 40px; font-size:20px' title='Detalles'></button>
                  </td>

                <td align='center'>
                        <button type='button' class='btn btn-link' data-toggle='modal' data-target='#ConstanciaFConsulta'><img src='../img/detalles.png' border=0 title='Detalles' style='width: 40px; font-size:20px' title='Detalles'></button>
                        </td>

                <td align='center'>
                        <button type='button' class='btn btn-link' data-toggle='modal' data-target='#TratamientoConsulta'><img src='../img/detalles.png' border=0 title='Detalles' style='width: 40px; font-size:20px' title='Detalles'></button>
                        </td>

                <td>$data[fecha_ingreso]</td>
                <td>$data[precio]</td>

                <td>
                  </a>

                  <a href='modificar.php?id=$data[0]'><img src='../img/editar.png' border=0 title='Modificar' style='width: 40px; font-size:20px' title='Modificar'></a>


                  <a href=# onclick=\"javascript:if(window.confirm('¿Desea eliminar el equipo $data[0]?q=$q'))
                  {location.replace('$_SERVER[PHP_SELF]?action=del&id=$data[0]&q=$q')}\">
                  <img src='../img/eliminar.png' border=0 title='Eliminar' style='width: 40px; font-size:20px' title='Eliminar'></a>
          </td>

        </tr> ";
    }
    echo "</table></center> ";
}
?>

</div>
</div>
</div>
</div>

</div>

<?php include '../includes/footer.php'?>

</div>
</div>
<?php include '../includes/script.php'?>

</body>
</html>
