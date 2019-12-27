<template>
    <!--FIRST DIV-->
    <div>
        <!--PAGE-TITTLE-->
        <!-- top tiles -->
        <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
            <div class="count">2500</div>
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
            <div class="count">123.50</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
            <div class="count green">2,500</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
            <div class="count">4,567</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">7,325</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        </div>
        <!-- /top tiles -->
        <!--/PAGE-TITTLE-->
        <div class="clearfix"></div>
        <!--ROW-->
        <h5>Gestion</h5>
        <div class="row">
            <!--COL-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--PANEL-->
                <div class="x_panel">
                    <h2>Presupuesto total</h2>
                </div>
                <!--PANEL-->
            </div>
            <!--/COL-->
            <!--COL-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--PANEL-->
                <div class="x_panel">
                    <h2>Proyectos</h2>
                </div>
                <!--PANEL-->
            </div>
            <!--/COL-->
        </div>
        <!--/ROW-->
        <hr>
        <h5>Usuarios</h5>
        <!--ROW-->
        <div class="row">
            <!--COL-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--PANEL-->
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Administradores</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a ><i></i></a>
                            </li>
                            <li><a ><i></i></a>
                            </li>
                            <li><a ><i></i></a>
                            </li>
                            <li><a ><i></i></a>
                            </li>
                            <li><a ><i></i></a>
                            </li>
                            <li><a ><i></i></a>
                            </li>
                            <li><a ><i></i></a>
                            </li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="x_content" style="display: block;">
                            <h4>Total</h4>
                            <canvas id="administradores"></canvas>
                        </div>
                    </div>
                </div>
                <!--PANEL-->
            </div>
            <!--/COL-->
            <!--COL-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--PANEL-->
                <div class="x_panel">
                    <h2>Project Managers</h2>
                </div>
                <!--PANEL-->
            </div>
            <!--/COL-->
        </div>
        <!--/ROW-->
        <!--ROW-->
        <div class="row">
            <!--COL-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--PANEL-->
                <div class="x_panel">
                    <h2>Desarrolladores</h2>
                </div>
                <!--PANEL-->
            </div>
            <!--/COL-->
            <!--COL-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--PANEL-->
                <div class="x_panel">
                    <h2>Clientes</h2>
                </div>
                <!--PANEL-->
            </div>
            <!--/COL-->
        </div>
        <!--/ROW-->
    </div>
    <!--END FIRST DIV-->
</template>
<script>
    export default{
        data(){
            return{
                //valores de id
                varUsuario:null,
                //crar grafico con valores
                charUsuario:null,
                //listado de usuarios
                usuarios:[],
                //total de cada tipo de usuario
                varTotalUsuarios:[],
            }
        },
        methods: {
            getUsuarios(){
                let me = this;
                var url = '/dashboard';
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    /*Almacenar en usuarios*/    
                    me.usuarios = respuesta.users;
                    me.loadUsuarios();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            //RECORREMOS EL ARREGLO DE USUARIOS
            loadUsuarios(){
                let me = this;
                me.usuarios.map(function(x){
                    me.varTotalUsuarios.push(x.total);
                });
                /*GRAFICA*/
                me.varUsuario = document.getElementById('administradores').getContext('2d');
                alert("holAAA"); 
                me.charUsuarioUsuario = new Chart(me.varUsuario, {
                    type: 'bar',
                    data: {
                        labels: 'Adiministradores',
                        datasets: [{
                            label: '# of Votes',
                            data: varTotalUsuarios,
                            backgroundColor:
                                'rgba(255, 99, 132, 0.2)',
                            borderColor: 
                                'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        },
        mounted(){
            this.getUsuarios();
        }
    }
</script>