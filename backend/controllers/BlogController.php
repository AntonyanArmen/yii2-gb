<?php
namespace backend\controllers;

use common\models\TweetPublish;
use common\models\Tweets;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\UploadedFile;

/**
 * Blog controller
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
                        'actions' => ['logout', 'index','create-tweet','create-timestamp-tweet','delete-tweet'],
                        'allow' => true,
                        'roles' => ['@'],
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
        return $this->actionFeed();
    }

    public function actionCreateTweet()
    {
        $tweet_form = new TweetPublish();

        $post = Yii::$app->request->post('TweetPublish');
        if (count($post))
        {
            $picture = UploadedFile::getInstance($tweet_form,'image');
            $image = null;

            if($picture)
            {
                $image = TweetPublish::uploadImage($picture);
            }

            $tweet_form->text =  $post['text'];
            $tweet_form->image =  $image;

            if ($tweet_form->createTweet())
            {
                return $this->refresh();
            }
        }

        return $this->render('create-tweet',[
            'tweet_form' => $tweet_form
        ]);
    }

    public function actionCreateTimestampTweet()
    {
        $result  = null;
        if (count(Yii::$app->request->post()))
        {
            $tweet = new Tweets();
            $tweet->text = time().'';
            $tweet->user_id = Yii::$app->getUser()->id;
            $result  = $tweet->save();
        }

        return $this->render('create-timestamp-tweet',[
            'success' => $result
        ]);

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

    /**
     * Delete one tweet.
     *
     * @return mixed
     */
    public function actionDeleteTweet()
    {
        $id = (int)Yii::$app->request->get('id');
        if (is_numeric($id))
        {
            $tweet = Tweets::findOne(['id'=> $id]);
            if ($tweet)
            {
                $tweet->delete();
            }
        }

        return $this->render('feed', [
            'tweets' => Tweets::find()->all()
        ]);
    }

}
