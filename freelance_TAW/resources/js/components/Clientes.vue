<template>
<div>
    <div class="page-title">
        <div class="title_left">
        <h3>Clientes</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>Clientes registrados</h2>
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
                                        <option value="name">Nombre</option>
                                        <option value="apellido_p">Apellido P.</option>
                                    </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="datatable_length">
                                    <label>
                                    Buscar:
                                    <input type="text" v-model="buscar" @keyup.enter="listarUser(1,buscar,criterio)" placeholder="Buscar..." class="form-control input-sm">
                                    <button type="submit" @click="listarUser(1,buscar,criterio)" class="form-control input-sm" aria-controls="datatable">Buscar</button>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable" class="table table-striped table-bordered" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th><center>Opciones</center></th>
                                        <th><center>Nombre</center></th>
                                        <th><center>Apellidos</center></th>
                                        <th><center>Teléfono</center></th>
                                        <th><center>Email</center></th>
                                        <th><center>Dirección</center></th>
                                        <th><center>Rol</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="users in arrayUser" :key="users.id">
                                        <td>
                                            <ul class="nav navbar-center panel_toolbox">
                                                <a @click="abrirModal('user', 'actualizar', users)" class="dropdown-toggle" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                                <template v-if="users.condicion">
                                                    <a @click="desactivarUsuario(users.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-remove"></i></a>
                                                </template>
                                                <template v-else>
                                                    <a @click="activarUsuario(users.id)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-check"></i></a>
                                                </template>
                                            </ul>
                                        </td>
                                        <td>
                                            <div v-if="users.condicion">
                                                <span v-text="users.name" class="label label-success"></span>
                                            </div>
                                            <div v-else>
                                                <span v-text="users.name+' - Sin Pedido'" class="label label-warning"></span>
                                            </div>
                                        </td>
                                        <td v-text="users.apellido_p+' '+users.apellido_m"></td>
                                        <td v-text="users.telefono"></td>
                                        <td v-text="users.email"></td>
                                        <td > Calle 12</td>
                                        <td v-text="users.tipo"></td>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Nombre(s)" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido paterno: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="apellido_p" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Apellido" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido materno: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="apellido_m" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Apellido" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="telefono" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Móvil o de casa" type="text">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Correo electrónico" type="email">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="password" class="form-control col-md-7 col-xs-12" data-validate-length-range="50" data-validate-words="2" placeholder="Contraseña de acceso" type="password">
                            </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Rol <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select v-model="idrol" class="form-control col-md-7 col-xs-12" disabled>
                                    <option value="0">Tipo de usuario</option>
                                    <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.tipo"></option>
                                </select>
                            </div>
                            </div>
                            <div v-show="errorUser" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjUser" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button @click="cerrarModal()" type="button" class="btn btn-primary">Cancelar</button>
                        <button v-if="tipoAccion==1" @click="registrarUsuario()" type="button" class="btn btn-success">Guardar</button>
                        <button v-if="tipoAccion==2" @click="actualizarUsuario()" type="button" class="btn btn-success">Actualizar</button>
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
        tipo: '',
        password: '',
        idrol: 0,
        arrayUser: [],
        arrayRol: [],
        modal: 0,
        tituloModal: '',
        tipoAccion: 0,
        errorUser: [],
        errorMostrarMsjUser: [],
        pagination:{
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 4,
        criterio: 'name',
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
        listarUser(page, buscar, criterio){
            let me=this;
            //RUTA PARA OBTENER DATOS
            var url='/userCliente?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then(function (response){
                var respuesta = response.data;    
                me.arrayUser = respuesta.users.data;
                me.pagination = respuesta.pagination;
            })
            .catch(function (error){
            console.log(error);
            });
        },
        //REGISTRAR USUARIO
        registrarUsuario(){
            if (this.validarUsuario()){
                return;
            }
            
            let me = this;

            axios.post('/user/registrar',{
                'name': this.name,
                'apellido_p': this.apellido_p,
                'apellido_m' : this.apellido_m,
                'telefono' : this.telefono,
                'email' : this.email,
                'password': this.password,
                'idrol' : this.idrol
            }).then(function (response) {
                me.cerrarModal();
                me.listarUser(1,'','name');
            }).catch(function (error) {
                console.log(error);
            });
        },
        //ACTUALIZAR USUARIO
        actualizarUsuario(){
            if (this.validarUsuario()){
                return;
            }
            
            let me = this;

            axios.put('/user/actualizar',{
                'name': this.name,
                'apellido_p': this.apellido_p,
                'apellido_m' : this.apellido_m,
                'telefono' : this.telefono,
                'email' : this.email,
                'password': this.password,
                'idrol' : this.idrol,
                'id': this.usuario_id
            }).then(function (response) {
                me.cerrarModal();
                me.listarUser(1,'','name');
            }).catch(function (error) {
                console.log(error);
            });
        },
        //VALIDAR DATOS
        validarUsuario(){
            this.errorUser=0;
            this.errorMostrarMsjUser =[];

            if (!this.name) this.errorMostrarMsjUser.push("El nombre de usuario no puede estar vacío.");
            if (!this.apellido_p) this.errorMostrarMsjUser.push("El apellido paterno de usuario no puede estar vacío.");
            if (!this.apellido_m) this.errorMostrarMsjUser.push("El apellido materno no puede estar vacío.");
            if (!this.telefono) this.errorMostrarMsjUser.push("El telefono de usuario no puede estar vacío.");
            if (!this.email) this.errorMostrarMsjUser.push("El email de usuario no puede estar vacío.");
            if (!this.password) this.errorMostrarMsjUser.push("El password no puede estar vacío.");
            if (this.idrol==0) this.errorMostrarMsjUser.push("Debes seleccionar un rol para el usuario.");

            if (this.errorMostrarMsjUser.length) this.errorUser = 1;

            return this.errorUser;
        },
        //CERRAR MODAL
        cerrarModal(){
            this.modal=0;
            this.tituloModal='';
            this.name='';
            this.apellido_p='';
            this.apellido_m='';
            this.telefono='';
            this.email='';
            this.password='';
            this.idrol=0;
            this.errorUser=0;
        },
        //ABRIR MODAL REGISTRAR O ACTUALIZAR
        abrirModal(modelo, accion, data=[]){
            this.selectRol();//LLAMAR PARA MOSTRAR LISTADO DE ROLES
            //console.log(data);
            switch(modelo){
                case "user":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.modal = 1;
                            this.tituloModal = 'Registrar Usuario';
                            this.name = '';
                            this.apellido_p = '';
                            this.apellido_m = '';
                            this.telefono = '';
                            this.email = '';
                            this.password = '';
                            this.idrol = 0;
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            this.modal = 1;
                            this.tituloModal = 'Actualizar Usuario';
                            this.usuario_id=data['id'];
                            this.name = data['name'];
                            this.apellido_p = data['apellido_p'];
                            this.apellido_m = data['apellido_m'];
                            this.telefono = data['telefono'];
                            this.email = data['email'];
                            this.password = data['password'];
                            this.idrol = data['idrol'];
                            //console.log(usuario_id);
                            this.tipoAccion = 2;
                            break;
                        }
                    }
                }
            }
        },
        desactivarUsuario(id){
            swal.fire({
            title: 'Esta seguro de restringir el acceso a este usuario?',
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

                axios.put('/user/desactivar',{
                    'id': id
                }).then(function (response) {
                    me.listarUser(1,'','name');
                    swal.fire(
                    'Hecho!',
                    'Usuario restringido.',
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
        activarUsuario(id){
            swal.fire({
            title: 'Esta seguro de conceder acceso a este usuario?',
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

                axios.put('/user/activar',{
                    'id': id
                }).then(function (response) {
                    me.listarUser(1,'','name');
                    swal.fire(
                    'Activado!',
                    'Este usuario tiene acceso.',
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
        selectRol(){
            let me=this;
            var url= '/rol/selectRol';
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayRol = respuesta.roles;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarUser(page,buscar,criterio);
        }
    },
    mounted (){
      this.listarUser(1,this.buscar,this.criterio);
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