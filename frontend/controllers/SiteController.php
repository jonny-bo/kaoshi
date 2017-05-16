<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Testpaper;
use backend\models\TestpaperItemResult;
use backend\models\TestpaperResult;
use backend\models\Question;
use backend\models\TestpaperItem;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        //如果未登录，则直接返回
        if (Yii::$app->user->isGuest){
            return $this->redirect(['/user/security/login']);
        }
        return true;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $testPaperes = Testpaper::find()->where(['status' => 'open'])->all();

        return $this->render('index', [
            'testPaperes' => $testPaperes
        ]);
    }

    public function actionExam($id)
    {
        $this->enableCsrfValidation = false;
        $testpaper =  Testpaper::findOne($id);

        $testpaperResult = TestpaperResult::find()->where(['userId' => Yii::$app->user->id, 'testId' => $id])->one();

        if ($testpaperResult) {
            return $this->render('message', [
                'testpaper' => $testpaper,
                'itemResult' => $testpaperResult
            ]);
        }
        $beginTime = time();

        if (Yii::$app->request->getIsPost()) {
            $anwers = Yii::$app->request->post();
            $beginTime = $anwers['beginTime'];
            unset($anwers['_csrf-frontend']);
            unset($anwers['beginTime']);

            $testpaperResult = new TestpaperResult();
            $testpaperResult->paperName = $testpaper->name;
            $testpaperResult->testId = $id;
            $testpaperResult->userId = Yii::$app->user->id;
            $testpaperResult->target = 'exam';
            $testpaperResult->beginTime = $beginTime;
            $testpaperResult->endTime = time();
            $testpaperResult->save();

            foreach ($anwers as $key => $value) {
                $question = TestpaperItem::find()->where(['seq' => $key, 'testId' => $id])->one();
                $itemResult = new TestpaperItemResult();
                $itemResult->testId = $id;
                $itemResult->itemId = $key;
                $itemResult->testPaperResultId = $testpaperResult->id;
                $itemResult->userId = Yii::$app->user->id;
                $itemResult->questionId = $question->id;
                $itemResult->answer = json_encode($value);
                $itemResult->save();
            }

            Yii::$app->session->setFlash('success', '试卷提交成功，请耐心等待结果！');
            return $this->goHome();
        }

        return $this->render('exam', [
            'testpaper' => $testpaper,
            'beginTime' => $beginTime
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
