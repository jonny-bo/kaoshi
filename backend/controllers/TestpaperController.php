<?php

namespace backend\controllers;

use Yii;
use backend\models\Testpaper;
use backend\models\TestpaperSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Question;
use backend\models\TestpaperItem;

/**
 * TestpaperController implements the CRUD actions for Testpaper model.
 */
class TestpaperController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Testpaper models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestpaperSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testpaper model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Testpaper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Testpaper();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Testpaper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionRemove($id)
    {
        $item = TestpaperItem::findOne($id);
        $testId = $item->testId;
        $model  = $this->findModel($testId);
        $item->delete();
        $items = $model->getItems();

        foreach ($items as $seq => $item) {
            $item->seq = $seq + 1;
            $item->save();
        }

        \Yii::$app->getSession()->setFlash('success', '移除题目成功！');
        return $this->redirect(['question', 'id' => $testId, 'type' => 'select']);
    }

    public function actionOpen($id)
    {
        $model = $this->findModel($id);

        $model->status = 'open';
        $model->save();
        \Yii::$app->getSession()->setFlash('success', '考发布试成功！');

        return $this->redirect(['manage', 'id' => $id]);
    }

    public function actionClose($id)
    {
        $model = $this->findModel($id);

        $model->status = 'close';
        $model->save();
        \Yii::$app->getSession()->setFlash('success', '考发关闭成功！');

        return $this->redirect(['manage', 'id' => $id]);
    }

    public function actionManage($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', '信息保存成功！');
            return $this->redirect(['manage', 'id' => $model->id]);
        } else {
            return $this->render('manage', [
                'model' => $model,
            ]);
        }
    }

    public function actionExamset($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', '信息保存成功！');
            return $this->redirect(['examset', 'id' => $model->id]);
        } else {
            return $this->render('examset', [
                'model' => $model,
            ]);
        }
    }

    public function actionQuestion($id, $type = 'rand')
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->getIsPost()) {
            if ($type == 'rand') {
                $items  = TestpaperItem::find()->where(['testId' => $id])->all();
                foreach ($items as $item) {
                    $item->delete();
                }
                $counts = Yii::$app->request->post('counts');
                $scores = Yii::$app->request->post('scores');
                $seq = 0;
                foreach ($counts as $key => $value) {
                    if ($model->getQuestionCount($key) < $value) {
                        \Yii::$app->getSession()->setFlash('danger', '题库数量不足！');
                         break;
                    }

                    $questions = Question::find()->where(['type' => $key, 'parentId' => 0])->all();
                    if ($value == 0) {
                        $rand_keys = array();
                    } elseif ($value == 1) {
                        $rand_key = array_rand($questions, $value);
                        $rand_keys = array($rand_key);
                    } else {
                        $rand_keys = array_rand($questions, $value);
                    }
                    
                    foreach ($rand_keys as $randKey) {
                        $item = new TestpaperItem();
                        $item->testId = $id;
                        $item->seq = $seq+1;
                        $item->questionId = $questions[$randKey]->id;
                        $item->questionType = $key;
                        $item->parentId = $questions[$randKey]->parentId;
                        $item->score = $scores[$key];
                        if ($key == 'choice') {
                            $item->missScore = $scores['missScores'];
                        } else {
                            $item->missScore = 0;
                        }
                        
                        $item->save();
                        $seq ++;
                    }
                }

                \Yii::$app->getSession()->setFlash('success', '题库随机完成！');
            }

            $model->load(Yii::$app->request->post());
            $model->save();
            
            return $this->redirect(['question', 'id' => $model->id, 'type' => $type]);
        } else {
            return $this->render('question', [
                'model' => $model,
                'type' => $type
            ]);
        }
    }

    /**
     * Deletes an existing Testpaper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Testpaper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Testpaper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Testpaper::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
