

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

  
     
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE </span>
    </a>

    <!-- Sidebar -->
    
<?php


include("../../init.php");

include 'admin.sidebar.php';

?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   
    
    <?php

include 'admin.helloworld.php';

?>
  <h3>statistics</h3>
  
  <h5>number of users: <?php echo count($admindata['users'])?> </h5>
  <h5>number of to-do :<?php echo count($admindata['items'])?></h5>
  <h5>number of pendings: <?php echo $admindata['pending']?></h5>
  <h5>number of completed: <?php echo $admindata['completed']?></h5>
  <h3>USERS</h3>
 

<div class="row" id="todo-container">
          <?php
      
            for ($i=0;$i<count($admindata['users']);$i++){
            ?>
            
                <div class="col col-12 p-2 todo-item" todo-id="${todo.id}">
                  <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox"  >
                    </div>
                  </div>
                  <input type="text" readonly class="form-control " aria-label="Text input with checkbox" value="<?php echo htmlspecialchars($admindata['users']["$i"]['name']);?>">
                  <input type="text" readonly class="form-control " aria-label="Text input with checkbox" value="<?php echo htmlspecialchars($admindata['users']["$i"]['email']);?>">
                  <input type="text" readonly class="form-control " aria-label="Text input with checkbox" value="<?php echo htmlspecialchars($admindata['users']["$i"]['pass']);?>">
                  <div class="input-group-append">
                    <button  class="btn btn-outline-secondary bg-danger text-white" type="button"  id="button-addon2" onclick="location='index.php?action=delete&item_id=<?php echo $admindata['items'][`$i`]['item_id'] ?>'">X</button>
                  </div>
                  </div>
            </div>
  
            
            <?php
            }
          ?>
      </div>

  <h3>ITEMS</h3>
  
  <div class="row" id="todo-container">
          <?php
      
            for ($i=0;$i<count($admindata['items']);$i++){
            ?>
            
                <div class="col col-12 p-2 todo-item" todo-id="${todo.id}">
                  <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox"  >
                    </div>
                  </div>
                  <input type="text" readonly class="form-control " aria-label="Text input with checkbox" value="<?php echo htmlspecialchars($admindata['items']["$i"]['title']);?>">
                  
                  <div class="input-group-append">
                  <button  class="btn btn-outline-secondary bg-danger text-white" type="button"  id="button-addon3" 
                onclick="location='../edit.php?item_id=<?php echo $items[$i]['item_id'];?>'"
                >
                <?php echo LANG_EDIT_ITEM; ?>
                </button>
                    <button  class="btn btn-outline-secondary bg-danger text-white" type="button"  id="button-addon2" onclick="location='../../index.php?action=delete&item_id=<?php echo $admindata['items'][`$i`]['item_id'] ?>'">X</button>
                  </div>
                  </div>
            </div>
  
            
            <?php
            }
          ?>
      </div>
    <!-- Main content -->
        <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

