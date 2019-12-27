<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Facturas</h3>
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
            <h2>Gestionar Facturas</h2>
            <ul class="nav navbar-right panel_toolbox">
              <!--agregar los tipos de busqueda-->
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><center>Id de facturas</center></th>
                  <th><center>Fecha de la factura</center></th>
                  <th><center>Fecha de venciemiento</center></th>
                  <th><center>Estado de factura</center></th>
                  <th><center>Cantidad total</center></th>
                  <th><center>Cantidad pagada</center></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>  
                  <td></td>
                  <td></td>
                  <td>
                  <a data-toggle="modal" data-placement="top" title="Agregar pago" data-target=".bs-example-modal-lg" ><i class="fa fa-plus-square"></i></a>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  <!-- modals -->
  <!-- Large modal -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Agregar pago</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" novalidate="">
            <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Metodo de pago <span class="required">*</span>
                        </label> 
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <select type="option" id="metodopago" name="meotodopago" required="required" placeholder="Eliga el metodo de pago" class="form-control col-md-7 col-xs-12">
                            <option>PayPal</option>
                            <option>Stripe</option>
                            <option>Razorpay</option>
                            <option>Lyzico</option>
                            <option>Otro</option>
                          </select>
                      </div>
            </div>
            <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tituloservicio">Id de transferecia: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="idtransferencia" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Escriba el id de transferencia" required="required" type="text">
                        </div>
                      </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Comentarios: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="comentario" class="form-control col-md-7 col-xs-12"  placeholder="Agrege un comentario" type="text"></textarea>
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
  <!--info de pagos.-->
  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Informacion de pago:</h4>
                        </div>
                        <div class="modal-body">
                          <h4></h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                        </div>

                      </div>
                    </div>
                  </div>
  <!-- termina info de pagos.-->
</div>
</template>