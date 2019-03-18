<?php

namespace app\controllers;

use Yii;
use app\models\Warga;
use app\models\WargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\Rt;
use app\models\Rw;
use app\models\Keluarga;
use yii\helpers\ArrayHelper;
/**
 * WargaController implements the CRUD actions for Warga model.
 */
class WargaController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Warga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Warga model.
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
     * Creates a new Warga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Warga();

        $list_kk = ArrayHelper::map(Keluarga::find()->all(), 'id', 'no_kk');
        $list_rt = Rt::find()->indexBy('id')->all();
        $list_rw = Rw::find()->indexBy('id')->all();

        $data_post = Yii::$app->request->post();

        if ($data_post) {
            $model->load($data_post);
            if ($model->validate()) {
                $upload = $this->uploadFoto($model, 'path_ktp');
                
                if ($upload[0]) {
                    $model->path_ktp = $upload[1] . $upload[2];
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'list_kk' => $list_kk,
            'list_rt' => $list_rt,
            'list_rw' => $list_rw,
        ]);
    }

    /**
     * Updates an existing Warga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $list_kk = ArrayHelper::map(Keluarga::find()->all(), 'id', 'no_kk');
        $list_rt = Rt::find()->indexBy('id')->all();
        $list_rw = Rw::find()->indexBy('id')->all();

        $data_post = Yii::$app->request->post();
        if ($data_post) {
            $old_path = $model->path_ktp;
            $model->load($data_post);

            if ($model->validate()) {
                $upload = $this->uploadFoto($model, 'path_ktp');

                if ($upload[0]) {
                    $model->path_ktp = $upload[1] . $upload[2];
                } else {
                    $model->path_ktp = $old_path;
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'list_kk' => $list_kk,
            'list_rt' => $list_rt,
            'list_rw' => $list_rw,
        ]);
    }

    public function uploadFoto($model, $attribute)
    {
        $upload = UploadedFile::getInstance($model, $attribute);
        
        if ($upload) {
            $nama_rw = strtolower(str_replace(' ', '_', Rw::findOne($model->id_rw)->nama_rw));
            $nama_rt = strtolower(str_replace(' ', '_', Rt::findOne($model->id_rt)->nama_rt));
            $nama_warga = strtolower(str_replace(' ', '_', $model->nama_warga));
            $dir_upload = 'uploads/' . $nama_rw . '/' . $nama_rt . '/ktp/';
            $file_name = $model->no_ktp . '-' . $nama_warga . '.' . $upload->extension;

            if (!is_dir($dir_upload) && is_writable('uploads/')) {
                mkdir($dir_upload, 0755, true);
            }

            if ($upload->saveAs($dir_upload . $file_name)) {
                return [true, $dir_upload, $file_name];
            }
        }
        return [false];
    }

    /**
     * Deletes an existing Warga model.
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
     * Finds the Warga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Warga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Warga::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
