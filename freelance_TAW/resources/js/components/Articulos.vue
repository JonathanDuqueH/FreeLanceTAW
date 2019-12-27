<template>
<div>
<div>
    <div class="page-title">
        <div class="title_left">
        <h3>Manegador Articulos</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                
                <ul class="nav navbar-right panel_toolbox">
                    <!--Boton para abrir el modal-->
                    <li @click="abrirModal('cliente','registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-5">
                               <div class="dataTables_length" id="lwArticleList_length"><label>Show <select name="lwArticleList_length" aria-controls="lwArticleList" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div>
                            </div>
                            <div class="col-sm-5">
                                <div class="dataTables_length" id="datatable_length">
                                    <label>
                                    Buscar:
                                    <input type="text" placeholder="Buscar..." class="form-control input-sm">
                                    <button type="submit" class="form-control input-sm" aria-controls="datatable">Buscar</button>
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
                                        <th><center>Titulo</center></th>
        
                                        <th><center>Privados</center></th>
                                        <th><center>Status</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="clientes in arrayClientes" :key="clientes.id">
                                        <td>
                                           <ul class="nav navbar-center panel_toolbox">
                                                <template >
                                                    <a class="btn btn-sm btn-light lw-btn" @click="abrirModal('cliente', 'actualizar',clientes)" ng-show="canAccess('manage.article.read.update.data')"
                                                       title="Edit" ui-sref="articles_edit({'articleId' : 'ed08da4b-0e25-4005-9dae-d70cd33461c0'})" href="#!/ed08da4b-0e25-4005-9dae-d70cd33461c0/edit">
	                                                    <i class="fa fa-pencil-square-o"></i>Editar</a>
                                                  
                                                   <!-- <li @click="abrirModal('cliente', 'actualizar',clientes)"><a ><i class="fa fa-pencil-square-o"></i></a></li>-->
                                                    <!--<a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>-->
                                                </template>
                                               <!-- <template >-->
                                                   <!-- <li><a ><i class="fa fa-remove"></i></a></li>-->
                                                      <a class="btn btn-danger btn-sm delete-sw lw-btn" ng-show="canAccess('manage.article.write.delete')" href="" title="Delete" 
                                                           ng-click="articleListCtrl.delete('ed08da4b-0e25-4005-9dae-d70cd33461c0', 'Need for weed')">
	                                                     <i class="fa fa-trash-o"></i>Borrar</a>
                                                    <!--<a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>-->
                                                <!--</template>-->
                                            </ul>
                                        </td>
                                        <td v-text="clientes.nombre_compañia"></td>
                                       
                                        <td v-text="clientes.direccion"></td>
                                        <td>
                                            <div v-if="clientes.condicion">
                                                <span class="label label-success">Publish</span>
                                            </div>
                                            <div v-else>
                                                <span class="label label-danger">UnPublish</span>
                                            </div>
                                        </td> 
                                        <!--<td></td>-->
                                        <!--<td>
                                        <div v-if="rol.condicion">
                                        <span class="label label-success">Activo</span>
                                        </div>
                                        <div v-else>
                                        <span class="label label-danger">Inactivo</span>
                                        </div>
                                        </td>-->
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
                                        <li class="paginate_button previous" id="datatable_previous" >
                                            <!--Si le damos a anterior se le resta 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable"> Anterior</a>
                                        </li>
                                        <!--Iteramos para obtener el numero de paginas-->
                                        <li class="paginate_button">
                                            <a href="#" aria-controls="datatable"></a>
                                        </li>
                                        <li class="paginate_button next" id="datatable_next" >
                                            <!--Si le damos a siguiente se le suma 1 en la pagina que nos encontremos-->
                                            <a href="#" aria-controls="datatable"> Siguiente</a>
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
    <!-- MODAL - REGISTRAR/ACTUALIZAR -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" :class="{'mostrar':modal}"  role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button  type="button" @click="cerrarModal()" class="close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="post">
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Nombre(s)" type="text" v-model="titulo">
                            </div>
                            </div>
                          
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus <span class="required">*</span>
                            </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              <label>Publico</label>
                              <input  type="radio"  v-model="publico" name="publico">
                               <label>Privado</label>
                              <input  type="radio"  v-model="privado" name="publico">
                              </div>
                            </div>
                          
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Privado <span class="required">*</span>
                            </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              <label>Publicado</label>
                              <input  type="radio"  v-model="publicado" name="publicado">
                               <label>No Publicado</label>
                              <input  type="radio"  v-model="no_publicado" name="publicado">
                              </div>
                            </div>
                          
                            
                          
                       
                           
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Descripcion" v-model="direccion" rows="4" cols="50">
                                </textarea>
                                  </div>
                            </div>
                          
                          
                            <!--Zona donde despliega el error en registro-->
                            <div  v-show="errorCliente" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCliente" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div >

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="cerrarModal()" class="btn btn-primary">Cancelar</button>
                        <button  type="button" @click="registrarClientes()" v-if="tipoAccion==1" class="btn btn-success">Guardar</button>
                        <button type="button" @click="actualizarClientes()" v-if="tipoAccion==2" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>


<script>
    export default {
        data(){//Declaración de variables que se ocuparan
            return{
                id: 0,
                nombre_compañia: '',
                telefono: '',
                correo: '',
                direccion: '',
                status:'',
                arrayClientes: [],
                modal:0,
                tituloModal: '',
                tipoAccion:0,
                errorCliente :0,
                errorMostrarMsjCliente :[],
            }
        },
        methods :{

        //Funcion con la que traemos los datos de clientes y los guardamos en un arreglo
            listarClientes(){
                let me = this;
                axios.get('/Clientes').then(function(response){//Se obtienen los datos del controlador "cliente(index)"
                    me.arrayClientes=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },

        //Funcion para registrar a los nuevos clientes
            registrarClientes(){
                if(this.ValidarCliente()){
                    return;
                }
                let me = this;
                axios.post('/Clientes/store',{
                'nombre_compañia':this.nombre_compañia,
                'telefono':this.telefono,
                'correo':this.correo,
                'direccion':this.direccion,
                }).then(function (response){//En caso de que si se ejecute correctamente
                    me.cerrarModal();//cierra la ventana de registro 
                    me.listarClientes();//refresca la lista de clientes
                }).catch(function (error){
                    console.log(error);
                });
            },

        //Funcion para actualizar la info de los clientes
            actualizarClientes(){
                if(this.ValidarCliente()){
                    return;
                }
                let me = this;
                axios.put('/Clientes/actualizar',{
                'id':this.id,
                'nombre_compañia':this.nombre_compañia,
                'telefono':this.telefono,
                'correo':this.correo,
                'direccion':this.direccion,
                }).then(function (response){//En caso de que si se ejecute correctamente
                    me.cerrarModal();//cierra la ventana de registro 
                    me.listarClientes();//refresca la lista de clientes
                }).catch(function (error){
                    console.log(error);
                });
            },

            //Funcion para validar que existan datos
            ValidarCliente(){
                this.errorCliente=0;
                this.errorMostrarMsjCliente=[];
                if(!this.nombre_compañia)this.errorMostrarMsjCliente.push("El nombre del cliente esta vacio");
                if(!this.telefono)this.errorMostrarMsjCliente.push("El telefono del cliente esta vacio");
                if(!this.correo)this.errorMostrarMsjCliente.push("El correo del cliente esta vacio");
                if(!this.direccion)this.errorMostrarMsjCliente.push("La dirección del cliente esta vacio");
                if(this.errorMostrarMsjCliente.length) this.errorCliente=1;
                return this.errorCliente;
            },
            
            //Funcion para abrir el modal de registro o actualización de datos
            abrirModal(modelo,accion,data=[]){
                switch(modelo){
                    case "cliente":
                    {
                        console.log(accion);
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Cliente';
                                this.nombre_compañia='';
                                this.telefono='';
                                this.correo='';
                                this.direccion='';
                                this.status=1,
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                              this.modal=1;
                              this.tituloModal='Actualiar Categoria';
                              this.tipoAccion=2;
                              this.id=data['id'];
                              console.log(this.id);
                              this.nombre_compañia = data['nombre_compañia'];
                              this.telefono=data['telefono'];
                              this.correo=data['correo'];
                              this.direccion=data['direccion'];
                              break;
                            }
                        }
                    }
                }
            },
            //Metodo de cerrar el modal par que cierre la ventana
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre_compañia='';
                this.nombre_compañia = '';
                this.telefono = '';
                this.correo = '';
                this.direccion ='';
            }
        },
        mounted(){
            this.listarClientes();
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
    .div-error{
        display:flex;
        justify-content:center;
    }

    .text-error{
        color:red !important;
        font-weight: bold;
    }

</style>-->


