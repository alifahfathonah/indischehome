<?php
/* @var $this IndUserController */
/* @var $model IndUser */
/* @var $form CActiveForm */
?>
</div>
<div class="container-fluid" id="about-us">
    <div class="row">
      <div class="col-md-12">
        <img id="down-arrow" class="img-responsive center-block" src="assets/angle-arrow-down.svg" />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 company-detail">
        <center>
            <div class="form">

            <?php if(Yii::app()->user->hasFlash('success')):?>
                <div class="alert">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php endif; ?>

            <?php $form=$this->beginWidget('CActiveForm', array(
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // See class documentation of CActiveForm for details on this,
                // you need to use the performAjaxValidation()-method described there.
                'enableClientValidation' => true,
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )); ?>

                <p class="note">Fields with <span class="required">*</span> are required.</p>

                <?php echo $form->errorSummary($model); ?>

                <div class="row">
                    <?php echo $form->labelEx($model,'New Password'); ?>
                    <?php echo $form->passwordField($model,'newPassword'); ?>
                    <?php echo $form->error($model,'newPassword'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'Confirm Password'); ?>
                    <?php echo $form->passwordField($model,'confPassword'); ?>
                    <?php echo $form->error($model,'confPassword'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'FullName'); ?>
                    <?php echo $form->textField($model,'fullName'); ?>
                    <?php echo $form->error($model,'fullName'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'Address'); ?>
                    <?php echo $form->textField($model,'address'); ?>
                    <?php echo $form->error($model,'address'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'Old Password <span class="required">*</span>'); ?>
                    <?php echo $form->passwordField($model,'oldPassword'); ?>
                    <?php echo $form->error($model,'oldPassword'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'Upload Picture'); ?>
                    <?php echo $form->fileField($model,'profilePicture'); ?>
                    <?php echo $form->error($model,'profilePicture'); ?>
                </div>

                <div class="row buttons">
                    <button class="btn btn-custom" name="submit">Save Changes</button>
                    <input type='button' class="btn btn-custom" onclick="back();" value="Back">
                </div>

            <?php $this->endWidget(); ?>

            </div><!-- form -->
        </center>
      </div>
    </div>
</div>

<script type="text/javascript">
    function back(){
        window.location = "index.php";
    }

    // Get all elements with class="closebtn"
    var close = document.getElementsByClassName("closebtn");
    var i;

    // Loop through all close buttons
    for (i = 0; i < close.length; i++) {
        // When someone clicks on a close button
        close[i].onclick = function(){

            // Get the parent of <span class="closebtn"> (<div class="alert">)
            var div = this.parentElement;

            // Set the opacity of div to 0 (transparent)
            div.style.opacity = "0";

            // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
    }
</script>