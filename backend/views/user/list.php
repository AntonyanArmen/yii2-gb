<?php
/* @var $this \yii\web\View */
/* @var $users \common\models\User[] */

use common\models\User;

$this->title = 'Список пользователей';
$this->registerJs(<<<JS
    $('.delete-user').click(
        function(e) {
          if (!confirm('Вы уверены?'))
              {
                  e.preventDefault();
              }
        }
    );
JS
);
?>

<div class="row">

    <div class="col-sm-12">
        <div class="row">
            <?php foreach ($users as $u) :?>
                <div class="col-sm-4">
                    <section class="blog-post">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="blog-post-meta">
                                    <span class="label label-light <?= $u->isAdmin()? "label-danger": "label-info" ?>"><?= $u->category->description?></span>
                                </div>
                                <div class="blog-post-content">
                                    <h2 class="blog-post-title"><?= $u->username;?></h2>
                                    <p><span class="label label-default"><i class="fa fa-envelope"></i></span> <?= $u->email?></p>
                                    <a class="btn btn-info" href="post-image.html"><i class="fa fa-eye"></i> Details</a>
                                    <?php if (!$u->isAdmin()) :?>
                                        <a class="btn btn-danger delete-user" href="<?= \yii\helpers\Url::to(['user/delete','id' => $u->id])?>">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </section><!-- /.blog-post -->
                </div>
            <?php endforeach;?>
        </div>

    </div><!-- /.blog-main -->

</div><!-- /.row -->