<!---->
  <div class="container-fluid monitor-page">
    <div class="row">
      <!--Sidebar-->
      <div class="col-md-3 sidebar">
        <!-- Sidebar toolbar -->
        <div class="row sidebar-toolbar">
          <div class="col-md-12 text-center">
            Indische Home
          </div>
        </div>

        <h2>Camera</h2>
        <ul style="color:white; font-size:20px;">
          <?php
            for($i=0; $i<$package->CameraQty;$i++){
              echo "<li><a href='#".$i."' class='btn btn-primary jumper'>Camera ".($i+1)."</a></li>";
            }
          ?>
        </ul>
      </div>

      <!--Mainpage page-->
      <div class="col-md-9 mainpage">
        <!-- mMainpage toolbar -->
        <div class="row mainpage-toolbar">
          <div class="col-md-1">
            <a href="index.php" target="_blank"><img src="assets\web-page-home.svg" class="home-icon" /></a>
          </div>
          <div class="col-md-8"></div>
          <div class="col-md-3">
            <img src="assets\user.svg" class="home-icon" /> <?php echo $user->FullName; ?>
          </div>
        </div>
        <div class="mainpage-content">
          <?php
            $url = "";
            for($i=0; $i<$package->CameraQty;$i++){
              $url = "http://".$camera[$i]->Source.":8080/video";
          ?>
            <div class="row" id="<?=$i?>">
              <h4>Camera No. <?=$i+1?></h4>
              <img style="-webkit-user-select: none;" src="<?php echo $url;?>" width="605" height="460">
            </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".jumper").on("click", function( e ) {

        e.preventDefault();

        $("body, html").animate({ 
          scrollTop: $( $(this).attr('href') ).offset().top - 80
        }, 700);

      });
    });
  </script>
  <!---->