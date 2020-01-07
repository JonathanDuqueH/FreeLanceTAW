<template>
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Hitos</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Hitos / Tareas </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                        <div class="row">
                            <div class="col-sm-12">
                                <!--Acordeon-->
                                <div v-for="hitos in arrayHito" :key="hitos.id" class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                                    
                                    <div class="panel">
                                        <div v-if="hitos.condicion">
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li @click="cancelarHito(hitos.id)"><a style="background-color: rgba(52,152,219,.88); "><i class="fa fa-remove"></i></a></li>
                                            </ul>
                                            <a  style="background-color: rgba(38,185,154,.88); color: white;" class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion1" v-bind:href="'#'+hitos.id" aria-expanded="false" aria-controls="collapseOne">
                                                
                                                <h4 class="panel-title" v-text="hitos.titulo + ' - ' + hitos.titulo_proyecto"></h4>
                                                <span>Inicio: {{hitos.inicio}} - Fin: {{hitos.fin}}</span>
                                            </a>
                                        </div>
                                        <div v-else>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li @click="abrirModal('hito', 'actualizar', hitos)"><a style="background-color: #5A738E"><i class="fa fa-pencil-square-o"></i></a></li>
                                                <li @click="cancelarHito(hitos.id)"><a style="background-color: #5A738E"><i class="fa fa-remove"></i></a></li>
                                                <li @click="completarHito(hitos.id)"><a style="background-color: #5A738E"><i class="fa fa-check"></i></a></li>
                                            </ul>
                                            <a class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion1" v-bind:href="'#'+hitos.id" aria-expanded="false" aria-controls="collapseOne">
                                                
                                                <h4 class="panel-title" v-text="hitos.titulo + ' - ' + hitos.titulo_proyecto"></h4>
                                                <span>Inicio: {{hitos.inicio}} - Fin: {{hitos.fin}}</span>
                                            </a>
                                        </div>

                                        <div v-bind:id="hitos.id" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div v-if="hitos.condicion">
                                                <div class="panel-body" style="background-color: rgba(38,185,154,.88); color: white;">
                                                    <p>Descripcion:</p>
                                                    <h4 v-text="hitos.descripcion"></h4>
                                                    <p>Tareas:</p>
                                                    <div v-for="tarea in arrayTareas" :key="tarea.id">  
                                                        <div v-if="tarea.idhito==hitos.id">
                                                            <ul class="to_do">
                                                                <div v-if="tarea.condicion">
                                                                    <li style="background-color: rgba(38,185,154,.88); color: white;">
                                                                        <p v-text="tarea.titulo"></p>
                                                                        <b>COMPLETADO</b>
                                                                    </li>
                                                                </div>
                                                                <div v-else>
                                                                    <li>
                                                                        <p v-text="tarea.titulo">
                                                                        </p>
                                                                    </li>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="panel-body">
                                                    <p>Descripcion:</p>
                                                    <h4 v-text="hitos.descripcion"></h4>
                                                    <p>Tareas:</p>
                                                    <div v-for="tarea in arrayTareas" :key="tarea.id">  
                                                        <div v-if="tarea.idhito==hitos.id">
                                                            <ul class="to_do">
                                                                <div v-if="tarea.condicion">
                                                                    <li style="background-color: rgba(38,185,154,.88); color: white;">
                                                                        <p v-text="tarea.titulo"></p>
                                                                        <b>COMPLETADO</b>
                                                                    </li>
                                                                </div>
                                                                <div v-else>
                                                                    <li>
                                                                        <p v-text="tarea.titulo">
                                                                        </p>
                                                                    </li>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <a @click="abrirModal('hito', 'tarea', hitos)" class="dropdown-toggle" role="button"><i class="fa fa-plus-circle"></i>Añadir tarea </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="arrayHito.length < 1">
                                    <h3>Sin registros</h3>
                                </div>

                                <!--End Acordeon-->
                            </div>
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

        <!-- MODAL - ACTUALIZAR -->
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
                                
                                <template v-if="tipoAccion==1">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulodepartamento">Título: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="titulo" placeholder="Escriba titulo del nuevo proyecto" required="required" type="text">
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
                                </template>

                                <template v-if="tipoAccion==2">

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulodepartamento">Título: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input v-model="titulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" name="titulo" placeholder="Escriba titulo de la tarea" required="required" type="text">
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

                                <div v-show="errorHito" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjHito" :key="error" v-text="error">

                                    </div>
                                </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click="cerrarModal()" type="button" class="btn btn-primary">Cancelar</button>
                            <button v-if="tipoAccion==1" @click="actualizarHito()" type="button" class="btn btn-success">Actualizar</button>
                            <button v-if="tipoAccion==2" @click="anadirTarea()" type="button" class="btn btn-success">Añadir</button>                        
                        </div>
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
            iduser: 0,
            buscar_hito: '',
            hito_id: 0,
            titulo: '',
            descripcion: '',
            inicio: '',
            fin: '',
            idproyecto: 0,
            arrayHito: [],
            arrayProgramador: [],
            arrayTareas: [],
            modal: 0,
            tituloModal: '',
            tipoAccion: 0,
            errorHito: [],
            errorMostrarMsjHito: [],
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
        listarHito(page, buscar, criterio){
            let me=this;
            //RUTA PARA OBTENER DATOS
            var url='/hitoAuth?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then(function (response){
                var respuesta = response.data;    
                //console.log(respuesta);
                me.arrayHito = respuesta.hitos.data;
                me.pagination = respuesta.pagination;
            })
            .catch(function (error){
            console.log(error);
            });
        },
        validarTarea(){
            this.errorHito=0;
            this.errorMostrarMsjHito =[];

            if (!this.titulo) this.errorMostrarMsjHito.push("El titulo no puede estar vacío.");
            if (!this.descripcion) this.errorMostrarMsjHito.push("La descripcion no puede estar vacío.");
            if (!this.iduser) this.errorMostrarMsjHito.push("El usuario no puede estar vacío.");
            if (!this.inicio) this.errorMostrarMsjHito.push("La fecha de inicio no puede estar vacía.");
            if (!this.fin) this.errorMostrarMsjHito.push("La fecha de fin no puede estar vacía.");
            if (!this.idhito && this.tipoAccion==2) this.errorMostrarMsjHito.push("El hito no puede estar vacío.");

            if (this.errorMostrarMsjHito.length) this.errorHito = 1;

            return this.errorHito;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarHito(page,buscar,criterio);
        },
        //ABRIR MODAL ACTUALIZAR
        abrirModal(modelo, accion, data=[]){

            if(accion == 'tarea'){
                this.selectProgramador(data['idproyecto']);
            }

            switch(modelo){
                case "hito":
                {
                    switch(accion){
                        case 'actualizar':
                        {
                            this.modal = 1;
                            this.tituloModal = 'Actualizar Hito';
                            this.hito_id=data['id'];
                            this.titulo = data['titulo'];
                            this.descripcion = data['descripcion'];
                            this.inicio = data['inicio'];
                            this.fin = data['fin'];
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'tarea':
                        {
                            this.modal = 1;
                            this.tituloModal = 'Añadir Tarea';
                            this.titulo = '';
                            this.descripcion = '';
                            this.iduser = 0;
                            this.idhito = data['id'];
                            this.inicio = '';
                            this.fin = '';
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
            this.tituloModal='';
            this.titulo='';
            this.descripcion='';
            this.inicio='';
            this.fin='';
            this.errorHito=0;
        },
        cancelarHito(id){
            swal.fire({
            title: 'Esta seguro de cancelar o eliminar este hito?, el hito sera eliminado permanentemente.',
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

                axios.put('/hito/cancelar',{
                    'id': id
                }).then(function (response) {
                    me.listarHito(1,'','titulo');
                    swal.fire(
                    'Hecho!',
                    'Hito eliminado.',
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
        selectProgramador(idproyecto){
            let me=this;
            var url= '/user/selectProgramadorTarea?idproyecto='+idproyecto;
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayProgramador = respuesta.users;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        anadirTarea(){
            if (this.validarTarea()){
                return;
            }
            
            let me = this;

            axios.post('/tarea/registrar',{
                'titulo': this.titulo,
                'descripcion': this.descripcion,
                'iduser' : this.iduser,
                'inicio' : this.inicio,
                'fin' : this.fin,
                'idhito': this.idhito
            }).then(function (response) {
                me.cerrarModal();
                me.listarHito(1,'','titulo');
                me.listarTareas(1,'','titulo');
            }).catch(function (error) {
                console.log(error);
            });
        },
        listarTareas(){
          let me=this;
            //RUTA PARA OBTENER DATOS
            var url='/tarea';
            axios.get(url).then(function (response){
                var respuesta = response.data;
                //console.log(respuesta); 
                me.arrayTareas = respuesta;
            })
            .catch(function (error){
            console.log(error);
            });  
        },
        completarHito(id){
            swal.fire({
            title: 'Desea marcar como completo este hito?.',
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

                axios.put('/hito/completar',{
                    'id': id
                }).then(function (response) {
                    me.listarHito(1,'','titulo');
                    swal.fire(
                    'Hecho!',
                    'Hito completado.',
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
        }
    },
    mounted (){
      this.listarHito(1,this.buscar,this.criterio);
      this.listarTareas();
    }
}
</script>