<template>
<div class="container">
    <div class="page-title">
      <div class="title_left">
        <h3>Pagos</h3>
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
            <h2>Gestionar Pagos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <!--agregar los tipos de busqueda-->
              
            </ul>
<!--              <ul class="nav navbar-right panel_toolbox"> -->
                    <!--Boton para abrir el modal-->
<!--                     <li @click="abrirModal('metodo','registrar')"><a ><i class="fa fa-plus-square"></i></a></li> -->
<!--                 </ul> -->
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><center>Código de retiro</center></th>
                  <th><center>Monto</center></th>
                  <th><center>Monto final</center></th>
                  <th><center>Método de pago</center></th>
                  <th><center>Usuario</center></th>

                </tr>
              </thead>
              <tbody>
                    <tr v-for="pago in pagos" :key="pago.id">
                      
                        <td v-text="pago.codigo_retiro"></td>
                        <td v-text="pago.monto"></td>
                        <td v-text="pago.monto_final"></td>
                        <td v-text="pago.metodo"></td>
                        <td v-text="pago.usuario"></td>
                       
                    </tr>
                </tbody>
            </table>
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
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Código de retiro: <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Código de retiro" type="text" v-model="codigo_retiro">
                              </div>
                          </div>

                          <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Monto: <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Monto" type="text" v-model="monto">
                              </div>
                          </div>

                          <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Monto Final <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Monto Final" type="text" v-model="monto_final">
                              </div>
                          </div>
                          
                        

                          <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Método de pago <span class="required">*</span>
                              </label>
<!--                             <select name="select">
                              <div v-for="metodos in metodo :key="metodo.id>
                                <option value="metodo.id" v-text="metodo.nombre_metodo"></option> 
                              </div>
                            </select> -->
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Método de pago" type="text" v-model="metodo">
                              </div>
                          </div>

                          <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario: <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Usuario" type="text" v-model="usuario">
                              </div>
                          </div>

                          

                          <!--Zona donde despliega el error en registro-->
                          <div  v-show="errorMetodo" class="form-group row div-error">
                              <div class="text-center text-error">
                                  <div v-for="error in errorMostrarMsjMetodo" :key="error" v-text="error">

                                  </div>
                              </div>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" @click="cerrarModal()" class="btn btn-primary">Cancelar</button>
                      <button  type="button" @click="registrarMetodo()" v-if="tipoAccion==1" class="btn btn-success">Guardar</button>
                      <button type="button" @click="actualizarMetodo()" v-if="tipoAccion==2" class="btn btn-success">Actualizar</button>
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
                codigo_retiro: '',
                monto: '',
                monto_final: '',
                condicion: '',
                id_metodo: '',
                id_usuario: '',
                usuario:'',
                metodo:'',
                pagos: [],
                modal:0,
                tituloModal: '',
                tipoAccion:0,
                usuarios : [],
                metodos : []
            }
        },
        methods :{
            listarPagos(){
                let me = this;
                axios.get('/pagos').then(function(response){//Se obtienen los datos del controlador "cliente(index)"
                    me.pagos=response.data;
                    console.log(me.pagos);
                })
                .catch(function(error){
                    console.log(error);
                });
            },
          obtenerUsuarios(){
              let me = this;
              axios.get('/pagos/usuarios').then(function(response){
                  me.usuarios=response.data;
                  console.log(me.usuarios);
              })
              .catch(function(error){
                  console.log(error);
              });
          },
          obtenerMetodos(){
            let me = this;
            axios.get('/pagos/metodos').then(function(response){
                me.metodos=response.data;
                console.log(me.metodos);
            })
            .catch(function(error){
                console.log(error);
            });
          },
        //Funcion para registrar a los nuevos clientes
            registrarMetodo(){
//                 if(this.ValidarMetodo()){
//                     return;
//                 }
                let me = this;
                axios.post('/pagos/store',{
                'codigo_retiro':this.codigo_retiro,
                'monto':this.monto,
                'monto_final':this.monto_final,
                'id_metodo':this.id_metodo,
                'id_usuario':this.id_usuario
                }).then(function (response){//En caso de que si se ejecute correctamente
                    me.cerrarModal();//cierra la ventana de registro 
                    me.listarPagos();//refresca la lista de clientes
                }).catch(function (error){
                    console.log(error);
                });
            },
             //Funcion para registrar a los nuevos clientes
            actualizarMetodo(){
//                 if(this.ValidarMetodo()){
//                     return;
//                 }
                let me = this;
                axios.put('/pagos/update',{
                    'id':this.id,
                    'codigo_retiro':this.codigo_retiro,
                    'monto':this.monto,
                    'monto_final':this.monto_final,
                    'id_metodo':this.id_metodo,
                    'id_usuario':this.id_usuario
                }).then(function (response){//En caso de que si se ejecute correctamente
                    me.cerrarModal();//cierra la ventana de registro 
                    me.listarPagos();//refresca la lista de clientes
                }).catch(function (error){
                    console.log(error);
                });
            },
            //Funcion para abrir el modal de registro o actualización de datos
            abrirModal(modelo,accion,data=[]){
                switch(modelo){
                    case "metodo":
                    {
                        console.log(accion);
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Pago';
                                this.codigo_retiro= '';
                                this.monto= '';
                                this.monto_final= '';
                                this.usuario= '';
                                this.metodo= '';
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                
                                this.modal=1;
                                this.tituloModal='Actualizar Pago';
                                this.id=data['id'];
                                this.codigo_retiro= data['codigo_retiro'];
                                this.monto= data['monto'];
                                this.monto_final= data['monto_final'];
                                this.usuario=data['usuario'];
                                this.metodo= data['metodo'];
                                this.tipoAccion=2;
                                break;
                            }
                        }
                    }
                }
            },
            //Funcion para desactivar los clientes
            desactivarMetodo(id){
                swal.fire({
                title: 'Esta seguro de desactivar a este metodo?',
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
                        axios.put('/pagos/desactivar',{
                            'id': id
                        }).then(function (response) {
                            me.listarPagos();
                            swal.fire(
                            'Hecho!',
                            'Metodo restringido.',
                            'success'
                        )
                        }).catch(function (error) {
                        console.log(error);
                        });
                    } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ){
                
                    }
                }) 
            },

            //Funcion para activar los clientes
            activarMetodo(id){
                swal.fire({
                title: 'Esta seguro de desactivar a este metodo?',
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
                        axios.put('/pagos/activar',{
                            'id': id
                        }).then(function (response) {
                            me.listarPagos();
                            swal.fire(
                            'Hecho!',
                            'Metodo Permitido.',
                            'success'
                        )
                        }).catch(function (error) {
                        console.log(error);
                        });
                    } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ){
                
                    }
                }) 
            },

            //Funcion para validar que existan datos
            ValidarMetodo(){
                this.errorMetodo=0;
                this.errorMostrarMsjMetodo=[];
                if(!this.nombre_met)this.errorMostrarMsjMetodo.push("campo nombre del Metodo esta vacio");
                if(!this.monto_min)this.errorMostrarMsjMetodo.push("campo monto minimo esta vacio");
                if(!this.monto_max)this.errorMostrarMsjMetodo.push("campo monto maximo esta vacio");
                if(!this.gasto_fijo)this.errorMostrarMsjMetodo.push("campo gasto fijo esta vacio");
                if(!this.porcentaje_cargo)this.errorMostrarMsjMetodo.push("Campo porcentaje de cargo esta vacio");
                if(!this.tasa_interes)this.errorMostrarMsjMetodo.push("Campo tasa de interes esta vacio");
                if(!this.tipo_moneda)this.errorMostrarMsjMetodo.push("Campo tipo de moneda esta vacio");
                if(!this.img)this.errorMostrarMsjMetodo.push("El campo img esta vacio");
                if(!this.dias_de_proceso)this.errorMostrarMsjMetodo.push("Campo dias de proceso esta vacio");
                if(this.errorMostrarMsjMetodo.length) this.errorMetodo=1;
                return this.errorMetodo;
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
            this.listarPagos();
            this.obtenerUsuarios();
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


