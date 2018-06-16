<?php

namespace backend\controllers;

use Yii;
use backend\models\UserDriver;
use backend\models\UserDriverSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use common\models\SaldoHistory;
use yii\data\ActiveDataProvider;

/**
 * UserDriverController implements the CRUD actions for UserDriver model.
 */
class UserDriverController extends Controller
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
     * Lists all UserDriver models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserDriverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDriver model.
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

    /**
     * Creates a new UserDriver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserDriver();

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'driver_image');
            if ($image == null) {
              $model->driver_image = "frontend/web/img/user_default.png";
            }else {
                $model->driver_image = 'frontend/web/img/' . $image->baseName. '.' . $image->extension;
                $image->saveAs("../../".$model->driver_image);
            }
            //setting saldo to null;
            $model->driver_saldo = 0;
            //setting device id to null
            $model->driver_device_id = "";
            //setting max vehicle weight to 0
            $model->driver_vehicle_weight = 0;
            if ($model->save(false)) {
              return $this->redirect(['view', 'id' => $model->driver_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionTopUp($id)
    {
        $topUpModel = new SaldoHistory();
        $driverModel = $this->findModel($id);

        if ($topUpModel->load(Yii::$app->request->post())) {
            //setting saldo history
            $topUpModel->saldo_history_title = "Admin Top-Up";
            $topUpModel->saldo_user_id = $driverModel->driver_id;
            $topUpModel->saldo_user_level = 2;

            $driverModel->driver_saldo = $driverModel->driver_saldo + $topUpModel->saldo_value;

            if ($topUpModel->save() && $driverModel->save(false)) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
        }

        return $this->render('top-up', [
            'model' => $this->findModel($id),
            'topUpModel' => $topUpModel,
        ]);
    }

    public function actionVehicle($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save(false)) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
        }

        return $this->render('vehicle', [
            'model' => $this->findModel($id),
            // 'topUpModel' => $topUpModel,
        ]);
    }

    public function actionSaldo($id)
    {
        $query = SaldoHistory::find()->where(['saldo_user_id' => $id])->andWhere(['saldo_user_level' => 2]);
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

    /**
     * Updates an existing UserDriver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image_before = $model->driver_image;

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'driver_image');
            if ($image == null) {
                $model->driver_image = $image_before;
            }else {
                $model->driver_image = 'frontend/web/img/' . $image->baseName. '.' . $image->extension;
                $image->saveAs("../../".$model->driver_image);
            }
            if ($model->save(false)) {
              return $this->redirect(['view', 'id' => $model->driver_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserDriver model.
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
     * Finds the UserDriver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDriver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDriver::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
