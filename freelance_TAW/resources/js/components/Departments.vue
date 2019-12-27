<template>
<div class="container">
    <div class="page-title">

      
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Administrar Departamentos </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li @click="abrirModal('departamento', 'registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
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
                            <input type="text" v-model="buscar" @keyup.enter="listarDepartamento(1,buscar,criterio)" placeholder="Buscar por titulo..." class="form-control input-sm">
                            <button type="submit" @click="listarDepartamento(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
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
                        <th><center>Usuarios</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="departamento in arrayDep" :key="departamento.id">
                        <td>
                        <center>
                          <ul class="nav navbar-center panel_toolbox">
                              <a @click="abrirModal('departamento', 'actualizar', departamento)" class="dropdown-toggle" role="button"><i class="fa fa-life-ring"></i></a>
                              <a @click="eliminarDepartamento(departamento.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                              <a @click="abrirModal('departamento', 'actualizar', departamento)" class="dropdown-toggle" role="button"><i class="fa fa-pencil-square-o"></i></a>
                              <a @click="abrirModalAgregarUsuario(departamento.id)" class="dropdown-toggle" role="button"><i class="fa fa-plus-square"></i>Asignar usuario</a>
                          </ul>
                          </center>
                        </td>  
                        <td v-text="departamento.titulo"></td>
                        <td>
                          <div v-if="departamento.iduser == 6">
                            <span v-text="' '"></span>
                          </div>
                          <div v-else>
                              <span v-text="departamento.nombre_usr"></span>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- PAGINACION -->
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
              <!-- /PAGINACION -->

            </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- modals -->
  <!-- Large modal REGISTRAR / ACTUALIZAR -->
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Ingrese titulo de departamento" type="text">
                </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button @click="cerrarModal()" type="button" class="btn btn-primary">Cancelar</button>
            <button v-if="tipoAccion==1" @click="registrarDepartamento()" type="button" class="btn btn-success">Guardar</button>
            <button v-if="tipoAccion==2" @click="actualizarDepartamento()" type="button" class="btn btn-success">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Large modal ASIGNAR USUARIO -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" :class="{'mostrar' : modalUsr}"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <button @click="cerrarModal()" type="button" class="close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Asignar Usuario</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal form-label-left" method="post">
                
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Usuario <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select v-model="idusr" class="form-control col-md-7 col-xs-12">
                        <option value="0">Seleccione un usuario</option>
                        <option v-for="usuario in arrayUserSelect" :key="usuario.id" :value="usuario.id" v-text="usuario.name"></option>
                    </select>
                </div>
              </div>

            </form>
        </div>
        <div class="modal-footer">
            <button @click="cerrarModal()" type="button" class="btn btn-primary">Cancelar</button>
            <button v-if="tipoAccion==3" @click="asignarUsuario()" type="button" class="btn btn-success">Asignar</button>
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
      departamento_id: 0,
      idusr:0,
      conteo: 0,
      nombre_usr: '',
      titulo: '',
      arrayUserSelect: [],
      arrayDep: [],
      arrayDeparts: [],
      arrayUser: [],
      modal: 0,
      modalUsr: 0,
      tituloModal: '',
      tipoAccion: 0,
      error: [],
      errorMostrarMsj: [],
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
      listarDepartamento(page, buscar, criterio){
          let me=this;
          //RUTA PARA OBTENER DATOS
          var url='/departamento?page='+page+'&buscar='+buscar+'&criterio='+criterio;
          axios.get(url).then(function (response){
              var respuesta = response.data;
              console.log(respuesta);    
              me.arrayDep = respuesta.departamentos.data;
              /* GUARDAR TODOS LOS NOMBRES EN UN ARRAY*/
              var i;
              for(i=0; i<me.arrayDep.length; i++){
                me.arrayUser[i]=me.arrayDep[i].nombre_usr;
                me.arrayDeparts[i]=me.arrayDep[i].titulo;
                console.log("Dep:"+ me.arrayDeparts[i] + " Usr:"+me.arrayUser[i]);
              }
              me.pagination = respuesta.pagination;
          })
          .catch(function (error){
          console.log(error);
          });
      },
      //REGISTRAR DEPARTAMENTO
      registrarDepartamento(){
        if (this.validarDepartamento()){
            return;
        }
        
        let me = this;

        axios.post('/departamento/registrar',{
            'titulo': this.titulo
        }).then(function (response) {
            me.cerrarModal();
            me.listarDepartamento(1,'','titulo');
        }).catch(function (error) {
            console.log(error);
        });
      },
      //VALIDAR DATOS
      validarDepartamento(){
        this.error=0;
        this.errorMostrarMsj =[];

        if (!this.titulo) this.errorMostrarMsj.push("El titulo no puede estar vacío.");
        if (this.errorMostrarMsj.length) this.error = 1;

        return this.error;
      },
      //ABRIR MODAL REGISTRAR O ACTUALIZAR
      abrirModal(modelo, accion, data=[]){
          //this.selectRol();//LLAMAR PARA MOSTRAR LISTADO DE ROLES
          //console.log(data);
          switch(modelo){
              case "departamento":
              {
                switch(accion){
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Departamento';
                        this.titulo = '';
                        this.tipoAccion = 1;
                        break;
                    }
                    case 'actualizar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Actualizar Departamento';
                        this.departamento_id=data['id'];
                        this.titulo = data['titulo'];
                        //console.log(usuario_id);
                        this.tipoAccion = 2;
                        break;
                    }
                }
              }
          }
      },
      //CERRAR MODAL
      cerrarModal(){
          this.modal=0;
          this.modalUsr =0;
          this.tituloModal='';
          this.titulo='';
          this.error=0;
          this.departamento_id = 0;
          this.idusr = 0;
      },
      cambiarPagina(page,buscar,criterio){
          let me = this;
          //Actualiza la página actual
          me.pagination.current_page = page;
          //Envia la petición para visualizar la data de esa página
          me.listarDepartamento(page,buscar,criterio);
      },
      //ACTUALIZAR DEPARTAMENTO
      actualizarDepartamento(){
          if (this.validarDepartamento()){
              return;
          }
          
          let me = this;

          axios.put('/departamento/actualizar',{
              'titulo': this.titulo,
              'id': this.departamento_id
          }).then(function (response) {
              me.cerrarModal();
              me.listarDepartamento(1,'','titulo');
          }).catch(function (error) {
              console.log(error);
          });
      },
      eliminarDepartamento(id){
          swal.fire({
          title: 'Esta seguro de elminar este registro?',
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

              axios.put('/departamento/borrar',{
                  'id': id
              }).then(function (response) {
                  me.listarDepartamento(1,'','titulo');
                  swal.fire(
                  'Hecho!',
                  'Registro eliminado.',
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
      selectUser(){
          let me=this;
          var url= '/user/selectUser';
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayUserSelect = respuesta.users;
          })
          .catch(function (error) {
              console.log(error);
          });
      },
      abrirModalAgregarUsuario(id){
          this.selectUser();//LLAMAR PARA MOSTRAR LISTADO DE ROLES
          this.modalUsr = 1;
          this.tipoAccion = 3;
          this.departamento_id = id;
      },
      asignarUsuario(){
        if (this.validarUsuario()){
            return;
        }
        
        let me = this;

        axios.post('/departamento/registrar',{
            'titulo': this.titulo
        }).then(function (response) {
            me.cerrarModal();
            me.listarDepartamento(1,'','titulo');
        }).catch(function (error) {
            console.log(error);
        });
      },
      //VALIDAR DATOS
      validarUsuario(){
        this.error=0;
        this.errorMostrarMsj =[];

        if (!this.titulo) this.errorMostrarMsj.push("Debe seleccionar un usuario.");
        if (this.errorMostrarMsj.length) this.error = 1;

        return this.error;
      },
    },
    mounted (){
      this.listarDepartamento(1,this.buscar,this.criterio);
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