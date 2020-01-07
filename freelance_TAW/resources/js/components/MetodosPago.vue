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
                                        <option value="nombre">Nombre</option>
                                        <!--<option value="apellido_p">Apellido P.</option>-->
                                    </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="dataTables_length" id="datatable_length">
                                    <label>
                                    Buscar:
                                    <input type="text" v-model="buscar" @keyup.enter="listarMetodos(1,buscar,criterio)" placeholder="Buscar..." class="form-control input-sm">
                                    <button type="submit" @click="listarMetodos(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
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
                                        <th><center>Método</center></th>
                                        <th><center>Logo</center></th>
                                        <th><center>Estado</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="metodo in arrayMetodos" :key="metodo.id">
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
                                        <center><td v-text="metodo.nombre"></td></center>
                                        <td>
                                            <center>
                                                <img with="50" height="50" :src="metodo.logo">
                                            </center>
                                        </td>
                                        <td><center>
                                            <div v-if="metodo.condicion">
                                                <span class="label label-success">Activo</span>
                                            </div>
                                            <div v-else>
                                                <span class="label label-danger">Inactivo</span>
                                            </div></center>
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
                        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="logo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Nombre(s)" type="text" v-model="nombre">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Logo: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="logo" @change="obtenerImagen"  class="col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Logo de método de pago" type="file" required>
                                </div>
                            </div>


                            <div class="item form-group" v-if="img_min != '' ">
                                <center><figure class="form-group col-md-12 col-xs-12">
                                    <img with="100" height="100" :src="imagen" alt="Logo">
                                </figure></center>
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
export default{
    data(){
        return{
            id: 0,
            nombre: '',
            img: '',
            img_min: '',
            arrayMetodos: [],
            modal:0,
            tituloModal: '',
            tipoAccion:0,
            errorMetodo :0,
            errorMostrarMsjMetodo :[],

            pagination:{
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 4,
            criterio: 'nombre',
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

        },
        imagen(){
            return this.img_min;
        }
    },
    methods:{
        obtenerImagen(e){
            let file = e.target.files[0];
            console.log(file);
            this.img = file.name;

            this.cargarImagen(file);
        },

        cargarImagen(file){
            let reader = new FileReader();

            reader.onload = (e) => {
                this.img_min = e.target.result;
            }
            reader.readAsDataURL(file);
        },

        listarMetodos(page, buscar, criterio){
            let me = this;
            var url='/metodos?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then(function(response){//Se obtienen los datos del controlador "cliente(index)"
                var respuesta = response.data;
                me.arrayMetodos=respuesta.metodos.data;
                me.pagination = respuesta.pagination;
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
            'nombre': this.nombre,
            'name': this.name,
            'logo': this.img_min

            }).then(function (response){//En caso de que si se ejecute correctamente
                me.cerrarModal();//cierra la ventana de registro 
                me.listarMetodos(1,'','nombre');//refresca la lista de clientes
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
                me.listarMetodos(1,'','nombre');//refresca la lista de clientes
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
                            this.tituloModal='Registrar Metodo de Pago';
                            this.nombre= '';
                            this.img= '';
                            this.img_min='';
                            this.tipoAccion=1;
                            break;
                        }
                        case 'actualizar':
                        {
                            
                            this.modal=1;
                            this.tituloModal='Actualizar Metodo de Pago';
                            this.id=data['id'];
                            this.nombre=data['nombre'];
                            this.img= data['name'];
                            this.img_min = data['logo'];
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
                        me.listarMetodos(1,'','nombre');
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
                        me.listarMetodos(1,'','nombre');
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
            if(!this.nombre)this.errorMostrarMsjMetodo.push("El nombre de método no puede esatr vacío.");
            if(!this.img_min)this.errorMostrarMsjMetodo.push("Por favor escoga una imagen");
            if(this.errorMostrarMsjMetodo.length) this.errorMetodo=1;
            return this.errorMetodo;
        },

        //Metodo de cerrar el modal par que cierre la ventana
        cerrarModal(){
            this.modal=0;
            this.tituloModal='';
            this.nombre= '';
            this.img= '';
            this.img_min= '';
            this.tipoAccion = '';
        },

        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarMetodos(page,buscar,criterio);
        }
    },
    mounted(){
        this.listarMetodos(1, this.buscar, this.criterio);
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



