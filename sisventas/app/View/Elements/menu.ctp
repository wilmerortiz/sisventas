<?php  
    require_once "Conexion.php";
    require_once "Sql.php";

    $sidebar = new Menu();

    $url = Router::url('/');
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php echo $this->Html->Image('dist/img/user2-160x160.jpg',['class'=>'img-circle']) ?>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php foreach($sidebar->getModulosPadres() as $modulo): ?>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-table"></i> <span><?php echo $modulo['modulos'] ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php foreach( $sidebar->getModulosHijos('01',$modulo['modulo_id']) as $hijos): ?>
                    <li class=""><a href="<?php echo $url.$hijos['url'] ?>"><i class="fa fa-circle-o"></i> <?php echo $hijos['modulos'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
