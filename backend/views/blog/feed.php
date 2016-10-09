<?php
/* @var $this \yii\web\View */
/* @var $tweets \common\models\Tweets[] */

use common\models\Tweets;

$this->title = 'Feed line';
$this->registerJs(<<<JS
    $('.delete-tweet').click(
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
            <?php foreach ($tweets as $t) :?>
                <?php $tweet_content = $t->getContent(); ?>
                <div class="col-sm-4">
                    <section class="blog-post">
                        <div class="panel panel-default">
                            <?php if($tweet_content->mode & Tweets::TWEET_MODE_IMAGE) :?>
                                <img src="/img/placeholder520x150.png" class="img-responsive"/>
                            <?php endif;?>
                            <div class="panel-body">
                                <div class="blog-post-meta">
                                    <span class="label label-light label-primary">Автор : <?= $tweet_content->published_by?></span>
                                    <p class="blog-post-date pull-right"><?= date("d M Y в H:i", strtotime($tweet_content->publish_timestamp))?></p>
                                </div>
                                <div class="blog-post-content">
                                    <?php if($tweet_content->mode & Tweets::TWEET_MODE_TEXT) :?>
                                        <a href="post-image.html">
                                            <h2 class="blog-post-title"><?= $tweet_content->text;?></h2>
                                        </a>
                                    <?php endif;?>
                                    <br>
                                    <a class="btn btn-info" href="post-image.html">Read more</a>
                                    <a class="btn btn-danger pull-right delete-tweet" href="<?= \yii\helpers\Url::to(['delete-tweet','id' => $tweet_content->id])?>">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section><!-- /.blog-post -->
                </div>
            <?php endforeach;?>
        </div>

        <nav>
            <ul class="pager">
                <li><a class="withripple" href="#">Previous</a></li>
                <li><a class="withripple" href="#">Next</a></li>
            </ul>
        </nav>

    </div><!-- /.blog-main -->

</div><!-- /.row -->