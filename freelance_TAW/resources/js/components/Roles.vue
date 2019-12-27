<template>
<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Roles</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Roles de asignación</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="datatable-wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-12">
                              <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                  <tr>
                                    <th><center>Tipo</center></th>
                                    <th><center>Descripción</center></th>
                                    <th><center>Estado</center></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="rol in arrayRol" :key="rol.id">
                                    <td v-text="rol.tipo"></td>
                                    <td v-text="rol.descripcion"></td> 
                                    <td>
                                      <div v-if="rol.condicion">
                                        <span class="label label-success">Activo</span>
                                      </div>
                                      <div v-else>
                                        <span class="label label-danger">Sin signar</span>
                                      </div>
                                    </td> 
                                  </tr>
                                </tbody>
                              </table>
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
  data (){
      return{
        tipo: '',
        descripcion: '',
        arrayRol: []
      }
    },
    methods:{
      listarRol(){
        let me=this;
        axios.get('/rol').then(function (response){
          me.arrayRol = response.data;
        })
        .catch(function (error){
          console.log(error);
        });
      }
    },
    mounted (){
      this.listarRol();
    }
}
</script>