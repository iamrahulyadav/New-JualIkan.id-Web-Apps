<?php

namespace backend\controllers;

use Yii;
use common\models\UserPengguna;
use backend\models\UserPenggunaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SaldoHistory;
use yii\web\UploadedFile;
use backend\models\Cart;
use yii\data\ActiveDataProvider;

/**
 * UserPenggunaController implements the CRUD actions for UserPengguna model.
 */
class UserPenggunaController extends Controller
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
     * Lists all UserPengguna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserPenggunaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSaldo($id)
    {
        $query = SaldoHistory::find()->where(['saldo_user_id' => $id])->andWhere(['saldo_user_level' => 1]);
        $count = $query->count();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // echo count($query);

        return $this->render('saldo', [
            // 'searchModel' => $searchModel,
            'model' => $this->findModel($id),
            'dataProvider' => $provider,
        ]);
    }

    public function actionCart($id)
    {
        $query = Cart::find()->where(['cart_user_id' => $id]);
        $count = count($query);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // echo count($query);

        return $this->render('cart', [
            // 'searchModel' => $searchModel,
            'model' => $this->findModel($id),
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single UserPengguna model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionTopUp($id)
    {
        $topUpModel = new SaldoHistory();
        $userModel = UserPengguna::find()->where(['user_id' => $id])->one();

        if ($topUpModel->load(Yii::$app->request->post())) {
            //setting saldo history
            $topUpModel->saldo_history_title = "Admin Top-Up";
            $topUpModel->saldo_user_id = $userModel->user_id;
            $topUpModel->saldo_user_level = 1;

            $userModel->user_saldo = $userModel->user_saldo + $topUpModel->saldo_value;

            if ($userModel->save(false) && $topUpModel->save()) {
                return $this->redirect(['view', 'id' => $userModel->user_id]);
            }
        }

        return $this->render('top-up', [
            'model' => $userModel,
            'topUpModel' => $topUpModel,
        ]);
    }

    /**
     * Creates a new UserPengguna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserPengguna();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'user_image');
            if ($image == null) {
                $model->user_image = "frontend/web/img/user_default.png";
            }else {
                $model->user_image = 'frontend/web/img/' . $image->baseName. '.' . $image->extension;
                $image->saveAs("../../".$model->user_image);
            }
            //setting saldo to null;
            $model->user_saldo = 0;
            //setting device id to null
            $model->user_device_id = "";
            if ($model->save()) {
              return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserPengguna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image_before = $model->user_image;

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'user_image');
            if ($image == null) {
                $model->user_image = $image_before;
            }else {
                $model->user_image = 'img/' . $image->baseName. '.' . $image->extension;
                $image->saveAs("../../frontend/web/".$model->user_image);
            }
            //setting saldo to null;
            $model->user_saldo = 0;
            //setting device id to null
            $model->user_device_id = "";
            if ($model->save()) {
              return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserPengguna model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserPengguna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserPengguna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserPengguna::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
