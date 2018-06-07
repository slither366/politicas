<?php
	require 'funcs/conexion.php';
	require 'funcs/funcs.php';

	/*$data = array();
	$data = getGuiasTransPend(1,"40601632");
*/
    //echo getGuiasTransPend(1,"40601632");

    //echo personaExiste('44752002');
    //echo registraPersona('44752003','1','Danilo','Flores','Lujan')

?>

<!DOCTYPE html>
<html>
<head>
  <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<style type="text/css">
  body{
  background-color:#FCF4D9;
}
.main-box-layout{
  margin: 0px;
  margin-top: 30px;
  position: relative;
  box-shadow: -3px 3px 3px 0px #c1c1c1;
}
.main-box-layout:hover .box-icon-section i{
  font-size:70px;
  transform: rotate(360deg);
  transition:1s;
} 
.box-icon-section{
  display: table;
  height:100px;
  color:#fff;
}
.box-icon-section i{
  font-size:30px;
  display: table-cell;
    vertical-align: middle;
    transition:transform 0.4s ease-in-out;
    transition: 1s;
}
.box-text-section{
  background-color:#c3c3c3;
}
.box-text-section p{
  margin: 0px;
  color:#fff;
  padding:10px 0px; 
}
.label .badge{
  position: absolute;
  top:-19px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #f1f1f1;
  color: #fff;
  box-shadow: 0px 0px 3px 0px #fff;
  border: 3px solid #fff;
}
</style>

</head>
<body>
<div class="container main-section">
  <div class="row justify-content-md-center">

    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-primary">
          <i class="fa fa-magic" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Transferencias Pendientes</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-primary">1</span></h3>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-warning">
          <i class="fa fa-star" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Deposito Bancario Pendiente</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-warning">10</span></h3>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-danger">
          <i class="fa fa-eye" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Remesas Fuera de Rango</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-danger">3</span></h3>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-info">
          <i class="fa fa-user-o" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Cierre de dia Pendiente</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-info">23</span></h3>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-success">
          <i class="fa fa-picture-o" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Acumulacion de Deficit Excesivo</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-success">15</span></h3>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-secondary">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Cuadratura de Anulacion Pendiente</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-secondary">3</span></h3>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-primary">
          <i class="fa fa-magic" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">ASL's Pendientes</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-primary">8</span></h3>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-warning">
          <i class="fa fa-star" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Cierre de día Pendiente</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-warning">12</span></h3>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-12 text-center">
      <div class="row main-box-layout img-thumbnail">
        <div class="col-lg-12 col-sm-12 col-12 box-icon-section bg-danger">
          <i class="fa fa-eye" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 box-text-section">
          <p class="font-weight-bold">Acumulacion de Deficit Excesivo</p>
        </div>
        <div class="label">
          <h3><span class="badge badge-pill bg-danger">4</span></h3>
        </div>
      </div>
    </div>
  </div>


  </div>
</div>
</body>
</html>