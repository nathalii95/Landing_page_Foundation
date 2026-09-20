<!DOCTYPE html>
<html lang="en">
  <head>
<?php include 'head.php'; ?>
  </head>
  <body>
    <div class="container-scroller">
      <?php include 'nav.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'nav2.php'; ?>
        <!-- partial -->
     <?php include 'dashboard.php'; ?>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include 'scripts.php'; ?>
  </body>
</html>