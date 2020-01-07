<template>
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Colaboraciones</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Proyectos</h2>
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
                            <input type="text" v-model="buscar" @keyup.enter="listarProyectos(1,buscar,criterio)" placeholder="Buscar..." class="form-control input-sm">
                            <button type="submit" @click="listarProyectos(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                            </label>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                        <thead>
                          <tr>              
                            <th><center>Título</center></th>
                            <th><center>Descripcion</center></th>
                            <th><center>Project Manager</center></th>
                            <th><center>Cliente</center></th>
                            <th><center>Estatus</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="proyecto in arrayProyectos" :key="proyecto.id">
                            <td v-text="proyecto.titulo"></td>
                            <td v-text="proyecto.descripcion"></td>
                            <td v-text="proyecto.pmanager+' '+proyecto.pmanager_ap"></td>
                            <td v-text="proyecto.cliente+' '+proyecto.cliente_ap"></td>
                            <td>
                              <div v-if="proyecto.condicion == 1">
                                <span class="label label-warning">Activo</span>
                              </div>
                              <div v-else-if="proyecto.condicion == 2">
                                <span class="label label-success">Terminado</span>
                              </div>
                              <div v-else>
                                <span class="label label-danger">Cancelado</span>
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
        arrayProyectos: [],
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
      listarProyectos(page, buscar, criterio){
        let me=this;
        //RUTA PARA OBTENER DATOS
        var url='/colaboradorAuth?page='+page+'&buscar='+buscar+'&criterio='+criterio;
        axios.get(url).then(function (response){
            var respuesta = response.data;
            me.arrayProyectos = respuesta.colaboradores.data;
            me.pagination = respuesta.pagination;
        })
        .catch(function (error){
        console.log(error);
        });
      }
    },
    mounted(){
      this.listarProyectos(1, this.buscar, this.criterio);
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