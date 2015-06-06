<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Lang;
/* @var $this yii\web\View */
/* @var $model backend\posts\models\Posts */
/* @var $form yii\widgets\ActiveForm */
$langs = Lang::find()->all();
?>

<div class="posts-form">
    <?php if(!$model->isNewRecord){?>
        <ul class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                Language <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php foreach($langs as $one){?>
                    <li role="presentation"><?php echo  Html::a($one->name,['update','id'=> $model->parrent_id,'lang' => $one->url]);?></li>
                <?php }?>
            </ul>
        </ul>

    <?php }?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
