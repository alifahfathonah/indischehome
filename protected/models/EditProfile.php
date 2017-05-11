<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class EditProfile extends CFormModel
{
	public $newPassword;
    public $oldPassword;
    public $confPassword;
    public $fullName;
    public $profilePicture;
    public $address;

    private $_user;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			//Start scenario edit profile//
            array('oldPassword', 'required'),
            //array('confPassword', 'compare', 'compareAttribute'=>'newPassword',),
            array('confPassword, newPassword', 'hasToBeMatched'),
            array('newPassword', 'hasToBeUnique'),
            array('profilePicture', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true,), 
            array('oldPassword', 'compareCurrentPassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'newPassword'=>'New Password',
            'oldPassword'=>'Old Password',
            'confPassword'=>'Confirm Password',
            'fullName'=>'Full Name',
            'profilePicture'=>'Profile Picture',
            'address'=>"Address",
		);
	}

	public function hasToBeUnique($attribute, $params){
		if($this->newPassword === $this->_user->Password){
			$this->addError($attribute, "New Password must be different");
		}
	}

	public function hasToBeMatched($attribute, $params){
		if($this->confPassword != $this->newPassword){
			$this->addError($attribute, "Password has to be same");
		}
	}

	//matching the old password with your existing password.
    public function compareCurrentPassword($attribute, $params){
        if ($this->oldPassword != $this->_user->Password){
            $this->addError($attribute, 'Old password is incorrect.');
        }
    }

    public function init(){
    	$this->_user = IndUser::model()->findByAttributes(array('Username'=>Yii::app()->user->getId()));
    }
}