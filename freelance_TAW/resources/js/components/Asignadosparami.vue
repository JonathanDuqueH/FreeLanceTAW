<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!--

<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Calendario</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Eventos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="fa fa-plus-square"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
           
        </div>
      </div>
    </div>
  </div>
  <!-- modals -->
  <!-- Large modal -->
<!--
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Agregar nuevo departamento</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" novalidate="">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tituloservicio">Título de departamento: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="titulodepartamento" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Escriba titulo del nuevo departamento" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tituloservicio">Agregar usuario: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Seleccione un usuario para este departamento" required="required" type="text">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button id="send" type="submit" class="btn btn-success">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--info de dartamentos.-->

<!--
  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Departmento:</h4>
                        </div>
                        <div class="modal-body">
                          <h4></h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
<!--
                        </div>

                      </div>
                    </div>
                  </div>
  <!-- termina info de departamentos.-->
<!--
</div>
</template>
-->


<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
