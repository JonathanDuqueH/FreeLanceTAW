<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li @click="menu=0"><a href="#"><i class="fa fa-pie-chart"></i>Dashboard</a></li>
      <li><a class="nav-link text-muted" tags="Quick Access"><i class="fa fa-dashboard"></i> Acceso Rápido <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=1"><a href="#"><i class="fa-tasks fa"></i>Asignados para mi</a></li>
          <li @click="menu=2"><a href="#"><i class="fa fa-life-bouy"></i>Mis tickets de soporte</a></li>
          <li @click="menu=3"><a href="#"><i class="fa fa-wrench"></i>Mis solicitudes de servicio</a></li>
          <li @click="menu=4"><a href="#"><i class="fa-th-list fa"></i>Mis proyectos</a></li>
          <li @click="menu=5"><a href="#"><i class="fa fa-calendar"></i>Calendario</a></li>
          <li @click="menu=6"><a href="#"><i class="fa fa-life-bouy"></i>Tickets de soporte</a></li>
          <li @click="menu=7"><a href="#"><i class="fa fa-wrench"></i>Solicitudes de servicio</a></li>
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
          <li @click="menu=12"><a href="#"><i class="fa fa-list-alt"></i>Facturas</a></li>
          <li @click="menu=22"><a href="#"><i class="fa fa-money"></i>Métodos de pago</a></li>
          <li @click="menu=13"><a href="#"><i class="fa fa-money"></i>Pagos</a></li>
        </ul>
      </li>
    </ul> 
  </div>
</div>

<!-- /sidebar menu 

<!-- /sidebar menu 
 /menu footer buttons
--><div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
      <span class="fa fa-power-off" aria-hidden="true"></span>
  </a>
  </div>
 <!--menu footer buttons--> 