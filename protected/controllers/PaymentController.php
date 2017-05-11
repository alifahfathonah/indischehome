<?php

class PaymentController extends Controller{
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex(){
		return $this->render('index');
	}
}

?>