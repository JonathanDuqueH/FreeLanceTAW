<template>
<div class="container">
      <div class="title_left">
        <h3>Reportes de clientes</h3>
      </div>
    <div class="page-title">
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reportes de clientes </h2>
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
                               <th><center>Proyecto</center></th>
                        <th><center>Título</center></th>
                    
                        <th><center>Mensaje</center></th>
                       <th><center>Estado</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="proyectos in arrayProyecto" :key="proyectos.id">
                                <td>
                       
                          
                              <template v-if="proyectos.condicion">
                         
                                 <a @click="desactivarUsuario(proyectos.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                               </template>
                          

                   
                        </td>  
                           <td v-text="proyectos.tp"></td>
                        <td v-text="proyectos.titulo"></td>
                       
                        <td v-text="proyectos.mensaje"></td>
                      <template v-if="proyectos.condicion">
                         <td>Pendiente</td>   
                      </template>
                       <template v-else>
                         <td>Atendido</td>   
                      </template>
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
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulodepartamento">Título de reporte: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="titulo" placeholder="Escriba el titulo del reporte" required="required" type="text">
                </div>
              </div>
                  
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">mensaje <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea v-model="mensaje" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="mensaje"  rows="4" cols="50"></textarea>
                </div>
              </div>
     
              <div v-show="errorProyecto" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjProyecto" :key="error" v-text="error">

                    </div>
                </div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
            <button @click="cerrarModal()" type="button" class="btn btn-primary" >Cancelar</button>
            <button v-if="tipoAccion==1" @click="registrarProyecto()" type="button" class="btn btn-success">Guardar</button>
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
      mensaje: '',
      descripcion:'',
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
      var url='/reportesm?page='+page+'&buscar='+buscar+'&criterio='+criterio;
      axios.get(url).then(function (response){
          var respuesta = response.data;   
          console.log(respuesta);
          me.arrayProyecto = respuesta.reporte.data;
          me.pagination = respuesta.pagination;
      })
      .catch(function (error){
      console.log(error);
      });
    },
 desactivarUsuario(id){
            swal.fire({
            title: 'Desea marcar como atendido este reporte?',
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

                axios.put('/reportes/atender',{
                    'id': id
                }).then(function (response) {
                    me.listarUser(1,'','name');
                    swal.fire(
                    'Hecho!',
                    'Reporte atendido.',
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
    //CERRAR MODAL
    cerrarModal(){
      this.modal=0;
      this.tituloModal='';
      this.titulo='';
      this.mensaje='';
      this.inicio='';
      this.fin='';
      this.iduser=0;
      this.condicion = 0;
      this.errorUser=0;
    },
    //ABRIR MODAL REGISTRAR O ACTUALIZAR
    abrirModal(modelo, accion, data=[]){

      this.modal = 1;
      this.tituloModal = 'Actualizar Proyecto';
      this.proyecto_id=data['id'];
      this.titulo = '';
      this.mensaje = '';
      this.tipoAccion = 1;
    },
  
 
    validarProyecto(){
      this.errorProyecto=0;
      this.errorMostrarMsjProyecto =[];

      if (!this.titulo) this.errorMostrarMsjProyecto.push("El titulo no puede estar vacío.");
    //  if (!this.mensaje) this.errorMostrarMsjProyecto.push("Por favor agregue el mensaje del reporte.");
      if (this.errorMostrarMsjProyecto.length) this.errorProyecto = 1;

      return this.errorProyecto;
    },
    //REGISTRAR PROYECTO
    registrarProyecto(){
      if (this.validarProyecto()){
          return;
      }
      
      let me = this;

      axios.post('/reportes/registrar',{
          'titulo': this.titulo,
          'mensaje': this.mensaje,
          'idproyecto' : this.proyecto_id,
          
      }).then(function (response) {
          me.cerrarModal();
          me.listarProyecto(1,'','titulo');
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
    
    cambiarPagina(page,buscar,criterio){
        let me = this;
        //Actualiza la página actual
        me.pagination.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarProyecto(page,buscar,criterio);
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