    <!-- Navbar -->
    <div class="row">
      <nav class="navbar navbar-default">
        <div class="container-fluid">

          <!-- logo -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                <span class="icon-bar" style="background-color: #e5e5e5;"></span>
                <span class="icon-bar" style="background-color: #e5e5e5;"></span>
                <span class="icon-bar" style="background-color: #e5e5e5;"></span>
              </button>
          </div>
          <!-- Menu items -->
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#about-us"  onclick="this.blur();">About</a></li>
              <li><a href="#features"  onclick="this.blur();">Features</a></li>
              <li><a href="#packages"  onclick="this.blur();">Packages</a></li>
              <?php if(!Yii::app()->user->isGuest){ ?>
              <li><a href="#" onclick="editProfile();">Edit Profile</a></li>
              <?php } ?>
            </ul>
          </div>

      </div>
      </nav>
    </div>
  <!-- End Navigation section -->

    <!-- Start Header text and Login/Profile card section -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 col-sm-3"></div>
        <!-- Start card container section -->
        <div class="col-md-3 col-sm-6 card-container">

          <!-- When user is loged in -->
          <?php
            if(!Yii::app()->user->isGuest){
          ?>
          <div class="row one-u">
            <div class="col-md-4">
              <img id="user-icon" src="assets/user.svg" />
            </div>
            <div class="col-md-8">
              <span>Welcome,</span><br />
              <em><?php echo $model->FullName; ?></em>
            </div>
          </div>

          <div class="row two-u">
            <div class="col-md-12"><hr />
            </div>
          </div>

          <div class="row three-u">
            <div class="col-md-12">
              <p class="text-center">
              <?php
                if($model->OrderID == null){
              ?>
                You don't have any subscription yet.<br/>
                Please SUBSCRIBE one first!
              <?php
                }
                else if($model->OrderID != null && $order->DateExpired <= date("Y-m-d")){
                  echo "Current Package<br>" . $package->PackageName . "<br>Your Package has expired in <span style='color:red;'>" . $order->DateExpired . "</span>, please complete your payment first in order to continue subscribing";
                }
                else{
              ?>
                Current Package<br />
                <?php echo $package->PackageName; ?><br/>
                <span style="color:red;">Expired Date: <?php echo $order->DateExpired; ?></span>
              <?php
              }
              ?>
              </br/>
              </p>
            </div>
          </div>

          <div class="row four-u">
            <!-- if user already subscribe a package, show this button -->
            <div class="col-md-6">
              <p class="text-center">
                <?php if($model->OrderID==null){
                    echo '<a href="#packages" class="btn btn-custom">SUBSCRIBE</a>';
                  }
                  else if($model->OrderID!=null && $order->DateExpired <= date("Y-m-d")){
                    echo '<button class="btn btn-custom" onclick="monitoring();">Complete Payment</button>';
                  }
                  else{
                    echo '<button class="btn btn-custom" onclick="monitoring();">Monitor</button>';
                  }?>
              </p>
            </div>
            <!-- if user hasn't subscribe any package, only show this button with div class col-md-12 -->
            <div class="col-md-6">
              <p class="text-right">
                <button class="btn btn-custom" onclick="logout();">Logout</button>
              </p>
            </div>
          </div>
          <!-- End of loged in user section -->

          <!-- When user not login/still a guest -->
          <?php
          }
          else{
          ?>
          <div class="row one-g">
            <div class="col-md-12">
              <h3>Login</h3>
            </div>
          </div>

          <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
              'validateOnSubmit'=>true,
            ),
          )); ?>
          <div class="row two-g">
            <div class="col-md-12">
                <?php echo $form->textField($loginModel,'username', array('class'=>'form-control', 'placeholder'=>'Input your username', 'id'=>'input-username')); ?>
                <?php echo $form->error($loginModel,'username'); ?>
                <!-- <input type="email" class="form-control" placeholder="email" id="input-email" name="email"/> -->
            </div>
          </div>

          <div class="row three-g">
            <div class="col-md-12">
                <?php echo $form->passwordField($loginModel,'password', array('class'=>'form-control', 'placeholder'=>'Input your password', 'id'=>'input-password')); ?>
                <?php echo $form->error($loginModel,'password'); ?>
               <!-- <input type="password" class="form-control" placeholder="password" id="input-password" name="password"/> -->
            </div>
          </div>

          <div class="row three-g">
            <div class="col-md-12">
              <?php echo $form->checkBox($loginModel,'rememberMe'); ?>
              <?php echo $form->label($loginModel,'rememberMe'); ?>
              <?php echo $form->error($loginModel,'rememberMe'); ?>
            </div>
          </div>

          <div class="row four-g">
            <div class="col-md-12">
                <button class='btn btn-custom'>LOGIN</button>
            </div>
          </div>
          </form>

          <div class="row five-g">
            <div class="col-md-12">
                <a href="#register"><small>Not register yet?</small></a>
            </div>
          </div>
          <?php $this->endWidget();
          }
          ?>
          <!-- End of guest section -->

        </div>
        <!-- End card container section -->
        <div class="col-md-1 col-sm-3"></div>
        <div class="col-md-6 col-sm-12 header-text">
          <div class="brand-image" alt="Indische Home"></div>
          <p><em>I've got you, in my sights!</em></p>
          <!-- If user not login yet, show these button -->
          <?php if(Yii::app()->user->isGuest) {?>
          <a href="#register" class="btn register">Register</a>
          <a href="#about-us" class="btn learn-more">Learn more</a>
          <?php
          }else if($model->OrderID==null){?>
          <a href="#about-us" class="btn learn-more">Learn more</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header text and Login/Profile card section -->

  <!-- Start About us section -->
  <div class="container-fluid" id="about-us">
    <div class="row">
      <div class="col-md-12">
        <img id="down-arrow" class="img-responsive center-block" src="assets/angle-arrow-down.svg" />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 company-detail">
        <h2 class="text-center">Indische Home is</h2>
        <p class="text-center"><br />
          a surveillance service where you can access live and recorded videos about the conditions you want (home or store) in real time using a web browser connected to the internet.
        </p>
      </div>
    </div>
  </div>
  <!-- End of About us section -->

  <!-- Start Features section -->
  <div class="container-fluid" id="features">
    <!-- First row of features -->
    <div class="row">
      <!-- Feature 1 -->
      <div class="col-md-4">
        <div class="feature text-center">
          <div class="bg-circle">
            <img id="img-feature" class="img-responsive center-block" src="assets/eye.svg" />
          </div>
          <div class="feature-header">
            <h4>Live View</h4>
          </div>
          <div class="feature-detail">
            Enjoy your live streaming CCTV anywhere and anytime
          </div>
        </div>
      </div>
      <!-- Feature 2 -->
      <div class="col-md-4 text-center">
        <div class="feature text-center">
          <div class="bg-circle">
            <img id="img-feature" class="img-responsive center-block" src="assets/database.svg" />
          </div>
          <div class="feature-header">
            <h4>Online Storage</h4>
          </div>
          <div class="feature-detail">
            Dozen GB of online storage for your surveillance
          </div>
        </div>
      </div>
      <!-- Feature 3 -->
      <div class="col-md-4 text-center">
        <div class="feature text-center">
          <div class="bg-circle">
            <img id="img-feature" class="img-responsive center-block" src="assets/computer.svg" />
          </div>
          <div class="feature-header">
            <h4>Web-based Interface</h4>
          </div>
          <div class="feature-detail">
           Simply just open your web browser and monitor it!
          </div>
        </div>
      </div>

    </div>
    <!-- Second row of features -->
    <div class="row">
      <!-- Feature 4 -->
      <div class="col-md-4">
        <div class="feature text-center">
          <div class="bg-circle">
            <img id="img-feature" class="img-responsive center-block" src="assets/videocam-filled-tool.svg" />
          </div>
          <div class="feature-header">
            <h4>Record</h4>
          </div>
          <div class="feature-detail">
            Enjoy to record your surveillance anytime
          </div>
        </div>
      </div>
      <!-- Feature 5 -->
      <div class="col-md-4 text-center">
        <div class="feature text-center">
          <div class="bg-circle">
            <img id="img-feature" class="img-responsive center-block" src="assets/running.svg" />
          </div>
          <div class="feature-header">
            <h4>Motion Detect</h4>
          </div>
          <div class="feature-detail">
            Catch any suspicious motion on your camera
          </div>
        </div>
      </div>
      <!-- Feature 6 -->
      <div class="col-md-4 text-center">
        <div class="feature text-center">
          <div class="bg-circle">
            <img id="img-feature" class="img-responsive center-block" src="assets/customer-service.svg" />
          </div>
          <div class="feature-header">
            <h4>Online Support</h4>
          </div>
          <div class="feature-detail">
            Feel free to get in touch with us
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- End of Features section -->

  <!-- Start Packages section -->
  <div class="container-fluid" id="packages">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center package-title"><strong>Our Packages</strong></h2>
      </div>
    </div>
    <div class="row">
      <!-- First package -->
      <div class="col-md-4 text-center">
        <div class="package-container">
          <h2 class="text-center" style="color: chocolate;">Bronze</h2>
          <h3 class="text-center">RM 10</h3>/month
          <p class="text-center h3">
            <ul><li><strong>1 Unit Camera</li>
            <li>100 MB Storage</li>
            <li>5 Days Recording Duration</li></strong>
            <li>Live View</li>
            <li>Access From Mobile</li>
            <li>Download Recorded Video</li>
            <li>Online Storage</li></ul>
          </p>
          <!-- Show this subscribe button if user already login -->
          <?php
            if((Yii::app()->user->isGuest)){
              echo '
              <a href="#register" class="btn btn-subscribe" id="subs-bronze">
                SUBSCRIBE
              </a>';
            }
            else if(!Yii::app()->user->isGuest && $model->OrderID == null){
              echo '
              <a href="#register" class="btn btn-subscribe" id="subs-bronze" onclick="gotoPayment(1);">
                SUBSCRIBE
              </a>';
            }
            else if($model->OrderID != null && $package->PackageName == "Bronze"){
              echo '<span style="color:red;">SUBSCRIBED</span>';
            }
          ?>
        </div>
      </div>
      <!-- Second package -->
      <div class="col-md-4 text-center">
        <div class="package-container">
          <h2 class="text-center" style="color: silver;">Silver</h2>
          <h3 class="text-center">RM 20</h3>/month
          <p class="text-center h3">
            <ul><li><strong>2 Unit Camera</li>
            <li>500 MB Storage</li>
            <li>15 Days Recording Duration</li></strong>
            <li>Live View</li>
            <li>Access From Mobile</li>
            <li>Download Recorded Video</li>
            <li>Online Storage</li></ul>
          </p>
          <!-- Show this subscribe button if user already login -->
          <?php
            if((Yii::app()->user->isGuest)){
              echo '
              <a href="#register" class="btn btn-subscribe" id="subs-silver">
                SUBSCRIBE
              </a>';
            }
            else if(!Yii::app()->user->isGuest && $model->OrderID == null){
              echo '
              <a href="#register" class="btn btn-subscribe" id="subs-silver" onclick="gotoPayment(2);">
                SUBSCRIBE
              </a>';
            }
            else if($model->OrderID != null && $package->PackageName == "Silver"){
              echo '<span style="color:red;">SUBSCRIBED</span>';
            }
          ?>
        </div>
      </div>
      <!-- Third package -->
      <div class="col-md-4 text-center">
        <div class="package-container">
          <h2 class="text-center" style="color: gold;">Gold</h2>
          <h3 class="text-center">RM 40</h3>/month
          <p class="text-center h3">
            <ul><li><strong>4 Unit Camera</li>
            <li>1000 MB Storage</li>
            <li>30 Days Recording Duration</li></strong>
            <li>Live View</li>
            <li>Access From Mobile</li>
            <li>Download Recorded Video</li>
            <li>Online Storage</li></ul>
          </p>
          <!-- Show this subscribe button if user already login -->
          <?php
            if((Yii::app()->user->isGuest)){
              echo '
              <a href="#register" class="btn btn-subscribe" id="subs-gold">
                SUBSCRIBE
              </a>';
            }
            else if(!Yii::app()->user->isGuest && $model->OrderID == null){
              echo '
              <a href="#register" class="btn btn-subscribe" id="subs-gold" onclick="gotoPayment(3);">
                SUBSCRIBE
              </a>';
            }
            else if($model->OrderID != null && $package->PackageName == "Gold"){
              echo '<span style="color:red;">SUBSCRIBED</span>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- NB: if user already subscribe one of the package, update the profile card
       and remove all the subscribe button and replace it with label 'subscrie' on
       their subscribed package only (follow the UI design on invision) -->
  <!-- End of Packages section -->

  <!-- Start Register section -->
  <?php
    if(Yii::app()->user->isGuest){
      if($model->hasErrors()){
        echo "
        <script>
          var bottomPosition = $(document).height();
          $(document).ready(function () {
          window.scrollTo(0,bottomPosition); // scrollTo(x,y)
          });
        </script>";
      }
  ?>
  <div class="container-fluid register-bg" id="register">
    <div class="register-top-layer"></div>

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Register now!</h1>
        <h3 class="text-center" style="color:red;"><?php echo $form->errorSummary($model); ?></h3>
      </div>
    </div>
    <div id="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'ind-user-register-form',
        'enableClientValidation'=>true,
            'clientOptions'=>array(
              'validateOnSubmit'=>true,
              ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
    )); ?>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 register-container text-center">
        <div class="row">
          <div class="input-group col-md-12">
            <?php echo $form->textField($model,'FullName', array('class'=>'form-control register-input', 'id'=>'register-name', 'required'=>'true')); ?>
            <?php echo $form->labelEx($model,'FullName'); ?>
            <?php echo $form->error($model,'FullName'); ?>
            <!-- <input type="text" class="form-control register-input" id="register-name" required/>-->
          </div>
        </div>

        <div class="row">
          <div class="input-group col-md-12">
            <?php echo $form->textField($model,'Username', array('class'=>'form-control register-input', 'id'=>'register-username', 'required'=>'true')); ?>
            <?php echo $form->labelEx($model,'Username'); ?>
            <?php echo $form->error($model,'Username'); ?>
            <!-- <input type="text" class="form-control register-input" id="register-username" required/>
            <label>Username</label> -->
          </div>
        </div>

        <div class="row">
          <div class="input-group col-md-12">
            <?php echo $form->emailField($model,'Email', array('class'=>'form-control register-input', 'id'=>'register-email', 'required'=>'true')); ?>
            <?php echo $form->labelEx($model,'Email'); ?>
            <?php echo $form->error($model,'Email'); ?>
            <!-- <input type="text" class="form-control register-input" id="register-email" required/>
            <label>Email</label> -->
          </div>
        </div>

        <div class="row">
          <div class="input-group col-md-12">
            <?php echo $form->passwordField($model,'Password', array('class'=>'form-control register-input', 'id'=>'register-password', 'required'=>'true')); ?>
            <?php echo $form->labelEx($model,'Password'); ?>
            <?php echo $form->error($model,'Password'); ?>
            <!-- <input type="password" class="form-control register-input" id="register-password" required/>
            <label>Password</label> -->
          </div>
        </div>

        <div class="row">
          <div class="input-group col-md-12">
            <?php echo $form->textField($model,'Address', array('class'=>'form-control register-input', 'id'=>'register-address', 'required'=>'true')); ?>
            <?php echo $form->labelEx($model,'Address'); ?>
            <?php echo $form->error($model,'Address'); ?>
            <!-- <input type="text" class="form-control register-input" id="register-address" required/>
            <label>Address</label> -->
          </div>
        </div>

        <button class="btn btn-register">Register</button>
        <?php $this->endWidget(); ?>
  </div>
  <?php
  }
  ?>
  </div>
  <!-- End of Register section -->
<script>

$(document).on('click', 'a', function(event){
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 700);
});

function gotoPayment(id){
  window.location = "index.php?r=site/pay&PackageID=" + id;
}

function register(){
  window.location = "#register";
}

function logout(){
  window.location = "index.php?r=site/logout";
}

function editProfile(){
  window.location = "index.php?r=site/editProfile&id=<?php echo $model->UserID; ?>";
}

function monitoring(){
  window.location = "index.php?r=site/monitoring&id=<?php echo $model->UserID; ?>";
}

$('#subs-bronze').click(function() {
     $('#register-name').focus();
});

$('#subs-silver').click(function() {
     $('#register-name').focus();
});

$('#subs-gold').click(function() {
     $('#register-name').focus();
});

</script>