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
            Mis Tickets de soporte
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Abierto</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Cerrado</a>
              </li>   
               <li role="presentation" class="">
                <a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Cerrado/Resuelto</a>
              </li> 
              
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                <!--tabla de productos -->
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2></h2>
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
                                    <th><center>Id</center></th>                
                                    <th><center>Create On</center></th>
                                    <th><center>Product</center></th>
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="producto in arrayProducto" :key="producto.id">
                                   
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                     
                                      
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
                       <h2></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li @click="abrirModal('user', 'registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-12">
                              <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                  <tr>
                                    <th><center>Id</center></th>                
                                    <th><center>Create On</center></th>
                                    <th><center>Product</center></th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td>
                                    </td>
                                    <td ></td>
                                    <td></td>
                                    
                                  
                                     
                                   
                                  </tr>
                                </tbody>
                              </table>
                              </diV>
                            </div>
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
  
<!-- MODAL - REGISTRAR/ACTUALIZAR -->
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tema: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="tema" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Tema" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Producto: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select v-model="producto" class="form-control col-md-7 col-xs-12">
                                  <option value="">Producto 1</option>
                              </select>
                                  </div>
                            </div>
                          
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento de Soporte: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select v-model="departamento" class="form-control col-md-7 col-xs-12">
                                  <option value="">Depto 1</option>
                              </select>
                                  </div>
                            </div>
                          
                           
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mensaje <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" v-model="mensaje" rows="4" cols="50">
                                </textarea>
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
    </div>

<!--descripciòn de servicios  
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Servicio:</h4>
                        </div>
                        <div class="modal-body">
                          <h4></h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>

descripciòn de servicios  -->

</template>

<script>
  export default{
    data (){
      return{
        producto_id: 0,
        nombre: '',
        costo: '',
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

            }
    },
    methods:{
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
      //REGISTRAR USUARIO
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
      //ACTUALIZAR USUARIO
      actualizarProducto(){
          /*if (this.validarUsuario()){
              return;
          }*/
          
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
          this.precio=0;
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
          //console.log(data);
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
      }
    },
    mounted (){
      this.listarProducto(1,this.buscar,this.criterio);
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