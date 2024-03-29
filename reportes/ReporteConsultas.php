<?php 
session_start();
if (!$_SESSION['acceso']) {
  header("Location:../login/");
}
 ?>
<?php include '../conectar.php' ?>
<!DOCTYPE html>
<html>
<head>
  <title> | Clinica Veterinaria | Reporte de Consultas</title>

  <?php include '../includes/head.php' ?>

</head>
<body class="nav-md">
  <?php include '../includes/nav.php' ?>
  <?php include '../includes/cerrarSesion.php' ?>
  <div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <section class="content-header">
            <h1>Reporte de Consultas</h1>
            <ol class="breadcrumb">
              <li><a href="../home/"><i class="fa fa-home"></i> Home</a></li>
              <li>/ Reporte</li>
              <li class="active">Reporte de Consultas</li>
            </ol>
          </section>
        </div>
      </div>
    </div>

    <div class="">
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">

            <form  role="form" method="GET" action="view_report_consulta.php" class="form-horizontal form-label-left">
            <span class="section">Datos del Reporte</span>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Reporte General de Consultas</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button type="submit" class="btn btn-primary" style="width: 200px; height: 30px; font-size: 10pt; border-radius: 15px 15px 15px 15px;"><i class="fa fa-print"></i>     Generar reporte</button>
                </div>
              </div>

              

              </form><br><br>

              <form  role="form" method="GET" action="view_report_consultaFecha.php" class="form-horizontal form-label-left">

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Reporte por Fecha</label> 

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class='input-group date' id='myDatepicker2'>
                    <input type='date' class=" form-control datepicker" data-date-format="yyyy-mm-dd" name="fecha1" id="fecha1" placeholder="Introduce la fecha de inicio" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div><br>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <button type="submit" class="btn btn-primary" style="width: 200px; height: 30px; font-size: 10pt; border-radius: 15px 15px 15px 15px;"><i class="fa fa-print"></i>     Generar reporte</button>
                  </div>
                </div>
                
                </div>
              </form><br><br>

              <form  role="form" method="GET" action="view_report_consultaCliente.php" class="form-horizontal form-label-left">

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Reporte por Fecha</label> 
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                      $consulta_cliente=mysqli_query($link,"SELECT * FROM cliente ORDER BY idcliente ASC ");
                      echo "<option value=''>Seleccione un cliente</option>";
                      echo " <select  class=\"form-control js-example-basic-single \" id=\"idcliente\" title=\"Has clic para desplegar\" name=\"idcliente\" >";
                      while($fila=mysqli_fetch_array($consulta_cliente)){
                        echo "<option value='".$fila['idcliente']."'>".$fila['nombre']."</option>";
                      }
                      echo "  </select><br>";
                    ?> 
<br>
                    <div class='input-group date' id='myDatepicker2'>
                      <input type='date' class=" form-control datepicker" data-date-format="yyyy-mm-dd" name="fecha1" id="fecha1" placeholder="Introduce la fecha de inicio" />
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div><br>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button type="submit" class="btn btn-primary" style="width: 200px; height: 30px; font-size: 10pt; border-radius: 15px 15px 15px 15px;"><i class="fa fa-print"></i>     Generar reporte</button>
                    </div>
                  </div>
                </div><br>


              </form><br><br>
              <!-- 

              <form  role="form" method="GET" action="view_report_consultaClientes.php" class="form-horizontal form-label-left">

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Reporte por Cliente</label> 
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                      $consulta_cliente=mysqli_query($link,"SELECT * FROM cliente ORDER BY idcliente ASC ");
                      echo "<option value=''>Seleccione un cliente</option>";
                      echo " <select  class=\"form-control js-example-basic-single \" id=\"idcliente\" title=\"Has clic para desplegar\" name=\"idcliente\" >";
                      while($fila=mysqli_fetch_array($consulta_cliente)){
                        echo "<option value='".$fila['idcliente']."'>".$fila['nombre']."</option>";
                      }
                      echo "  </select><br>";
                    ?> 

                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button type="submit" class="btn btn-primary" style="width: 200px; height: 30px; font-size: 10pt; border-radius: 15px 15px 15px 15px;"><i class="fa fa-print"></i>     Generar reporte</button>
                    </div>
                  </div>
                </div><br>


              </form><br><br>
 -->
              
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include '../includes/footer.php' ?>
  <?php include '../includes/script.php' ?>
  

</body>
</html>

