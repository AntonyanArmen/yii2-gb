<?php
namespace backend\controllers;

use common\models\Tweets;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class BlogController extends Controller
{
    /**
     * @inheritdoc
     */

    public $layout = 'cube.php';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create-tweet', 'index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create-timestamp-tweet', 'index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index');
        return $this->render('create-tweet',[
            'tweet' => new Tweets()
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCreateTweet()
    {
        $tweet = new Tweets();

        $post = Yii::$app->request->post('Tweets');
        if (count($post))
        {
            $tweet->text = $post['text'];

            if ($tweet->save())
            {
                $tweet = new Tweets();
            }
        }

        return $this->render('create-tweet',[
            'tweet' => $tweet
        ]);
    }

    public function actionCreateTimestampTweet()
    {
        $result  = null;
        if (count(Yii::$app->request->post()))
        {
            $tweet = new Tweets();
            $tweet->text = time().'';
            $result  = $tweet->save();
        }

        return $this->render('create-timestamp-tweet',[
            'success' => $result
        ]);

    }
}
