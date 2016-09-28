<?php
/* @var $success boolean or null */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php
$form = ActiveForm::begin([
    'id' => 'timestamp-tweet-form',
    'options' => ['class' => 'form-horizontal']
]);
?>
<?php
    if (!is_null($success))
    {
        if ($success)
        {
            ?>
            <div class="alert alert-success">
                Tweet added!
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="alert alert-info">
                Something happend...
            </div>
            <?php
        }
    }
?>
<?=  Html::submitButton('Add new timestamp tweet',['class' => 'btn btn-primary'])?>
<?php
ActiveForm::end();
?>
