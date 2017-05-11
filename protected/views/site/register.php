<?php
/* @var $this IndUserController */
/* @var $model IndUser */
/* @var $form CActiveForm */
?>
</div>
<div class="container-fluid">
    <div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'ind-user-register-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
    )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'Username'); ?>
            <?php echo $form->textField($model,'Username'); ?>
            <?php echo $form->error($model,'Username'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Password'); ?>
            <?php echo $form->passwordField($model,'Password'); ?>
            <?php echo $form->error($model,'Password'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Email'); ?>
            <?php echo $form->emailField($model,'Email'); ?>
            <?php echo $form->error($model,'Email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'FullName'); ?>
            <?php echo $form->textField($model,'FullName'); ?>
            <?php echo $form->error($model,'FullName'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Address'); ?>
            <?php echo $form->textField($model,'Address'); ?>
            <?php echo $form->error($model,'Address'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Submit'); ?>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>