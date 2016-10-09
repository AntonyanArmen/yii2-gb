<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\BlogAsset;
use yii\helpers\Html;

BlogAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Custom styles for this template -->
    <![endif]-->
</head>

<body>
<?php $this->beginBody() ?>

<div class="navbar navbar-material-blog navbar-primary navbar-absolute-top">

    <div class="navbar-image" style="background-image: url('img/technology/unsplash-6.jpg');background-position: center 40%;"></div>

    <div class="navbar-wrapper container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['blog/feed']);?>"><i class="material-icons">&#xE871;</i> Main</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="active dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Stories <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="home-fashion.html">Fashion</a></li>
                        <li><a href="home-food.html">Food</a></li>
                        <li><a href="home-music.html">Music</a></li>
                        <li><a href="home-photography.html">Photography</a></li>
                        <li><a href="home-technology.html">Technology</a></li>
                        <li><a href="home-travel.html">Travel</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (Yii::$app->user->isGuest)
                {
                    ?>
                    <li class="active dropdown">
                        <a href="#" data-target="#" class="user-menu dropdown-toggle" data-toggle="dropdown"><i class="fa fa-key"></i> Вход <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href="<?= \yii\helpers\Url::to(['signup']) ?>">Регистрация</a></li>
                            <li><a class="signin" href="<?= \yii\helpers\Url::to(['login']) ?>">Логин</a></li>

                        </ul>
                    </li>
                    <?php
                }
                else
                {
                    ?>
                    <li class="active dropdown">
                        <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Привет, <?= Yii::$app->user->identity->username ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href="<?= \yii\helpers\Url::to(['create-tweet']) ?>">Твитнуть</a></li>

                        </ul>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="container blog-content">

    <?= $content ?>

</div><!-- /.container -->

<footer class="blog-footer">

    <div id="links">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>

</footer>
<button class="material-scrolltop primary" type="button"></button>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
