<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li @click="menu=0"><a href="#"><i class="fa fa-pie-chart"></i>Dashboard</a></li>
      <li><a class="nav-link text-muted" tags="Quick Access"><i class="fa fa-dashboard"></i> Acceso Rápido <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=1"><a href="#"><i class="fa-tasks fa"></i>Asignados para mi</a></li>
          <li @click="menu=4"><a href="#"><i class="fa-th-list fa"></i>Mis proyectos</a></li>
        </ul>
      </li>
      <li><a  class="nav-link text-muted" tags="Ventas y Pagos"><i class="fa fa-credit-card"></i>Pagos<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li @click="menu=23"><a href="#"><i class="fa fa-money"></i>Pagos</a></li>
        </ul>
      </li>
    </ul> 
  </div>
</div>

<!-- /sidebar menu 
 /menu footer buttons
--><div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
      <span class="fa fa-power-off" aria-hidden="true"></span>
  </a>
  </div>
 <!--menu footer buttons--> 