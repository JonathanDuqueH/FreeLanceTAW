<template>
<div>
<div>
    <div class="page-title">
        <div class="title_left">
        <h3>Métodos de pago</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>Métodos de pago</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <!--Boton para abrir el modal-->
                    <li @click="abrirModal('metodo','registrar')"><a ><i class="fa fa-plus-square"></i></a></li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_length" id="datatable_length">
                                    <label>
                                    Mostrar por
                                    <select  name="datatable_length" aria-controls="datatable" class="form-control input-sm">
                                        <option value="name">Nombre</option>
                                        <!--<option value="apellido_p">Apellido P.</option>-->
                                    </select>
                                    </label>
                                </div>
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
                                        <th><center>Método de pago</center></th>
                                        <th><center>Monto minimo</center></th>
                                        <th><center>Monto máximo</center></th>
                                        <th><center>Gasto fijo</center></th>
                                        <th><center>Porcentaje de cargo</center></th>
                                        <th><center>Tasa de interes</center></th>
                                        <th><center>Tipo de moneda</center></th>
                                        <th><center>Días de proceso</center></th>
                                        <th><center>Estado</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="metodo in metodos" :key="metodo.id">
                                        <td>
                                            <ul class="nav navbar-center panel_toolbox">
                                        
                                                <a @click="abrirModal('metodo', 'actualizar',metodo)" class="dropdown-toggle" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                                <template v-if="metodo.condicion">
                                                    <a @click="desactivarMetodo(metodo.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                                </template>
                                                <template v-else>
                                                    <a @click="activarMetodo(metodo.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                                </template>
                                            </ul>
                                        </td> 
                                        <td v-text="metodo.nombre_met"></td>
                                        <td v-text="metodo.monto_min"></td>
                                        <td v-text="metodo.monto_max"></td>
                                        <td v-text="metodo.gasto_fijo"></td>
                                        <td v-text="metodo.porcentaje_cargo"></td>
                                        <td v-text="metodo.tasa_interes"></td>
                                        <td v-text="metodo.tipo_moneda"></td>
                                        
                                        <td v-text="metodo.dias_de_proceso"></td>
                                        <td>
                                            <div v-if="metodo.condicion">
                                                <span class="label label-success">Activo</span>
                                            </div>
                                            <div v-else>
                                                <span class="label label-danger">Inactivo</span>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Nombre(s)" type="text" v-model="nombre_met">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Monto Minimo: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Monto Minimo" type="text" v-model="monto_min">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Monto Maximo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Monto Maximo" type="text" v-model="monto_max">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gasto Fijo: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Gasto Fijo" type="text" v-model="gasto_fijo">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Porcentaje Cargo: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Porcentaje Cargo" type="text" v-model="porcentaje_cargo">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tasa de Interes: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Tasa de Interes" type="text" v-model="tasa_interes">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Moneda: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Tipo de Moneda" type="text" v-model="tipo_moneda">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">IMG: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="IMG" type="text" v-model="img">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Dias de Proceso: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Dias de Proceso" type="text" v-model="dias_de_proceso">
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
                nombre_met: '',
                monto_max: '',
                monto_min: '',
                gasto_fijo: '',
                porcentaje_cargo: '',
                tasa_interes: '',
                tipo_moneda: '',
                img: '',
                dias_de_proceso: '',
                metodos: [],
                modal:0,
                tituloModal: '',
                tipoAccion:0,
                errorMetodo :0,
                errorMostrarMsjMetodo :[],
            }
        },
        methods :{

            listarMetodos(){
                let me = this;
                axios.get('/metodos').then(function(response){//Se obtienen los datos del controlador "cliente(index)"
                    me.metodos=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
        //Funcion para registrar a los nuevos clientes
            registrarMetodo(){
                if(this.ValidarMetodo()){
                    return;
                }
                let me = this;
                axios.post('/metodos/store',{
                'nombre_met':this.nombre_met,
                'monto_min':this.monto_min,
                'monto_max':this.monto_max,
                'gasto_fijo':this.gasto_fijo,
                'porcentaje_cargo':this.porcentaje_cargo,
                'tasa_interes':this.tasa_interes,
                'tipo_moneda':this.tipo_moneda,
                'img':this.img,
                'dias_de_proceso':this.dias_de_proceso
                }).then(function (response){//En caso de que si se ejecute correctamente
                    me.cerrarModal();//cierra la ventana de registro 
                    me.listarMetodos();//refresca la lista de clientes
                }).catch(function (error){
                    console.log(error);
                });
            },

                //Funcion para registrar a los nuevos clientes
            actualizarMetodo(){
                if(this.ValidarMetodo()){
                    return;
                }
                let me = this;
                axios.put('/metodos/update',{
                    'id':this.id,
                'nombre_met':this.nombre_met,
                'monto_min':this.monto_min,
                'monto_max':this.monto_max,
                'gasto_fijo':this.gasto_fijo,
                'porcentaje_cargo':this.porcentaje_cargo,
                'tasa_interes':this.tasa_interes,
                'tipo_moneda':this.tipo_moneda,
                'img':this.img,
                'dias_de_proceso':this.dias_de_proceso
                }).then(function (response){//En caso de que si se ejecute correctamente
                    me.cerrarModal();//cierra la ventana de registro 
                    me.listarMetodos();//refresca la lista de clientes
                }).catch(function (error){
                    console.log(error);
                });
            },

        //Funcion para actualizar la info de los clientes
            /*actualizarClientes(){
                let me = this;
                axios.put('/Clientes/actualizar',{
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

*/
        
            
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
                                this.tituloModal='Registrar Metodo de Pago';
                                this.nombre_met= '';
                                this.monto_max= '';
                                this.monto_min= '';
                                this.gasto_fijo= '';
                                this.porcentaje_cargo= '';
                                this.tasa_interes= '';
                                this.tipo_moneda= '';
                                this.img= '';
                                this.dias_de_proceso= '';
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                
                                this.modal=1;
                                this.tituloModal='Actualizar Metodo de Pago';
                                this.id=data['id'];
                                this.nombre_met=data['nombre_met'];
                                this.monto_max= data['monto_max'];
                                this.monto_min= data['monto_min'];
                                this.gasto_fijo= data['gasto_fijo'];
                                this.porcentaje_cargo= data['porcentaje_cargo'];
                                this.tasa_interes= data['tasa_interes'];
                                this.tipo_moneda= data['tipo_moneda'];
                                this.img= data['img'];
                                this.dias_de_proceso= data['dias_de_proceso'];
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
                        axios.put('/metodos/desactivar',{
                            'id': id
                        }).then(function (response) {
                            me.listarMetodos();
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
                        axios.put('/metodos/activar',{
                            'id': id
                        }).then(function (response) {
                            me.listarMetodos();
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
            this.listarMetodos();
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



