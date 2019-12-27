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
             Productos / Servicios
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Productos</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Servicios</a>
              </li>     
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                <!--tabla de productos -->
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Productos registrados</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li @click="abrirModal('producto', 'registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="dataTables_length" id="datatable_length">
                                  <label>
                                  Buscar:
                                  <input type="text" v-model="buscar" @keyup.enter="listarProducto(1,buscar,criterio)" placeholder="Buscar por producto" class="form-control input-sm">
                                  <button type="submit" @click="listarProducto(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                  <tr>
                                    <th><center>Acciones</center></th>                
                                    <th><center>Producto</center></th>
                                    <th><center>Precio</center></th>
                                    <th><center>Proveedor</center></th>
                                    <th><center>Estado</center></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td>
                                      <center>
                                        <ul class="nav navbar-center panel_toolbox">
                                          <a @click="abrirModal('producto', 'actualizar', producto)" class="dropdown-toggle" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                          <template v-if="producto.condicion">
                                              <a @click="desactivarProducto(producto.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                          </template>
                                          <template v-else>
                                              <a @click="activarProducto(producto.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                          </template>
                                        </ul>
                                      </center>
                                    </td>
                                    <td v-text="producto.nombre"></td>
                                    <td v-text="'$'+producto.costo"></td>
                                    <td>
                                      {{ producto.direccion_proveedor }}
                                      <a @click="open_link(producto.direccion_proveedor)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-external-link"></i></a>
                                    </td>
                                    <td>
                                      <center>
                                        <div v-if="producto.condicion">
                                            <span class="label label-success">Disponible</span>
                                        </div>
                                        <div v-else>
                                            <span class="label label-danger">No disponible</span>
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
                        <h2>Servicios registrados</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li @click="abrirModalServ('servicio', 'registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="dataTables_length" id="datatable_length">
                                  <label>
                                  Buscar:
                                  <input type="text" v-model="buscarServ" @keyup.enter="listarServicio(1,buscarServ,criterioServ)" placeholder="Buscar por producto" class="form-control input-sm">
                                  <button type="submit" @click="listarServicio(1,buscarServ,criterioServ)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                  <tr>
                                    <th><center>Acciones</center></th>                
                                    <th><center>Título</center></th>
                                    <th><center>Producto</center></th>
                                    <th><center>Cargos</center></th>
                                    <th><center>Estado</center></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="servicio in arrayServicio" :key="servicio.id">
                                    <td>
                                      <center>
                                        <ul class="nav navbar-center panel_toolbox">
                                          <a @click="abrirModalServ('servicio', 'actualizar', servicio)" class="dropdown-toggle" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                          <template v-if="servicio.estado">
                                              <a @click="desactivarServicio(servicio.idserv)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                          </template>
                                          <template v-else>
                                            <a @click="activarServicio(servicio.idserv)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                          </template>
                                          <template>
                                            <a @click="abrirModalVista(servicio)" href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" aria-expanded="false"><i class="fa fa-eye"></i></a>
                                          </template>
                                        </ul>
                                      </center>
                                    </td>
                                    <td v-text="servicio.titulo"></td>
                                    <td v-text="servicio.nombre"></td>
                                    <td v-text="'$'+servicio.costoserv"></td>
                                    <td>
                                      <center>
                                        <div v-if="servicio.estado">
                                            <span class="label label-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="label label-danger">Inactivo</span>
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
                                        <li class="paginate_button previous" id="datatable_previous" v-if="paginationServicios.current_page > 1">
                                            <!--Si le damos a anterior se le resta 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPaginaServ(paginationServicios.current_page - 1,buscarServ,criterioServ)"> Anterior</a>
                                        </li>
                                        <!--Iteramos para obtener el numero de paginas-->
                                        <li class="paginate_button" v-for="page in pagesNumberServ" :key="page" :class="[page==isActived ? 'active' : '']">
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPaginaServ(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="paginate_button next" id="datatable_next" v-if="paginationServicios.current_page < pagination.last_page">
                                            <!--Si le damos a siguiente se le suma 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable" @click.prevent="cambiarPaginaServ(paginationServicios.current_page + 1,buscarServ,criterioServ)"> Siguiente</a>
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
<!-- MODAL - REGISTRAR/ACTUALIZAR -SERVICES- -->
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
                <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo de servicio: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Nombre de producto" type="text">
                </div>
                </div>
                
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Producto <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select v-model="idproducto" class="form-control col-md-7 col-xs-12">
                          <option value="0">Nombre de producto</option>
                          <option v-for="producto in arrayProdSelect" :key="producto.id" :value="producto.id" v-text="producto.nombre"></option>
                      </select>
                  </div>
                </div>

                <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiempo estimado de ejecucion: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="tiempo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Tiempo" type="text">
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cargos: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="costoserv" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Costo del producto" type="text">
                </div>
                </div>

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
            <button v-if="tipoAccionServ==1" @click="registrarServicio()" type="button" class="btn btn-success">Guardar</button>
            <button v-if="tipoAccionServ==2" @click="actualizarServicio()" type="button" class="btn btn-success">Actualizar</button>
        </div>

        </div>
      </div>
    </div>
<!-- MODAL - REGISTRAR/ACTUALIZAR -PRODUCTOS- -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button @click="cerrarModal()" type="button" class="close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="post">
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del producto: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="nombre" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Nombre de producto" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="costo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Costo del producto" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion del proveedor: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="direccion_proveedor" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Enlace" type="text">
                            </div>
                            </div>
                            
                            <div v-show="errorProduct" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjProduct" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button @click="cerrarModal()" type="button" class="btn btn-primary">Cancelar</button>
                        <button v-if="tipoAccion==1" @click="registrarProducto()" type="button" class="btn btn-success">Guardar</button>
                        <button v-if="tipoAccion==2" @click="actualizarProducto()" type="button" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--descripciòn de servicios -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2" v-text="'Servicio: '+titulo" >Servicio:</h4>
                        </div>
                        <div class="modal-body">
                          <h4></h4>
                          <p v-text="descripcion"></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>

<!--descripciòn de servicios  -->
    </div>
</template>

<script>
  export default{
    data (){
      return{
        /* SERVICIOS */
        servicio_id: 0,
        titulo: '',
        tiempo: '',
        idproducto: 0,
        descripcion: '',
        costoserv: 0.0,
        arrayServicio: [],
        arrayProdSelect: [],
        modalServ: 0,
        tituloModalServ: '',
        tipoAccionServ: 0,
        errorServ: [],
        errorMostrarMsjServ: [],
        paginationServicios:{
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offsetServ : 4,
        criterioServ: 'titulo',
        buscarServ: '',
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
        criterio: 'name',
        buscar: ''
      }
    },
    computed:{
        isActived: function(){
                return this.pagination.current_page;
                return this.paginationServicios.current_page;
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
                if(!this.paginationServicios.to) {
                    return [];
                }
                
                var from = this.paginationServicios.current_page - this.offsetServ; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offsetServ * 2); 
                if(to >= this.paginationServicios.last_page){
                    to = this.paginationServicios.last_page;
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
        var url='/producto?page='+page+'&buscar='+buscar+'&criterio='+criterio;
        axios.get(url).then(function (response){
          var respuesta = response.data;  
          me.arrayProducto = respuesta.productos.data;
          me.pagination = respuesta.pagination;
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
      desactivarProducto(id){
        swal.fire({
          title: 'Esta seguro de desabilitar este producto?',
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

            axios.put('/producto/desactivar',{
                'id': id
            }).then(function (response) {
                me.listarProducto(1,'','nombre');
                swal.fire(
                'Hecho!',
                'Producto desabilitado.',
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
      //ABRIR MODAL REGISTRAR O ACTUALIZAR
      abrirModal(modelo, accion, data=[]){
          //this.selectRol();//LLAMAR PARA MOSTRAR LISTADO DE ROLES
          console.log(data);
          switch(modelo){
              case "producto":
              {
                  switch(accion){
                      case 'registrar':
                      {
                          this.modal = 1;
                          this.tituloModal = 'Registrar Producto';
                          this.nombre = '';
                          this.costo = 0.0;
                          this.direccion_proveedor = '';
                          this.tipoAccion = 1;
                          break;
                      }
                      case 'actualizar':
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar Producto';
                          this.producto_id=data['id'];
                          this.nombre = data['nombre'];
                          this.costo = data['costo'];
                          this.direccion_proveedor = data['direccion_proveedor'];
                          this.tipoAccion = 2;
                          break;
                      }
                  }
              }
          }
      },

      /*SERVICIOS ---------------------------*/
      //LISTADO DE SERVICIOS
      listarServicio(page, buscarServ, criterioServ){
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/servicio?page='+page+'&buscar='+buscarServ+'&criterio='+criterioServ;
        axios.get(url).then(function (response){
          var respuestaS = response.data;  
          me.arrayServicio = respuestaS.servicios.data;
          me.paginationServicios = respuestaS.pagination;
        })
        .catch(function (error){
          console.log(error);
        });
      },
      //BUSQUEDA
      cambiarPaginaServ(page,buscarServ,criterioServ){
        let me = this;
        //Actualiza la página actual
        me.paginationServicios.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarServicio(page,buscarServ,criterioServ);
      },
      //ABRIR MODAL REGISTRAR O ACTUALIZAR
      abrirModalServ(modeloServ, accionServ, data=[]){
          this.selectProducto();//LLAMAR PARA MOSTRAR LISTADO DE ROLES
          //console.log(data);
          switch(modeloServ){
              case "servicio":
              {
                  switch(accionServ){
                      case 'registrar':
                      {
                          this.modalServ = 1;
                          this.tituloModalServ = 'Registrar Servicio';
                          this.titulo = '';
                          this.idproducto = 0;
                          this.tiempo = '';
                          this.descripcion = '';
                          this.costoserv = 0.0;
                          this.tipoAccionServ = 1;
                          break;
                      }
                      case 'actualizar':
                      {
                        //console.log(data[idproducto]);
                          this.modalServ = 1;
                          this.tituloModalServ = 'Actualizar Servicio';
                          this.servicio_id=data['idserv'];
                          this.titulo = data['titulo'];
                          this.idproducto = data['idproducto'];
                          this.tiempo = data['tiempo'];
                          this.descripcion = data['descripcion'];
                          this.costoserv = data['costoserv'];
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

        if (!this.titulo) this.errorMostrarMsjServ.push("El titulo no puede estar vacío.");
        if (!this.idproducto) this.errorMostrarMsjServ.push("El nombre de producto no puede estar vacío.");
        if (!this.tiempo) this.errorMostrarMsjServ.push("El tiempo de operación no puede estar vacío.");
        if (!this.descripcion) this.errorMostrarMsjServ.push("La descripcion no puede estar vacío.");
        if (!this.costoserv) this.errorMostrarMsjServ.push("El costo del servicio no puede estar vacío.");

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
          this.costoserv=0;
          this.errorServ=0;
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
      //ABRIR MODAL VISTA
      abrirModalVista(data=[]){
      //console.log(data[idproducto]);
        this.descripcion = data['descripcion'];
        this.titulo = data['titulo'];
      },
    },
    mounted (){
      this.listarProducto(1,this.buscar,this.criterio);
      this.listarServicio(1,this.buscarServ,this.criterioServ);
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