<div class="container-fluid register-bg" id="register">
    <div class="register-top-layer"></div>

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Register now!</h1>
        <h3 class="text-center" style="color:red;"><?php echo $form->errorSummary($model); ?></h3>
      </div>
    </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'ind-user-register-form',
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