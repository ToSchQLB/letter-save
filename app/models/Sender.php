<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "sender".
 *
 * @property integer $id
 * @property string $name
 * @property string $adress1
 * @property string $adress2
 * @property string $zip
 * @property string $town
 * @property string $state
 * @property string $country
 * @property string $logo
 * @property string $css_class
 *
 * @property Document[] $documents
 * @property string fullAddress
 */
class Sender extends \yii\db\ActiveRecord
{
    const LOGO_PATH = '/img/sender/logo/';

    public $logoUpload;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'adress1', 'adress2', 'town'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 5],
            [['state', 'country'], 'string', 'max' => 100],
            [['css_class'],'string','max' => 40],
            [['logo'], 'string'],
            [['logoUpload'], 'image', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'adress1' => Yii::t('app', 'Adress1'),
            'adress2' => Yii::t('app', 'Adress2'),
            'zip' => Yii::t('app', 'Zip'),
            'town' => Yii::t('app', 'Town'),
            'state' => Yii::t('app', 'State'),
            'country' => Yii::t('app', 'Country'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['sender_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getFullAddress()
    {
        $address = $this->name.'<br>'.$this->adress1.'<br>'.$this->zip.' '.$this->town;

        return $address;
    }

    public function beforeSave($insert)
    {
        if(!empty($this->logoUpload)){
            $filename = uniqid().'.'.$this->logoUpload->extension;
            $this->logoUpload->saveAs('.'.self::LOGO_PATH.$filename, true);
            $this->logo = $filename;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function beforeValidate(){
        $this->logoUpload = UploadedFile::getInstance($this, 'logoUpload');
        return true;
    }
}
