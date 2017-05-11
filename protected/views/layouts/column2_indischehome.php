<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?> - Monitoring Page</title>
</head>

<body>

	<?php echo $content; ?>
  <!-- Start Footer section -->
  <div class="container-fluid monitoring" id="footer">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <p class="text-right align-middle">
          Contact Us
          <a href="#"><img class="contact-img" src="assets/googleplus-logo.svg" /></a>
          <a href="#"><img class="contact-img" src="assets/facebook-logo.svg" /></a>
          <a href="#"><img class="contact-img" src="assets/twitter-logo-silhouette.svg" /></a>
          <a href="#"><img class="contact-img" src="assets/linkedin-button.svg" /></a>
          <a href="#"><img class="contact-img" src="assets/pinterest.svg" /></a>
        </p>
      </div>
    </div>

  </div>
  <!-- End of Footer section -->
</body>
</html>