<template>

<div class="container">
  <div class="page-title">
    <div class="title_left">
      <h3></h3>
    </div>
<!--comienza buscador -->

  </div>
<!--termina buscador -->
  <div class="clearfix"></div>
  <!--TABLAS TAB-->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>
             Relación de carga laboral
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Proyectos</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Tareas</a>
              </li>     
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                <!--tabla de productos -->
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Proyectos - Colaboradores</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-12">
                              <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                  <tr>
                                    <th><center>Proyecto</center></th>
                                    <th><center>Colaboradores</center></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="colaborador in arrayColaborador" :key="colaborador.id">
                                    <td v-text="colaborador.titulo"></td>
                                    <td>
                                      <div v-for="user in arrayUsuarios" :key="user.idproyecto">
                                        <div v-if="colaborador.id == user.idproyecto">
                                          <span class="tag">
                                              <span v-text="user.name"></span>
                                              <a @click="eliminarColaborador(user.id)" v-if="user.rol!=1 && user.rol!=2" href="#" title="Remover usuario">x</a>
                                              <a v-if="user.rol==1" href="#" title="Remover usuario"><b>A</b></a>
                                              <a v-if="user.rol==2" href="#" title="Remover usuario"><b>PM</b></a>
                                          </span>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              </diV>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <!--PAGINATE HERE-->
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        <!--Si la pagina es mayor que la primera mostrar-->
                                        <li class="paginate_button previous" id="datatable_previous" v-if="pagination.current_page > 1">
                                            <!--Si le damos a anterior se le resta 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"> Anterior</a>
                                        </li>
                                        <!--Iteramos para obtener el numero de paginas-->
                                        <li class="paginate_button" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' : '']">
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="paginate_button next" id="datatable_next" v-if="pagination.current_page < pagination.last_page">
                                            <!--Si le damos a siguiente se le suma 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"> Siguiente</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/PAGINATE-->
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/tabla de productos  -->
              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                <!--tabla de servicios  -->
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Asignaciones de tareas</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="dataTables_length" id="datatable_length">
                                  <label>
                                  Buscar:
                                  <input type="text" v-model="buscarCol" @keyup.enter="listarProducto(1,buscarCol,criterioCol)" placeholder="Buscar por titulo" class="form-control input-sm">
                                  <button type="submit" @click="listarProducto(1,buscarCol,criterioCol)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                  <tr>
                                    <th><center>Acciones</center></th>                
                                    <th><center>Título</center></th>
                                    <th><center>Descripcion</center></th>
                                    <th><center>Fecha de inicio</center></th>
                                    <th><center>Fecha de vencimiento</center></th>
                                    <th><center>Usuario asignado</center></th>
                                    <th><center>Estatus</center></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="tarea in arrayTareas" :key="tarea.id">
                                    <td>
                                      <center>
                                        <ul class="nav navbar-center panel_toolbox">
                                          <template v-if="tarea.condicion && tarea.pagado == '0'">
                                            <a @click="abrirModalServ('tareas', 'pagar', tarea)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-dollar"></i></a>
                                          </template>
                                          <template v-else-if="tarea.condicion && tarea.pagado=='1'">
                                            <a @click="cancelarTarea(tarea.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                          </template>
                                          <template v-else>
                                            <a @click="abrirModalServ('tareas', 'actualizar', tarea)" class="dropdown-toggle" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                            <a @click="cancelarTarea(tarea.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                            <a @click="completarTarea(tarea.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                          </template>
                                        </ul>
                                      </center>
                                    </td>
                                    <td v-text="tarea.titulo"></td>
                                    <td v-text="tarea.descripcion"></td>
                                    <td v-text="tarea.inicio"></td>
                                    <td v-text="tarea.fin"></td>
                                    <td v-text="tarea.name"></td>
                                    <td>
                                      <center>
                                        <div v-if="tarea.condicion">
                                            <span class="label label-success">Completada</span>
                                            <div v-if="tarea.pagado">
                                              <span class="label label-success">Pagada</span>
                                            </div> 
                                            <div v-else>
                                              <span class="label label-warning">No pagada</span>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <span class="label label-warning">En curso</span>
                                        </div>
                                      </center>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              </diV>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-sm-5"></div>
                            <!--PAGINATE HERE-->
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        <!--Si la pagina es mayor que la primera mostrar-->
                                        <li class="paginate_button previous" id="datatable_previous" v-if="paginationColab.current_page > 1">
                                            <!--Si le damos a anterior se le resta 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPaginaServ(paginationColab.current_page - 1,buscarCol,criterioCol)"> Anterior</a>
                                        </li>
                                        <!--Iteramos para obtener el numero de paginas-->
                                        <li class="paginate_button" v-for="page in pagesNumberServ" :key="page" :class="[page==isActived ? 'active' : '']">
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPaginaServ(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="paginate_button next" id="datatable_next" v-if="paginationColab.current_page < pagination.last_page">
                                            <!--Si le damos a siguiente se le suma 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPaginaServ(paginationColab.current_page + 1,buscarCol,criterioCol)"> Siguiente</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/PAGINATE-->
                        </div>

                    </div>
                  </div>
                </div>
                
              </div>
              <!--/tabla de servicios  -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--###################-->


<!-- modals -->
<!-- MODAL - REGISTRAR/ACTUALIZAR -TAREAS- -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" :class="{'mostrar' : modalServ}" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button @click="cerrarModalServ()" type="button" class="close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" v-text="tituloModalServ"></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left" method="post">
              <template v-if="tipoAccionServ==1">
                <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo de tarea: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Titulo de tarea" type="text">
                </div>
                </div>
                
                <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="descripcion" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Descripcion del servicio" type="text">
                </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario:  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select v-model="idcolaborador" class="form-control col-md-7 col-xs-12">
                          <option value="0">Usuario</option>
                          <option v-for="usuario in arrayUsuarios" :key="usuario.id" :value="usuario.id" v-text="usuario.name"></option>
                      </select>
                  </div>
                </div>

                <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_inicio">Fecha de inicio: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input v-model="inicio" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Ingrese fecha de inicio " required="required" type="date">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">Fecha de vencimiento: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input v-model="fin" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Ingrese fecha de vencimiento " required="required" type="date">
                </div>
              </div>
              </template>

              <template v-if="tipoAccionServ==2">
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">Monto a pagar: <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="cantidad" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="name" placeholder="Ingrese la cantidad a pagar " required="required" type="text">
                  </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Metodo de pago:  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select v-model="idmetodo" class="form-control col-md-7 col-xs-12">
                          <option value="0">Seleccione metodo de pago</option>
                          <option v-for="metodo in arrayMetodos" :key="metodo.id" :value="metodo.id" v-text="metodo.nombre"></option>
                      </select>
                  </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">Tu saldo: <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <center><b><h4>{{"$"+yourMoney[0]['dinero']}}</h4></b></center>
                  </div>
                </div>

              </template>
                
                <div v-show="errorServ" class="form-group row div-error">
                    <div class="text-center text-error">
                        <div v-for="error in errorMostrarMsjServ" :key="error" v-text="error">

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button @click="cerrarModalServ()" type="button" class="btn btn-primary">Cancelar</button>
            <button v-if="tipoAccionServ==1" @click="actualizarTarea()" type="button" class="btn btn-success">Actualizar</button>
            <button v-if="tipoAccionServ==2" @click="pagarTarea()" type="button" class="btn btn-success">Pagar</button>
        </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    data (){
      return{
        busqueda: '',
        cantidad: 0.0,
        tarea_id: 0,
        colaborador_id: 0,
        titulo: '',
        descripcion: '',
        inicio: '',
        fin: '',
        idhito: '',
        condicion: '',
        yourMoney: '',

        idmetodo: 0,
        idproyecto: 0,
        idcolaborador: 0,
        idproducto: 0,
        arrayColaborador: [],
        arrayTareas: [],
        arrayUsuarios: [],
        arrayMetodos: [],
        
        modalServ: 0,
        tituloModalServ: '',
        tipoAccionServ: 0,
        errorServ: [],
        errorMostrarMsjServ: [],


        paginationColab:{
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offsetCol : 4,
        criterioCol: 'titulo',
        buscarCol: '',
        /* --------- */
        producto_id: 0,
        nombre: '',
        costo: 0,
        direccion_proveedor: '',
        arrayProducto: [],
        modal: 0,
        tituloModal: '',
        tipoAccion: 0,
        errorProduct: [],
        errorMostrarMsjProduct: [],
        pagination:{
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 4,
        criterio: 'titulo',
        buscar: ''
      }
    },
    computed:{
        isActived: function(){
                return this.pagination.current_page;
                return this.paginationColab.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            },
            //Calcula los elementos de la paginación
            pagesNumberServ: function() {
                if(!this.paginationColab.to) {
                    return [];
                }
                
                var from = this.paginationColab.current_page - this.offsetCol; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offsetCol * 2); 
                if(to >= this.paginationColab.last_page){
                    to = this.paginationColab.last_page;
                }  

                var pagesArrayServ = [];
                while(from <= to) {
                    pagesArrayServ.push(from);
                    from++;
                }
                return pagesArrayServ;             

            }
    },
    methods:{
      /*---------------------------*/
      //LISTADO DE PRODUCTOS
      listarProducto(page, buscar, criterio){
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/tareaAll?page='+page+'&buscar='+buscar+'&criterio='+criterio;
        axios.get(url).then(function (response){
          var respuesta = response.data;  
          me.arrayTareas = respuesta.tareas.data;
          me.paginationColab = respuesta.pagination;
        })
        .catch(function (error){
          console.log(error);
        });
      },
      //REGISTRAR PRODUCTOS
      registrarProducto(){
          if (this.validarProducto()){
              return;
          }
          
          let me = this;

          axios.post('/producto/registrar',{
              'nombre': this.nombre,
              'costo': this.costo,
              'direccion_proveedor' : this.direccion_proveedor
          }).then(function (response) {
              me.cerrarModal();
              me.listarProducto(1,'','nombre');
          }).catch(function (error) {
              console.log(error);
          });
      },
      //ACTUALIZAR PRODUCTOS
      actualizarProducto(){
          if (this.validarProducto()){
              return;
          }
          
          let me = this;

          axios.put('/producto/actualizar',{
              'nombre': this.nombre,
              'costo': this.costo,
              'direccion_proveedor' : this.direccion_proveedor,
              'id': this.producto_id
          }).then(function (response) {
              me.cerrarModal();
              me.listarProducto(1,'','nombre');
          }).catch(function (error) {
              console.log(error);
          });
      },
      //ABRIR LINK DEL PROVEEDOR
      open_link(link){
        window.open( 
              link, "_blank");
      },
      //BUSQUEDA
      cambiarPagina(page,buscar,criterio){
        let me = this;
        //Actualiza la página actual
        me.pagination.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarProducto(page,buscar,criterio);
      },
      //CERRAR MODAL
      cerrarModal(){
          this.modal=0;
          this.modalServ = 0;
          this.tituloModal='';
          this.nombre='';
          this.costo=0;
          this.direccion_proveedor='';
          this.errorUser=0;
      },
      //VALIDAR DATOS
      validarProducto(){
        this.errorProduct=0;
        this.errorMostrarMsjProduct =[];

        if (!this.nombre) this.errorMostrarMsjProduct.push("El nombre de producto no puede estar vacío.");
        if (!this.costo) this.errorMostrarMsjProduct.push("El costo de producto no puede estar vacío.");
        if (!this.direccion_proveedor) this.errorMostrarMsjProduct.push("La dirección no puede estar vacío.");

        if (this.errorMostrarMsjProduct.length) this.errorProduct = 1;

        return this.errorProduct;
      },
      eliminarColaborador(id){
        swal.fire({
          title: 'Esta seguro de elminiar este colaborador?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar!',
          cancelButtonText: 'Cancelar',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
          reverseButtons: true
          }).then((result) => {
          if (result.value) {
              let me = this;

            axios.put('/colaborador/eliminar',{
                'id': id
            }).then(function (response) {
                me.listarProducto(1,'','nombre');
                me.listarUsuarios();
                swal.fire(
                'Hecho!',
                'Usuario eliminado.',
                'success'
                )
            }).catch(function (error) {
                console.log(error);
            });
            
            
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
        })
      },
      activarProducto(id){
        swal.fire({
        title: 'Habilitar producto?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            let me = this;

            axios.put('/producto/activar',{
                'id': id
            }).then(function (response) {
                me.listarProducto(1,'','nombre');
                swal.fire(
                'Activado!',
                'Producto habilitado.',
                'success'
                )
            }).catch(function (error) {
                console.log(error);
            });
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
        }
        }) 
      },
      /*SERVICIOS ---------------------------*/
      //LISTADO DE PROYECTOS
      listarServicio(page, buscarCol, criterioCol){
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/colaborador?page='+page+'&buscar='+buscarCol+'&criterio='+criterioCol;
        axios.get(url).then(function (response){
          var respuestaS = response.data;  
          me.arrayColaborador = respuestaS.colaboradores.data;
          me.pagination = respuestaS.pagination;
        })
        .catch(function (error){
          console.log(error);
        });
      },
      //LISTADO DE USUARIOS
      listarUsuarios(){
        //var busqueda = id;
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/colaboradorUsers';
        axios.get(url).then(function (response){
          var respuestaS = response.data;  
          me.arrayUsuarios = respuestaS;
        })
        .catch(function (error){
          console.log(error);
        });
      },
      //BUSQUEDA
      cambiarPaginaServ(page,buscarCol,criterioCol){
        let me = this;
        //Actualiza la página actual
        me.paginationColab.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarServicio(page,buscarCol,criterioCol);
      },
      //ABRIR MODAL REGISTRAR O ACTUALIZAR
      abrirModalServ(modeloServ, accionServ, data=[]){
          //this.selectProducto();//LLAMAR PARA MOSTRAR LISTADO DE METODOS
          this.selectMetodo();

          switch(modeloServ){
              case "tareas":
              {
                  switch(accionServ){
                      case 'actualizar':
                      {
                        //console.log(data[idproducto]);
                          this.modalServ = 1;
                          this.tituloModalServ = 'Actualizar Tarea';
                          this.idcolaborador=data['iduser'];
                          this.titulo = data['titulo'];
                          this.tarea_id = data['id'];
                          this.tiempo = data['tiempo'];
                          this.descripcion = data['descripcion'];
                          this.idhito = data['idhito'];
                          this.condicion = data['condicion'];
                          this.tipoAccionServ = 1;
                          break;
                      }
                      case 'pagar':
                      {
                        this.modalServ = 1;
                        this.tituloModalServ = 'Pagar tarea';
                        this.idcolaborador = data['iduser'];
                        this.tarea_id = data['id'];
                        this.cantidad = 0.0;
                        this.titulo = data['titulo'];
                        this.descripcion = data['descripcion'];
                        this.tipoAccionServ = 2;
                        break;
                      }
                  }
              }
          }
      },
      //REGISTRAR SERVICIO
      registrarServicio(){
          if (this.validarServicio()){
              return;
          }
          
          let me = this;

          axios.post('/servicio/registrar',{
              'titulo': this.titulo,
              'idproducto': this.idproducto,
              'tiempo' : this.tiempo,
              'descripcion' : this.descripcion,
              'costoserv' : this.costoserv
          }).then(function (response) {
              me.cerrarModalServ();
              me.listarServicio(1,'','titulo');
          }).catch(function (error) {
              console.log(error);
          });
      },
      //ACTUALIZAR SERVICIO
      actualizarServicio(){
          if (this.validarServicio()){
              return;
          }
          
          let me = this;

          axios.put('/servicio/actualizar',{
              'titulo': this.titulo,
              'idproducto': this.idproducto,
              'tiempo' : this.tiempo,
              'descripcion' : this.descripcion,
              'costoserv' : this.costoserv,
              'servicio_id' : this.servicio_id
          }).then(function (response) {
              me.cerrarModalServ();
              me.listarServicio(1,'','titulo');
          }).catch(function (error) {
              console.log(error);
          });
      },
      //VALIDAR DATOS
      validarServicio(){
        this.errorServ=0;
        this.errorMostrarMsjServ =[];

        if (!this.titulo && this.tipoAccionServ!=2) this.errorMostrarMsjServ.push("El titulo no puede estar vacío.");
        if (!this.descripcion && this.tipoAccionServ!=2) this.errorMostrarMsjServ.push("La descripcion no puede estar vacía.");
        if (this.idcolaborador == 0 && this.tipoAccionServ!=2) this.errorMostrarMsjServ.push("Debe escoger un colaborador.");
        if (!this.inicio && this.tipoAccionServ!=2) this.errorMostrarMsjServ.push("La fecha de inicio no puede estar vacía.");
        if (!this.fin && this.tipoAccionServ!=2) this.errorMostrarMsjServ.push("La fecha de vencimiento no puede estar vacía.");
        if (this.idmetodo == 0 && this.tipoAccionServ ==2) this.errorMostrarMsjServ.push("Debe seleccioner un metodo de pago.");
        if (!this.cantidad && this.tipoAccionServ == 2) this.errorMostrarMsjServ.push("Debe especificar una cantidad.");
        if (this.yourMoney[0]['dinero']-this.cantidad < 0) this.errorMostrarMsjServ.push("Saldo insuficiente.");

        if (this.errorMostrarMsjServ.length) this.errorServ = 1;

        return this.errorServ;
      },
      //CERRAR MODAL
      cerrarModalServ(){
          this.modalServ=0;
          this.tituloModalServ='';
          this.titulo='';
          this.idproducto = 0;
          this.tiempo = '';
          this.descripcion = '';
          this.cantidad = 0.0;
          this.costoserv=0;
          this.errorServ=0;
          this.inicio='';
          this.fin='';
          this.idmetodo = 0;
      },
      selectProducto(){
        let me=this;
        var url= '/producto/selectProducto';
        axios.get(url).then(function (response) {
           //console.log(response.data);
            var respuesta= response.data;
            me.arrayProdSelect = respuesta.productos;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      desactivarServicio(idserv){
        console.log(idserv);
        swal.fire({
          title: 'Esta seguro de cancelar este servicio?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar!',
          cancelButtonText: 'Cancelar',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
          reverseButtons: true
          }).then((result) => {
          if (result.value) {
              let me = this;

            axios.put('/servicio/desactivar',{
                'servicio_id': idserv
            }).then(function (response) {
                me.listarServicio(1,'','titulo');
                swal.fire(
                'Hecho!',
                'Servicio cancelado.',
                'success'
                )
            }).catch(function (error) {
                console.log(error);
            });
            
            
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
        })
      },
      activarServicio(idserv){
        swal.fire({
        title: 'Esta seguro de activar este servicio?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            let me = this;

            axios.put('/servicio/activar',{
                'servicio_id': idserv
            }).then(function (response) {
                me.listarServicio(1,'','titulo');
                swal.fire(
                'Activado!',
                'Servicio activado.',
                'success'
                )
            }).catch(function (error) {
                console.log(error);
            });
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
        }
        }) 
      },
      actualizarTarea(){
        if (this.validarServicio()){
              return;
          }
          
          let me = this;

          axios.put('/tarea/actualizar',{
              'titulo': this.titulo,
              'descripcion': this.descripcion,
              'iduser' : this.idcolaborador,
              'inicio': this.inicio,
              'fin': this.fin,
              'idhito': this.idhito,
              'condicion': this.condicion,
              'id': this.tarea_id
          }).then(function (response) {
              me.cerrarModalServ();
              me.listarProducto(1,'','titulo');
          }).catch(function (error) {
              console.log(error);
          });
      },
      cancelarTarea(id){
        swal.fire({
          title: 'Esta seguro de cancelar o eliminar esta tarea?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar!',
          cancelButtonText: 'Cancelar',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
          reverseButtons: true
          }).then((result) => {
          if (result.value) {
              let me = this;

            axios.put('/tarea/cancelar',{
                'id': id
            }).then(function (response) {
                me.listarProducto(1,'','titulo');
                swal.fire(
                'Hecho!',
                'Tarea cancelada.',
                'success'
                )
            }).catch(function (error) {
                console.log(error);
            });
            
            
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
        })
      },
      completarTarea(id){
        swal.fire({
          title: 'Marcar como completa esta tarea?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar!',
          cancelButtonText: 'Cancelar',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
          reverseButtons: true
          }).then((result) => {
          if (result.value) {
              let me = this;

            axios.put('/tarea/completar',{
                'id': id
            }).then(function (response) {
                me.listarProducto(1,'','titulo');
                swal.fire(
                'Hecho!',
                'Tarea completada.',
                'success'
                )
            }).catch(function (error) {
                console.log(error);
            });
            
            
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
        })
      },
      selectMetodo(){
        let me=this;
        var url= '/metodos/selectMetodo';
        axios.get(url).then(function (response) {
           //console.log(response.data);
            var respuesta= response.data;
            me.arrayMetodos = respuesta.metodos;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      pagarTarea(){
        if (this.validarServicio()){
            return;
        }
        
        let me = this;

        axios.put('/tarea/pagar',{
            'id': this.tarea_id,
            'iduser': this.idcolaborador,
            'cantidad': this.cantidad,
            'titulo': this.titulo,
            'descripcion': this.descripcion,
            'idmetodo': this.idmetodo
        }).then(function (response) {
            me.cerrarModal();
            me.listarProducto(1,'','nombre');
            me.getMoney();
            swal.fire(
                'Hecho!',
                'Pago realizado.',
                'success'
                )
        }).catch(function (error) {
            console.log(error);
        });
      },
      getMoney(){
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/carteraAuth';
        axios.get(url).then(function (response){
          var respuesta = response.data;  
          me.yourMoney = respuesta;
        })
        .catch(function (error){
          console.log(error);
        });
      }
    },
    mounted (){
      this.listarProducto(1,this.buscar,this.criterio);
      this.listarServicio(1,this.buscarCol,this.criterioCol);
      this.listarUsuarios();
      this.getMoney();
    }
  }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>