<template>
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Asignado para mi</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tareas</h2>
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
                            <input type="text" v-model="buscar" @keyup.enter="listarTareas(1,buscar,criterio)" placeholder="Buscar..." class="form-control input-sm">
                            <button type="submit" @click="listarTareas(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
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
                            <th><center>Descripcion</center></th>
                            <th><center>Fecha de inicio</center></th>
                            <th><center>Fecha de vencimiento</center></th>
                            <th><center>Estatus</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="tarea in arrayTareas" :key="tarea.id">
                            <td>
                              <center>
                                <ul class="nav navbar-center panel_toolbox">
                                  <template v-if="tarea.condicion && tarea.pagado=='0'">
                                    Sin acciones
                                    Esperando Pago
                                  </template>
                                  <template v-else-if="tarea.condicion && tarea.pagado=='1'">
                                    <span>Sin acciones</span>
                                  </template>
                                  <template v-else>
                                    <a @click="completarTarea(tarea.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                  </template>
                                </ul>
                              </center>
                            </td>
                            <td v-text="tarea.titulo"></td>
                            <td v-text="tarea.descripcion"></td>
                            <td v-text="tarea.inicio"></td>
                            <td v-text="tarea.fin"></td>
                            <td>
                              <center>
                                <div v-if="tarea.condicion">
                                    <span class="label label-success">Completada</span>
                                    <div v-if="tarea.pagado">
                                      <span class="label label-success">Pagada</span>
                                    </div> 
                                    <div v-else>
                                      <span class="label label-warning">No pagada</span>
                                    </div>
                                </div>
                                <div v-else>
                                    <span class="label label-warning">En curso</span>
                                </div>
                              </center>
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
        </div>

    </div>
</template>
<script>
  export default{
    data(){
      return{
        arrayTareas: [],
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
      listarTareas(page, buscar, criterio){
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/tareaAuth?page='+page+'&buscar='+buscar+'&criterio='+criterio;
        axios.get(url).then(function (response){
            var respuesta = response.data;
            me.arrayTareas = respuesta.tareas.data;
            me.pagination = respuesta.pagination;
        })
        .catch(function (error){
        console.log(error);
        });
      },
      completarTarea(id){
        swal.fire({
          title: 'Marcar como completa esta tarea?',
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

            axios.put('/tarea/completar',{
                'id': id
            }).then(function (response) {
                me.listarTareas(1,'','titulo');
                swal.fire(
                'Hecho!',
                'Tarea completada.',
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
    mounted(){
      this.listarTareas(1, this.buscar, this.criterio);
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