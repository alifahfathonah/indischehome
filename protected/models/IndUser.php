<?php

/**
 * This is the model class for table "ind_user".
 *
 * The followings are the available columns in table 'ind_user':
 * @property integer $UserID
 * @property integer $OrderID
 * @property string $Username
 * @property string $Password
 * @property string $Email
 * @property string $FullName
 * @property string $Address
 * @property string $UserLevel
 * @property string $Status
 * @property string $ActivationKey
 * @property string $Joined
 */
class IndUser extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    
    public function tableName()
    {
        return 'ind_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Username, Password, Email, FullName, Address, UserLevel, Status, Joined', 'required', 'on'=>'register'),
            array('OrderID', 'numerical', 'integerOnly'=>true),
            array('Username, Password, Email, FullName, Address, Status, ActivationKey, ProfilePicture', 'length', 'max'=>255),
            array('UserLevel', 'length', 'max'=>5),
            array('Email', 'email'),
            array('Username', 'unique', 'message'=>'This username is already taken'),
            array('Email', 'unique', 'message'=>'This email is already taken'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('UserID, OrderID, Username, Email, FullName, Address, UserLevel, Status, ActivationKey, Joined', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'UserID' => 'User',
            'OrderID' => 'Order',
            'Username' => 'Username',
            'Password' => 'Password',
            'Email' => 'Email',
            'FullName' => 'Full Name',
            'Address' => 'Address',
            'UserLevel' => 'User Level',
            'Status' => 'Status',
            'ActivationKey' => 'Activation Key',
            'Joined' => 'Joined',

            'newPassword'=>'New Password',
            'oldPassword'=>'Old Password',
            'confPassword'=>'Confirm Password',
            'fullName'=>'Full Name',
            'profilePicture'=>'Profile Picture',
            'address'=>"Address",
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('UserID',$this->UserID);
        $criteria->compare('OrderID',$this->OrderID);
        $criteria->compare('Username',$this->Username,true);
        $criteria->compare('Password',$this->Password,true);
        $criteria->compare('Email',$this->Email,true);
        $criteria->compare('FullName',$this->FullName,true);
        $criteria->compare('Address',$this->Address,true);
        $criteria->compare('UserLevel',$this->UserLevel,true);
        $criteria->compare('Status',$this->Status,true);
        $criteria->compare('ActivationKey',$this->ActivationKey,true);
        $criteria->compare('Joined',$this->Joined,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return IndUser the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}