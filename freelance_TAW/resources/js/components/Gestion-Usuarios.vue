<template>
<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Usuarios</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Usuarios registrados</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><center>Opciones</center></th>
                          <th><center>Nombre</center></th>
                          <th><center>Apellido</center></th>
                          <th><center>Número</center></th>
                          <th><center>Teléfono</center></th>
                          <th><center>Email</center></th>
                          <th><center>Rol</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="user in arrayUser" :key="user.id">
                            <td>

                            </td>
                        <!--<div v-if="rol.condicion">
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
              </div>
            </div>
</div>
</template>
<script>
export default{
  data (){
      return{
        usuario_id: 0,
        name: '',
        apellido_p: '',
        apellido_m: '',
        telefono: '',
        email: '',
        idrol: 0,
        arrayUser: [],
        arrayRol: [],
        tituloModal: '',
        tipoAccion: 0,
        errorUser: [],
        errorMostrarMsjPersona: [],
        pagination:{
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 5,
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

            }
    },
    methods:{
      listarUser(){
        let me=this;
        //RUTA PARA OBTENER DATOS
        axios.get('/user').then(function (response){
          me.arrayUser = response.data;
        })
        .catch(function (error){
          console.log(error);
        });
      }
    },
    mounted (){
      this.listarUser();
    }
}
</script>