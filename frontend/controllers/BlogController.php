<?php
namespace frontend\controllers;

use common\models\Tweets;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class BlogController extends Controller
{
    /**
     * @inheritdoc
     */

    public $layout = 'blog.php';

    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays feed page.
     *
     * @return mixed
     */
    public function actionFeed()
    {
        return $this->render('feed', [
            'tweets' => Tweets::find()->all()
        ]);
    }
}
