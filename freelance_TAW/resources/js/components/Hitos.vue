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
                                <div v-if="arrayHito.length < 1">
                                    <h3>Sin registros</h3>
                                </div>
                                <div v-for="hitos in arrayHito" :key="hitos.id" class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                                    
                                    <div class="panel">
                                        <div v-if="hitos.condicion">
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li @click="abrirModal(hitos)"><a style="background-color: rgba(52,152,219,.88); "><i class="fa fa-pencil-square-o"></i></a></li>
                                                <li @click="cancelarHito(hitos.id)"><a style="background-color: rgba(52,152,219,.88); "><i class="fa fa-remove"></i></a></li>
                                            </ul>
                                            <a style="background-color: rgba(38,185,154,.88); color: white;" class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion1" v-bind:href="'#'+hitos.id" aria-expanded="false" aria-controls="collapseOne">
                                                
                                                <h4 class="panel-title" v-text="hitos.titulo + ' - ' + hitos.titulo_proyecto"></h4>
                                                <span>Inicio: {{hitos.inicio}} - Fin: {{hitos.fin}}</span>
                                            </a>
                                        </div>
                                        <div v-else>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li @click="abrirModal(hitos)"><a style="background-color: #5A738E"><i class="fa fa-pencil-square-o"></i></a></li>
                                                <li @click="cancelarHito(hitos.id)"><a style="background-color: #5A738E"><i class="fa fa-remove"></i></a></li>
                                            </ul>
                                            <a class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion1" v-bind:href="'#'+hitos.id" aria-expanded="false" aria-controls="collapseOne">
                                                
                                                <h4 class="panel-title" v-text="hitos.titulo + ' - ' + hitos.titulo_proyecto"></h4>
                                                <span>Inicio: {{hitos.inicio}} - Fin: {{hitos.fin}}</span>
                                            </a>
                                        </div>

                                        <div v-bind:id="hitos.id" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div v-if="hitos.condicion">
                                                <div class="panel-body" style="background-color: rgba(38,185,154,.88); color: white;">
                                                    <h3 v-text="hitos.descripcion"></h3>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="panel-body">
                                                    <h3 v-text="hitos.descripcion"></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click="cerrarModal()" type="button" class="btn btn-primary">Cancelar</button>
                            <button @click="actualizarHito()" type="button" class="btn btn-success">Actualizar</button>
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
            hito_id: 0,
            titulo: '',
            descripcion: '',
            inicio: '',
            fin: '',
            idproyecto: 0,
            arrayHito: [],
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
            var url='/hito?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then(function (response){
                var respuesta = response.data;    
                me.arrayHito = respuesta.hitos.data;
                me.pagination = respuesta.pagination;
            })
            .catch(function (error){
            console.log(error);
            });
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarHito(page,buscar,criterio);
        },
        //ABRIR MODAL ACTUALIZAR
        abrirModal(data=[]){
            this.modal = 1;
            this.tituloModal = 'Actualizar Hito';
            this.hito_id=data['id'];
            this.titulo = data['titulo'];
            this.descripcion = data['descripcion'];
            this.inicio = data['inicio'];
            this.fin = data['fin'];
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
        }
    },
    mounted (){
      this.listarHito(1,this.buscar,this.criterio);
    }
}
</script>