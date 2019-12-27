<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Solicitudes de servicio</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Buscar</button>
            </span>
          </div>
        </div>
      </div>
    </div>
  <br>
  <br>
  <br>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Gestionar solicitudes de servicio</h2>
            <ul class="nav navbar-right panel_toolbox">
              <!--agregar los tipos de busqueda-->
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><center>Id de solicitud</center></th>
                  <th><center>Servicio</center></th>
                  <th><center>Propietario</center></th>
                  <th><center>Usuario asignado</center></th>
                  <th><center>Cargos</center></th>
                  <th><center>Estado de pago</center></th>
                  <th><center>Fecha de creación</center></th>
                  <th><center>Estado</center></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>  
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
</template>