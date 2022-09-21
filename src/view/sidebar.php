<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo RUTA_HTTP; ?>/assets/dist/img/user-<?php echo $info_Persona['sexo']; ?>.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $info_Persona['primer_nombre'].' '.$info_Persona['apellido_paterno']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->

    

    <ul class="sidebar-menu"> 
      <li class="header">Menú de Navegacion</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-lock"></i>
          <span>Seguridad</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
            <li><a href="index.php?c=Usuario"><i class="fa fa-circle-o" aria-hidden="true"></i> Usuarios</a></li>
            <li><a href="index.php?c=Perfil"><i class="fa fa-circle-o" aria-hidden="true"></i> Perfiles</a></li>
            <li><a href="index.php?c=Interface"><i class="fa fa-circle-o" aria-hidden="true"></i> Interfaces</a></li>
            <li><a href="index.php?c=Permiso"><i class="fa fa-circle-o" aria-hidden="true"></i> Permiso</a></li>                 
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Administración</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
            <li><a href="index.php?c=Persona"><i class="fa fa-circle-o" aria-hidden="true"></i> Persona</a></li>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Ventas</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
            <li><a href="index.php?c=#"><i class="fa fa-circle-o" aria-hidden="true"></i> #</a></li>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Procesos</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
            <li><a href="index.php?c=#"><i class="fa fa-circle-o" aria-hidden="true"></i> #</a></li>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Reportes</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
            <li><a href="index.php?c=#"><i class="fa fa-circle-o" aria-hidden="true"></i> #</a></li>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Dashboard</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
            <li><a href="index.php?c=#"><i class="fa fa-circle-o" aria-hidden="true"></i> #</a></li>
          </li>
        </ul>
      </li>

      <li>            
    </ul>
 
  </section>
  <!-- /.sidebar -->
</aside>