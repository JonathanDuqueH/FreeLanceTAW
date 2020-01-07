<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Proyectos</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Administrar proyectos </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li @click="abrirModal('proyecto', 'registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_length" id="datatable_length">
                        <label>
                        Mostrar por
                        <select v-model="criterio" name="datatable_length" aria-controls="datatable" class="form-control input-sm">
                            <option value="titulo">Titulo</option>
                        </select>
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_length" id="datatable_length">
                        <label>
                        Buscar:
                        <input type="text" v-model="buscar" @keyup.enter="listarProyecto(1,buscar,criterio)" placeholder="Buscar..." class="form-control input-sm">
                        <button type="submit" @click="listarProyecto(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                        </label>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                    <thead>
                      <tr>
                        <th><center>Acciones</center></th>
                        <th><center>Título</center></th>
                        <th><center>Cliente</center></th>
                        <th><center>Responsable</center></th>
                        <th><center>Fecha de inicio</center></th>
                        <th><center>Fecha de vencimiento</center></th>
                        <th><center>Estado</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="proyectos in arrayProyecto" :key="proyectos.id">
                        <td>
                          <center>
                            <ul class="nav navbar-center panel_toolbox">
                              <template v-if="proyectos.condicion">
                                <a @click="abrirModal('proyecto', 'usuario', proyectos)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i></a>
                                <a @click="abrirModal('proyecto', 'hito', proyectos)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check-square-o"></i></a>
                                <a @click="abrirModal('proyecto', 'actualizar', proyectos)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-pencil-square-o"></i></a>
                                <a @click="cancelarProyecto(proyectos)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                <a @click="abrirModalVista(proyectos)" href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" aria-expanded="false"><i class="fa fa-eye"></i></a>
                            </template>
                              <template v-else>
                                <a @click="activarProyecto(proyectos)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                              </template>
                              </ul>
                          </center>
                        </td>  
                        <td v-text="proyectos.titulo"></td>
                        <td v-text="proyectos.name"></td>
                        <td v-text="proyectos.name_res"></td>
                        <td v-text="proyectos.inicio"></td>
                        <td v-text="proyectos.fin"></td>
                        <td>
                          <div v-if="proyectos.condicion == 1">
                            <span class="label label-warning">Activo</span>
                          </div>
                          <div v-else-if="proyectos.condicion == 2">
                            <span class="label label-success">Terminado</span>
                          </div>
                          <div v-else>
                            <span class="label label-danger">Cancelado</span>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
  </div>
  <!-- modals -->
  <!-- REGISTRAR / ACTUALIZAR -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button @click="cerrarModal()" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel" v-text="tituloModal"></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" method="post">
          
          <template v-if="tipoAccion!=3">

              <div v-if="tipoAccion==4">

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Usuario: <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select v-model="iduser" class="form-control col-md-7 col-xs-12">
                          <option value="0">Seleccione un colaborador</option>
                          <option v-for="programador in arrayProgramador" :key="programador.id" :value="programador.id" v-text="programador.name"></option>
                      </select>
                  </div>
                </div>

              </div>
              <div v-else>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulodepartamento">Título de proyecto: <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="titulo" placeholder="Escriba titulo del nuevo proyecto" required="required" type="text">
                    </div>
                  </div>
                
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Cliente: <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select v-model="iduser" class="form-control col-md-7 col-xs-12">
                            <option value="0">Seleccione un cliente</option>
                            <option v-for="cliente in arrayCliente" :key="cliente.id" :value="cliente.id" v-text="cliente.name"></option>
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

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea v-model="descripcion" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Descripcion"  rows="4" cols="50">
                        </textarea>
                    </div>
                </div>

                <div v-if="tipoAccion == 2">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Estatus: <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select v-model="condicion" class="form-control col-md-7 col-xs-12">
                          <option value="0">
                            <div v-if="condicion==1">
                              Activo
                            </div>
                            <div v-else-if="condicion==2">
                              Terminado
                            </div>
                          </option>
                          <option value="1">Activo</option>
                          <option value="2">Terminado</option>     
                      </select>
                  </div>
                </div>
              </div>

              <div v-show="errorProyecto" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjProyecto" :key="error" v-text="error">

                    </div>
                </div>
              </div>
            </template>

            <template v-else>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulodepartamento">Título de hito: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="titulo" placeholder="Escriba titulo del nuevo hito" required="required" type="text">
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
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea v-model="descripcion" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Descripcion"  rows="4" cols="50">
                    </textarea>
                </div>
              </div>
              <div v-show="errorProyecto" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjProyecto" :key="error" v-text="error">

                    </div>
                </div>
              </div>
            </template>
          
          </form>
        </div>
        <div class="modal-footer">
            <button @click="cerrarModal()" type="button" class="btn btn-primary" >Cancelar</button>
            <button v-if="tipoAccion==1" @click="registrarProyecto();" type="button" class="btn btn-success">Guardar</button>
            <button v-if="tipoAccion==2" @click="actualizarProyecto()" type="button" class="btn btn-success">Actualizar</button>
            <button v-if="tipoAccion==3" @click="anadirHito()" type="button" class="btn btn-success">Añadir</button>
            <button v-if="tipoAccion==4" @click="anadirUsuario()" type="button" class="btn btn-success">Añadir</button>
        </div>
      </div>
    </div>
  </div>
  <!--info de proyecto-->
  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2" v-text="'Proyecto: '+titulo"></h4>
        </div>
        <div class="modal-body">
          <h4></h4>
          <p v-text="descripcion"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        </div>

      </div>
    </div>
  </div>
  <!-- termina info de proyecto.-->
</div>
</template>
<script>
export default{
  data (){
    return{
      proyecto_id: 0,
      titulo: '',
      descripcion: '',
      iduser: 0,
      inicio: '',
      fin: '',
      condicion: 0,
      name: '',
      arrayProyecto: [],
      arrayCliente: [],
      arrayProgramador: [],
      modal: 0,
      tituloModal: '',
      tipoAccion: 0,
      errorProyecto: [],
      errorMostrarMsjProyecto: [],
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
    listarProyecto(page, buscar, criterio){
      let me=this;
      //RUTA PARA OBTENER DATOS
      var url='/proyectos?page='+page+'&buscar='+buscar+'&criterio='+criterio;
      axios.get(url).then(function (response){
          var respuesta = response.data;   
          console.log(respuesta);
          me.arrayProyecto = respuesta.proyecto.data;
          me.pagination = respuesta.pagination;
          
      })
      .catch(function (error){
      console.log(error);
      });
    },
    //ABRIR MODAL VISTA
    abrirModalVista(data=[]){
      this.descripcion = data['descripcion'];
      this.titulo = data['titulo'];
    },
    //CERRAR MODAL
    cerrarModal(){
      this.modal=0;
      this.tituloModal='';
      this.titulo='';
      this.descripcion='';
      this.inicio='';
      this.fin='';
      this.iduser=0;
      this.condicion = 0;
      this.errorUser=0;
    },
    //ABRIR MODAL REGISTRAR O ACTUALIZAR
    abrirModal(modelo, accion, data=[]){

        if(accion != 'hito'){
          this.selectCliente();//LLAMAR PARA MOSTRAR LISTADO DE ROLES
          //console.log(data);
        }

        if(accion == 'usuario'){
          this.selectProgramador();
        }

        switch(modelo){
            case "proyecto":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Proyecto';
                        this.titulo = '';
                        this.descripcion = '';
                        this.inicio = '';
                        this.fin = '';
                        this.iduser = 0;
                        this.tipoAccion = 1;
                        break;
                    }
                    case 'actualizar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Actualizar Proyecto';
                        this.proyecto_id=data['id'];
                        this.titulo = data['titulo'];
                        this.descripcion = data['descripcion'];
                        this.inicio = data['inicio'];
                        this.fin = data['fin'];
                        this.iduser = data['iduser'];
                        this.condicion = data['condicion'];
                        this.tipoAccion = 2;
                        break;
                    }
                    case 'hito':
                    {
                      this.iduser = 0;
                      this.modal = 1;
                      this.tituloModal = 'Añadir Hito';
                      this.titulo = '';
                      this.descripcion = '';
                      this.inicio = '';
                      this.fin = '';
                      this.proyecto_id = data['id'];
                      this.tipoAccion = 3;
                      break;
                    }
                    case 'usuario':
                    {
                      this.iduser = 0;
                      this.modal = 1;
                      this.tituloModal = 'Añadir colaborador';
                      this.proyecto_id = data['id'];
                      this.tipoAccion = 4;
                      break;
                    }
                }
            }
        }
    },
    selectCliente(){
      let me=this;
      var url= '/user/selectUser';
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayCliente = respuesta.users;
      })
      .catch(function (error) {
          console.log(error);
      });
    },
    selectProgramador(){
      let me=this;
      var url= '/user/selectProgramador';
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayProgramador = respuesta.users;
      })
      .catch(function (error) {
          console.log(error);
      });
    },
    validarProyecto(){
      this.errorProyecto=0;
      this.errorMostrarMsjProyecto =[];

      if (!this.titulo && this.tipoAccion !=4) this.errorMostrarMsjProyecto.push("El titulo no puede estar vacío.");
      if (!this.descripcion &&  this.tipoAccion !=4) this.errorMostrarMsjProyecto.push("Por favor agregue una descripción.");
      if (this.iduser==0 && this.tipoAccion !=3) this.errorMostrarMsjProyecto.push("Seleccione un cliente.");
      if (!this.inicio &&  this.tipoAccion !=4) this.errorMostrarMsjProyecto.push("Por favor indique la fecha de inicio.");
      if (!this.fin && this.tipoAccion !=4) this.errorMostrarMsjProyecto.push("Por favor indique la fecha de finalizacion.");

      if (this.errorMostrarMsjProyecto.length) this.errorProyecto = 1;

      return this.errorProyecto;
    },
    //REGISTRAR PROYECTO
    registrarProyecto(){
      if (this.validarProyecto()){
          return;
      }
      
      let me = this;

      axios.post('/proyectos/registrar',{
          'titulo': this.titulo,
          'descripcion': this.descripcion,
          'iduser' : this.iduser,
          'inicio' : this.inicio,
          'fin' : this.fin
      }).then(function (response) {
          me.cerrarModal();
          me.listarProyecto(1,'','titulo');
          me.registrarColaborador();
      }).catch(function (error) {
          console.log(error);
      });
    },
    //ACTUALIZAR PROYECTO
    actualizarProyecto(){
        if (this.validarProyecto()){
            return;
        }
        
        let me = this;

        axios.put('/proyectos/actualizar',{
            'titulo': this.titulo,
            'descripcion': this.descripcion,
            'iduser' : this.iduser,
            'inicio' : this.inicio,
            'fin' : this.fin,
            'condicion': this.condicion,
            'id': this.proyecto_id
        }).then(function (response) {
            me.cerrarModal();
            me.listarProyecto(1,'','titulo');
        }).catch(function (error) {
            console.log(error);
        });
    },
    cancelarProyecto(data=[]){
      swal.fire({
      title: 'Esta seguro de cancelar este proyecto?',
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

          axios.put('/proyectos/cancelar',{
              'id': data['id'],
              'iduser': data['iduser'] 
          }).then(function (response) {
              me.listarProyecto(1,'','titulo');
              swal.fire(
              'Hecho!',
              'Proyecto cancelado.',
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
    activarProyecto(data=[]){
      swal.fire({
      title: 'Esta seguro de reactivar este proyecto?',
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

          axios.put('/proyectos/activar',{
              'id': data['id'],
              'iduser': data['iduser'] 
          }).then(function (response) {
              me.listarProyecto(1,'','titulo');
              swal.fire(
              'Activado!',
              'Proyecto activado.',
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
    anadirHito(){

      if (this.validarProyecto()){
          return;
      }
      
      let me = this;

      axios.post('/hito/registrar',{
          'titulo': this.titulo,
          'descripcion': this.descripcion,
          'idproyecto' : this.proyecto_id,
          'inicio' : this.inicio,
          'fin' : this.fin
      }).then(function (response) {
          me.cerrarModal();
          me.listarProyecto(1,'','titulo');
      }).catch(function (error) {
          console.log(error);
      });
    },
    cambiarPagina(page,buscar,criterio){
        let me = this;
        //Actualiza la página actual
        me.pagination.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarProyecto(page,buscar,criterio);
    },
    //REGISTRAR PROYECTO
    anadirUsuario(){
      if (this.validarProyecto()){
          return;
      }
      
      let me = this;

      axios.post('/colaborador/registrar',{
          'idproyecto': this.proyecto_id,
          'iduser': this.iduser
      }).then(function (response) {
          me.cerrarModal();
          me.listarProyecto(1,'','titulo');
      }).catch(function (error) {
          console.log(error);
      });
    }
  },
  mounted (){
    this.listarProyecto(1,this.buscar,this.criterio);
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