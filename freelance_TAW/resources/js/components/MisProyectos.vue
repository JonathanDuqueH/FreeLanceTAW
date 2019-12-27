<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Mis Proyectos</h3>
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
            <h2>Gestionar de Mis proyectos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <!--agregar los tipos de busqueda-->
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><center>Titulo</center></th>
                  <th><center>Compañia</center></th>
                  <th><center>Fecha de Inicio</center></th>
                  <th><center>Fecha de Vencimiento</center></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <a href="#!/projects/6892e4ec-33e9-42ec-a172-21d8c18f60bb/dashboard" ui-sref="project_details.dashboard({projectUid : project._uid })" ng-bind="::project.title">Sample Project1</a>
                  </td>  
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