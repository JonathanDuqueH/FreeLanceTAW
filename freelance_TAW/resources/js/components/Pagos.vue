<template>
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Pagos</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Gestionar Pagos</h2>
                        
                        <ul class="nav navbar-right panel_toolbox">
                            <button @click="cargarPdf()" class="btn btn-primary pull-right" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Generar PDF
                            </button>                        
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
                                            <option value="asunto">Asunto</option>
                                        </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dataTables_length" id="datatable_length">
                                        <label>
                                        Buscar:
                                        <input type="text" v-model="buscar" @keyup.enter="listarPagos(1,buscar,criterio)" placeholder="Buscar..." class="form-control input-sm">
                                        <button type="submit" @click="listarPagos(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr>
                                        <th><center>Fecha</center></th>
                                        <th><center>Asunto</center></th>
                                        <th><center>Descripción</center></th>
                                        <th><center>Acreedor</center></th>
                                        <th><center>Pagó</center></th>
                                        <th><center>Metodo</center></th>
                                        <th><center>Monto</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="pago in arrayPagos" :key="pago.id">
                                            <td v-text="pago.fecha_pago"></td>
                                            <td v-text="pago.asunto"></td>
                                            <td v-text="pago.descripcion"></td>
                                            <td v-text="pago.a_name+' '+pago.a_ap"></td>
                                            <td v-text="pago.p_name+' '+pago.p_ap"></td>
                                            <td v-text="pago.nombre"></td>
                                            <td v-text="'$'+pago.monto"></td>
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
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            asunto: '',
            descripcion: '',
            fecha_pago: '',
            idacreedor: 0,
            idpaga: 0,
            idmetodo: 0,
            monto: 0,
            modal: 0,
            arrayPagos: [],
            tipoAccion: 0,
            tituloModal: '',
            errorPago: [],
            errorMostrarMsjPago: [],
            pagination:{
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 4,
            criterio: 'asunto',
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
        listarPagos(page, buscar, criterio){
            let me=this;
            //RUTA PARA OBTENER DATOS
            var url='/pago?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then(function (response){
                var respuesta = response.data;   
                console.log(respuesta);
                me.arrayPagos = respuesta.pagos.data;
                me.pagination = respuesta.pagination;
                
            })
            .catch(function (error){
            console.log(error);
            });
        },
        //CERRAR MODAL
        cerrarModal(){
            this.modal=0;
            this.tituloModal='';
            this.asunto= '';
            this.descripcion= '';
            this.fecha_pago = '';
            this.idacreedor = 0;
            this.idpaga = 0;
            this.idmetodo = 0;
            this.descripcion='';
            this.errorPago=0;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarPagos(page,buscar,criterio);
        },
        cargarPdf(){
            window.open('http://jduque.me/pago/listarPdf', '_blank');
        }
    },
    mounted(){
        this.listarPagos(1, this.buscar, this.criterio);
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


