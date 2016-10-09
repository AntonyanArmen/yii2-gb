<?php
/* @var $tweet_form \common\models\TweetPublish */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php
$form = ActiveForm::begin([
    'id' => 'tweet-form',
    'options' => ['class' => 'form-horizontal']
]);
?>
<?= $form->field($tweet_form,'text')->textarea()?>
<?= $form->field($tweet_form,'image')->fileInput(['accept' => 'image/*'])?>
<?=  Html::submitButton('Tweet!',['class' => 'btn btn-primary'])?>
<?php
ActiveForm::end();
?>
