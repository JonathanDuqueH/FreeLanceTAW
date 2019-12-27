<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Calendario</h3>
        <!--calendario-->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    <h2>Eventos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <li><a data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="fa fa-plus-square"></i></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">

                    <div id="calendar" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div><button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="">Hoy</button></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">Mes</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">Semana</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default">Dia</button><button type="button" class="fc-listMonth-button fc-button fc-state-default fc-corner-right">Lista</button></div></div><div class="fc-center"><h2>Noviembre 2019</h2></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Domingo</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Lunes</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Martes</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Miercoles</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Jueves</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Viernes</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sàbado</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 508px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content" style="height: 84px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2019-10-27"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2019-10-28"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2019-10-29"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2019-10-30"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2019-10-31"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-11-01"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-11-02"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2019-10-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2019-10-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2019-10-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2019-10-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2019-10-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-11-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-11-02"><span class="fc-day-number">2</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">All Day Event</span></div></a></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 84px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-11-03"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-11-04"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-11-05"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-11-06"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-11-07"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-11-08"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-11-09"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-11-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-11-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-11-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-11-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-11-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-11-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-11-09"><span class="fc-day-number">9</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 84px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-11-10"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-11-11"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-11-12"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-11-13"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-11-14"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-11-15"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-11-16"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-11-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-11-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-11-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-11-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-11-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-11-15"><span class="fc-day-number">15</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-11-16"><span class="fc-day-number">16</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 84px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-11-17"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-11-18"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-11-19"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-11-20"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-11-21"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-11-22"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-11-23"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-11-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-11-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-11-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-11-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-11-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-11-22"><span class="fc-day-number">22</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-11-23"><span class="fc-day-number">23</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 84px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-11-24"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-11-25"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-11-26"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-11-27"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-11-28"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-11-29"></td><td class="fc-day fc-widget-content fc-sat fc-today fc-state-highlight" data-date="2019-11-30"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-11-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-11-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-11-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-11-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-11-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-11-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-sat fc-today fc-state-highlight" data-date="2019-11-30"><span class="fc-day-number">30</span></td></tr></thead><tbody><tr><td></td><td class="fc-event-container" colspan="3"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Long Event</span></div></a></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" href="http://google.com/"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Click for Google</span></div></a></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 88px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-future" data-date="2019-12-01"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2019-12-02"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2019-12-03"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2019-12-04"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2019-12-05"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2019-12-06"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2019-12-07"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-future" data-date="2019-12-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2019-12-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2019-12-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2019-12-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2019-12-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2019-12-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2019-12-07"><span class="fc-day-number">7</span></td></tr></thead><tbody><tr><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">7p</span> <span class="fc-title">Birthday Party</span></div></a></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>

                  </div>
                </div>
              </div>
            </div>
      <!--termina calendario-->
      
      <!--nuevo evento-->
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" novalidate="">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulodeevento">Título de evento: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="titulodeevento" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="evento" placeholder="Escriba un titulo para el evento" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">Descripciòn: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="" class="form-control col-md-7 col-xs-12" data-validate-length-range="200" name="descripcion" placeholder="Agrege una descripciòn para su evento" required="required" type="text"></textarea>
              </div>
            </div>
             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_inicio">Fecha de inicio: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12"  placeholder="Ingrese fecha de inicio" type="date">
              </div>
            </div>
            <!--hora-->
             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_inicio">Hora inicio(formato 24 hrs): <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input  class="form-control col-md-7 col-xs-12" type="time" min="11:30" max="23:30" step="600" >
              </div>
            </div>
            <!--/hora-->
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">Fecha de vencimiento: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Ingrese fecha de vencimiento " required="required" type="date">
              </div>
            </div>
              <!--hora-->
             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_inicio">Hora fin(formato 24 hrs): <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input  class="form-control col-md-7 col-xs-12" type="time" min="11:30" max="23:30" step="600" >
              </div>
            </div>
            <!--/hora-->
            
        
            
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
    
        <!--termina formulario nuevo evento--> 
        </div>
      </div>
  <!--detalles de evento-->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Detalles de evento:</h4>
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
  <!--/detalles de evento-->
</div>
</template>