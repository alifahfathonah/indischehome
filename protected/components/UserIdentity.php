<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// $users=array(
		// 	// username => password
		// 	'demo'=>'demo',
		// 	'admin'=>'admin',
		// );

		$users = IndUser::model()->findByAttributes(array('Username'=>$this->username));

		if($users['Username']!==$this->username)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users['Password']!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($users['Status']!=='active'){
			$this->errorCode=self::ERROR_USER_NOT_ACTIVE;
		}
		else
			$this->errorCode=self::ERROR_NONE;
			Yii::app()->session['username'] = $users['Username'];
			Yii::app()->session['role'] = $users['UserLevel'];

		return $this->errorCode;
	}
}