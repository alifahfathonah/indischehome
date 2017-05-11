<?php

/**
 * This is the model class for table "ind_order".
 *
 * The followings are the available columns in table 'ind_order':
 * @property integer $OrderID
 * @property integer $PackageID
 * @property integer $PaymentID
 * @property string $DateCreated
 * @property string $DateExpired
 */
class IndOrder extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ind_order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrderID, PackageID, PaymentID, DateCreated, DateExpired', 'required'),
            array('OrderID, PackageID, PaymentID', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('OrderID, PackageID, PaymentID, DateCreated, DateExpired', 'safe', 'on'=>'search'),
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
            'OrderID' => 'Order',
            'PackageID' => 'Package',
            'PaymentID' => 'Payment',
            'DateCreated' => 'Date Created',
            'DateExpired' => 'Date Expired',
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

        $criteria->compare('OrderID',$this->OrderID);
        $criteria->compare('PackageID',$this->PackageID);
        $criteria->compare('PaymentID',$this->PaymentID);
        $criteria->compare('DateCreated',$this->DateCreated,true);
        $criteria->compare('DateExpired',$this->DateExpired,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return IndOrder the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}