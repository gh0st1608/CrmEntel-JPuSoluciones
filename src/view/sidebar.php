<?php
$interfaces_modulo = new InterfazController();

 
$interfaces_modulo =  $interfaces_modulo->ConsultaModulo();
 
 

?>
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
      <?php foreach ($interfaces_modulo as $modulo): ?>
      <li class="treeview">
        <a href="#"> 
          <i class="fa fa-lock"></i>
          <span><?php echo $modulo['Nombre'] ; ?> </span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">                
          <li>
           <? $interfaces_nivel2 = new InterfazController();
             $idInterfaz_modulo = $modulo['idInterfaz'] ;
             $interfaces_nivel2 =  $interfaces_nivel2->ListarNivel($idInterfaz_modulo );
           ?>
            <?php foreach ($interfaces_nivel2 as $nivel2): ?>
              <li><a href=<?php echo  $nivel2['Url'] ; ?>><i class="fa fa-circle-o" aria-hidden="true"></i><?php echo  $nivel2['Nombre'] ; ?> </a>
            
              <? $interfaces_nivel3 = new InterfazController();
                $idInterfaz_nivel2 = $nivel2['idInterfaz'] ;
                $interfaces_nivel3 =  $interfaces_nivel3->ListarNivel($idInterfaz_nivel2 );
              ?>
              <?php foreach ($interfaces_nivel3 as $nivel3): ?>
                <ul class="treeview-menu">                
                  <li>
                    <li><a href=<?php echo  $nivel3['Url'] ; ?>><i class="fa fa-circle-o" aria-hidden="true"></i><?php echo  $nivel3['Nombre'] ; ?> </a>
                 </li>
                </ul>
 
              <?php endforeach; ?>
            </li>
              
 
            <?php endforeach; ?>
          </li>
        </ul>
      </li>
      <?php endforeach; ?>
      <li>            
    </ul>

    
 
  </section>
  <!-- /.sidebar -->
</aside>