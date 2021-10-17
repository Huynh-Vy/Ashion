
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php';  ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
    <?php include 'nav.php';?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php include 'sidebar.php'; ?>

   

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
       <!--Lỗi nếu có-->
    <?php include 'errors.php'; ?>
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content" style="margin-top:20px">
        <div class="row">
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <?=$title?>
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <?php include $template .'.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 text-center">
                <p class="lead">
                    <a href="contact-us.html">Contact us</a>,
                    if you found not the right anwser or you have a other question?<br />
                </p>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'footer.php';?>


<!-- jQuery -->
<script src="/public/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/public/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/public/admin/dist/js/demo.js"></script>

<script src="/public/admin/js/main.js"></script>
</body>
</html>
