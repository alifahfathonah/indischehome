<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		// IF USER IS LOGGED IN //
		if(!Yii::app()->user->isGuest){
			$model = IndUser::model()->findByAttributes(
				array("Username"=>Yii::app()->user->getId()
				));
			$this->layout = 'column1_indischehome';
			if($model->OrderID == null){
				return $this->render('index', array(
					'model'=>$model
				));
			}
			else{
				$order = IndOrder::model()->findByPk($model->OrderID);
				$package = IndPackage::model()->findByPk($order->PackageID);
				return $this->render('index', array(
					'model'=>$model,
					'package'=>$package,
					'order'=>$order
				));
			}
		}

		/*	THIS IS BEGIN OF LOGIN PART	*/
		$loginModel=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($loginModel);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$loginModel->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($loginModel->validate() && $loginModel->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		/* END OF LOGIN PART */

		/*	THIS IS BEGIN OF REGISTER PART	*/
		$model=new IndUser;
		$model->setScenario("register");
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if(isset($_POST['IndUser']))
        {
        	$model->attributes=$_POST['IndUser'];
            $model->ActivationKey = sha1(mt_rand(10000, 99999).time().$model->Email);
            $model->Status = "inactive";
            $model->UserLevel = "user";
            $model->Joined = date('Y-m-d');
            $activation_url = $this->createAbsoluteUrl('site/validateKey', array('key'=>$model->ActivationKey, 'username'=>$model->Username));
        	if($model->validate()){
	            if($model->save()){
	            	$subject = "Indische Home - Activation URL Email";
				    // Plain text content
				    $content = "<h3>Welcome Aboard ". $model->FullName .",</h3>Thanks for joining with Indische Home.<br>However your account is not activated yet. Hence, please kindly to do a confirmation through this link: <a href='". $activation_url ."'>Click Here</a><br><br>Thank You.<br><br>Sincerely Yours,<br>Indische Home";
				 
				    // New message
				    $mail = new YiiMailer();
					//$mail->clearLayout();//if layout is already set in config
					$mail->setFrom('admin@indischehome.com', 'Indische Home');
					$mail->setTo($model->Email);
					$mail->setSubject($subject);
					$mail->setBody($content);
					$mail->send();
				 
				    // Send mail
					if (!$mail)
					    throw new CHttpException(500, 'something went horrible wrong');
					else
					    // set flash if needed here
					    $this->redirect('index.php?r=site/confirmRegister');
				}

	                $this->redirect(array('view','id'=>$model->UserID));
            }
        }
		/* END OF REGISTER PART */

		// DISPLAY PART //
		$this->layout = 'column1_indischehome';
		$this->render('index', array('loginModel'=>$loginModel, 'model'=>$model));
	}

	public function actionEditProfile($id){
		$user = new IndUser;
		$user = IndUser::model()->findByPk($id);
		//$user->setScenario('editProfile');

		$model = new EditProfile;

		$this->layout='column1_indischehome';
		
		if(Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && $user->Username != Yii::app()->user->getId())){
			$this->render("error2");
		}
		else{
			if(isset($_POST['EditProfile'])){
				$model->attributes = $_POST['EditProfile'];
				$uploadedFile=CUploadedFile::getInstance($model,'profilePicture');
	            $fileName = "{$uploadedFile}";  // random number + file name
	            $model->profilePicture = $fileName;
	            $valid = $model->validate();

	            if($valid){
	            	$_POST['EditProfile']['newPassword']!=""?$user->Password = $_POST['EditProfile']['newPassword']:$user->Password=$user->Password;
	            	$_POST['EditProfile']['fullName']!=""?$user->FullName = $_POST['EditProfile']['fullName']:$user->FullName=$user->FullName;
	            	$_POST['EditProfile']['profilePicture']!=""?$user->ProfilePicture = $_POST['EditProfile']['profilePicture']:$user->ProfilePicture=$user->ProfilePicture;
	            	$_POST['EditProfile']['address']!=""?$user->Address = $_POST['EditProfile']['address']:$user->ProfilePicture=$user->ProfilePicture;


	            	if($user->save()){
	            		Yii::app()->user->setFlash('success', "Profile Has Been Updated!");
	            		$this->redirect(array('editProfile', 'id'=>$user->UserID));
	            	}
	            }
			}
			$this->render('editProfile', array('model'=>$model));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	// public function actionLogin()
	// {
	// 	$model=new LoginForm;

	// 	// if it is ajax validation request
	// 	if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	// 	{
	// 		echo CActiveForm::validate($model);
	// 		Yii::app()->end();
	// 	}

	// 	// collect user input data
	// 	if(isset($_POST['LoginForm']))
	// 	{
	// 		$model->attributes=$_POST['LoginForm'];
	// 		// validate user input and redirect to the previous page if valid
	// 		if($model->validate() && $model->login())
	// 			$this->redirect(Yii::app()->user->returnUrl);
	// 	}
	// 	// display the login form
	// 	$this->render('login',array('model'=>$model));
	// }

	public function actionConfirmRegister(){
		$this->render("confirmRegister");
	}

	public function actionRegister(){
		$model=new IndUser;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['IndUser']))
        {
            $model->attributes=$_POST['IndUser'];
            $model->ActivationKey = sha1(mt_rand(10000, 99999).time().$model->Email);
            $model->Status = "inactive";
            $model->UserLevel = "user";
            $model->Joined = date('Y-m-d');
            $activation_url = $this->createAbsoluteUrl('site/validateKey', array('key'=>$model->ActivationKey, 'username'=>$model->Username));
            if($model->save()){
            	$subject = "Indische Home - Activation URL Email";
			    // Plain text content
			    $content = "<h3>Welcome Aboard ". $model->FullName .",</h3>Thanks for joining with Indische Home.<br>However your account is not activated yet. Hence, please kindly to do a confirmation through this link: <a href='". $activation_url ."'>Click Here</a><br><br>Thank You.<br><br>Sincerely Yours,<br>Indische Home";
			 
			    // New message
			    $mail = new YiiMailer();
				//$mail->clearLayout();//if layout is already set in config
				$mail->setFrom('admin@indischehome.com', 'Indische Home');
				$mail->setTo($model->Email);
				$mail->setSubject($subject);
				$mail->setBody($content);
				$mail->send();
			 
			    // Send mail
				if (!$mail)
				    throw new CHttpException(500, 'something went horrible wrong');
				else
				    // set flash if needed here
				    $this->redirect('index.php?r=site/confirmRegister');
			}

                //$this->redirect(array('view','id'=>$model->UserID));
        }

        $this->layout = 'column1_indischehome';
        $this->render('register',array(
            'model'=>$model,
        ));
	}

	public function actionValidateKey(){
		$key = Yii::app()->request->getQuery('key');
		$username = Yii::app()->request->getQuery('username');
		$user = IndUser::model()->findByAttributes(array('ActivationKey'=>$key, 'Username'=>$username));
		//$row = IndUser::model()->findAll(array("condition"=>"ActivationKey = '".$key."' AND Username = '".$username."'"));
		//$Pk = $row[0]['UserID'];
		//$user = $row[0]['Username'];

		//$updatedUser = IndUser::model()->findByPk($Pk);
		$user->Status = "active";
		$user->save();

		echo "<script>alert('Your Indische Home account has been activated, you can now log in using your username and password. Thank you.'); window.location='".Yii::app()->homeUrl."';</script>";

		//$this->redirect(Yii::app()->homeUrl);
	}

	public function actionMonitoring($id){
		$camera = IndCamera::model()->findAll();
		$user = IndUser::model()->findByPk($id);
		$order = IndOrder::model()->findByAttributes(array("OrderID"=>$user->OrderID));
		$package = IndPackage::model()->findByAttributes(array("PackageID"=>$order->PackageID));
		
		if(Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && $user->OrderID == null) || (!Yii::app()->user->isGuest && $user->Username != Yii::app()->user->getId())){
			$this->layout = "column1_indischehome";
			$this->render('error2');
		}
		else{
			$this->layout = "column2_indischehome";
			$this->render('monitoring', array(
				'user'=>$user,
				'order'=>$order,
				'package'=>$package,
				'camera'=>$camera,
			));
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}