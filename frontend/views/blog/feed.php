<?php
/* @var $this \yii\web\View */
/* @var $tweets \common\models\Tweets[] */

use common\models\Tweets;

$this->title = 'Feed line';
?>

<div class="row">

    <div class="col-sm-8 blog-main">
        <div class="row">
            <?php foreach ($tweets as $t) :?>
                <?php $tweet_content = $t->getContent(); ?>
                <div class="col-sm-6">
                    <section class="blog-post">
                        <div class="panel panel-default">
                            <?php //var_dump($tweet_content->mode); ?>
                            <?php if($tweet_content->mode & Tweets::TWEET_MODE_IMAGE) :?>
                                <img src="<?= $tweet_content->image;?>" class="img-responsive"/>
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
                                    <p>Some text</p>
                                    <a class="btn btn-info" href="post-image.html">Read more</a>
                                    <a class="blog-post-share pull-right" href="#">
                                        <i class="material-icons">&#xE80D;</i>
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

    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

        <div class="sidebar-module">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </div><!-- /.sidebar-module -->

        <div class="sidebar-module">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>About</h4>
                    <p>Donec ut libero sed arcu vehicula ultricies a non tortor. <em>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</em> Aenean ut gravida lorem.</p>
                </div>
            </div>
        </div><!-- /.sidebar-module -->
    </div><!-- /.blog-sidebar -->
</div><!-- /.row -->