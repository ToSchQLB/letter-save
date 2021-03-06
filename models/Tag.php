<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property string $color
 *
 * @property DocumentHasTag[] $documentHasTags
 * @property Document[] $documents
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'color'], 'string', 'max' => 20],
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
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentHasTags()
    {
        return $this->hasMany(DocumentHasTag::className(), ['tag_id' => 'id']);
    }

	public function getDocuments()
	{
		return $this->hasMany(Document::className(),['id' => 'document_id'])->via('documentHasTags');
    }
}
