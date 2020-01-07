<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li @click="menu=0"><a href="#"><i class="fa fa-pie-chart"></i>Dashboard</a></li>
      <li><a class="nav-link text-muted" tags="Quick Access"><i class="fa fa-dashboard"></i> Acceso Rápido <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <!--<li @click="menu=1"><a href="#"><i class="fa-tasks fa"></i>Asignados para mi</a></li>
          <li @click="menu=2"><a href="#"><i class="fa fa-life-bouy"></i>Mis tickets de soporte</a></li>
          <li @click="menu=3"><a href="#"><i class="fa fa-wrench"></i>Mis solicitudes de servicio</a></li>-->
          <li @click="menu=4"><a href="#"><i class="fa-th-list fa"></i>Mis proyectos</a></li>
          <!--<li @click="menu=5"><a href="#"><i class="fa fa-calendar"></i>Calendario</a></li>-
          <li @click="menu=6"><a href="#"><i class="fa fa-life-bouy"></i>Tickets de soporte</a></li>
          <li @click="menu=7"><a href="#"><i class="fa fa-wrench"></i>Solicitudes de servicio</a></li>-->
        </ul>
      </li>
      <!--<h3 class="nav-link text-muted" tags="Quick Access">Acceso Rápido</h3>-->
      <li><a  class="nav-link text-muted" tags="Gestion"><i class="fa fa-gear"></i> Gestion<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=8"><a href="#"><i class="fa-tasks fa"></i>Proyectos</a></li>
         <!-- <li @click="menu=9"><a href="#"><i class="fa fa-shopping-bag"></i>Productos</a></li>-->
          <li @click="menu=10"><a href="#"><i class="fa-wrench fa"></i>Carga laboral</a></li>
          <li @click="menu=11"><a href="#"><i class="fa fa-check-square-o"></i>Hitos</a></li>
        </ul>
      </li>
      <li><a  class="nav-link text-muted" tags="Ventas y Pagos"><i class="fa fa-credit-card"></i>Ventas y Pagos<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=22"><a href="#"><i class="fa fa-money"></i>Métodos de pago</a></li>
          <li @click="menu=13"><a href="#"><i class="fa fa-money"></i>Pagos</a></li>
        </ul>
      </li>
      <li><a  class="nav-link text-muted" tags="Contenido"><i class="fa fa-cloud-upload"></i>Contenido<span></span></a></li>
      <!--<li><a  class="nav-link text-muted" tags="Contenido"><i class="fa fa-cloud-upload"></i>Contenido<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=14"><a href="#"><i class="fa fa-newspaper-o"></i>Articulos</a></li>
          <li @click="menu=15"><a href="#"><i class="fa fa-rss"></i>Publicaciones</a></li>
          <li @click="menu=16"><a href="#"><i class="fa fa-comments"></i>Comentarios</a></li>
          <li @click="menu=17"><a href="#"><i class="fa fa-question-circle"></i>Preguntas Frecuentes</a></li>
          <li @click="menu=18"><a href="#"><i class="fa fa-files-o"></i>Menú y páginas</a></li>
        </ul>
      </li>-->
      <li><a  class="nav-link text-muted" tags="Usuarios"><i class="fa fa-users"></i>Usuarios<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=19"><a href="#"><i class="fa fa-building"></i>Compañias/Clientes</a></li>
          <li @click="menu=20"><a href="#"><i class="fa fa-users"></i>Roles</a></li>
          <li @click="menu=21"><a href="#"><i class="fa fa-users"></i>Usuarios</a></li>
        </ul>
      </li>
    </ul> 
  </div>
</div>

<!-- /sidebar menu 
 /menu footer buttons
--><div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}">
      <span class="fa fa-power-off" aria-hidden="true"></span>
  </a>
  </div>
 <!--menu footer buttons--> 