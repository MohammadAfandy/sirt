<?php

namespace app\controllers;

use Yii;
use app\models\Rt;
use app\models\RtSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\Warga;
use app\models\Rw;
use yii\helpers\ArrayHelper;
/**
 * RtController implements the CRUD actions for Rt model.
 */
class RtController extends Controller
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
     * Lists all Rt models.
     * @param integer $id (id_rw)
     * @return mixed
     */
    public function actionIndex($rw = null)
    {
        $searchModel = new RtSearch();
        $dataProvider = $searchModel->search($rw, Yii::$app->request->queryParams);

        $list_rw = Rw::find()->indexBy('id')->all();

        return $this->render('index', [
            'id' => $rw,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'list_rw' => $list_rw,
        ]);
    }

    /**
     * Displays a single Rt model.
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
     * Creates a new Rt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rt();
        $list_warga_rt = ArrayHelper::map(Warga::find()->where(['id_rt' => $model->id])->all(), 'id', 'nama_warga');
        $id_rw = Yii::$app->request->get('rw');
        $data_post = Yii::$app->request->post();

        if ($data_post) {
            $model->load($data_post);
            $model->id_rw = $id_rw;
            if ($model->validate()) {
                
                if (!empty($model->path_logo)) {
                    $upload = $this->uploadLogo($model, 'path_logo');
                
                    if ($upload[0]) {
                        $model->path_logo = $upload[1] . $upload[2];
                    }
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'list_warga_rt' => $list_warga_rt,
            'id_rw' => $id_rw,
        ]);
    }

    /**
     * Updates an existing Rt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list_warga_rt = ArrayHelper::map(Warga::find()->where(['id_rt' => $model->id])->all(), 'id', 'nama_warga');
        $field_warga = Rt::getFieldWarga();
        $list_seksi = Rt::getSeksi();
        $data_post = Yii::$app->request->post();

        if ($data_post) {
            $old_path = $model->path_logo;
            $model->seksi = null;
            $model->load($data_post);

            if ($model->validate()) {
                $upload = $this->uploadLogo($model, 'path_logo');

                if ($upload[0]) {
                    $model->path_logo = $upload[1] . $upload[2];
                } else {
                    $model->path_logo = $old_path;
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'list_warga_rt' => $list_warga_rt,
            'field_warga' => $field_warga,
            'list_seksi' => $list_seksi,
        ]);
    }

    public function uploadLogo($model, $attribute)
    {
        $upload = UploadedFile::getInstance($model, $attribute);
        
        if ($upload) {
            $nama_rw = strtolower(str_replace(' ', '_', Rw::findOne($model->id_rw)->nama_rw));
            $nama_rt = strtolower(str_replace(' ', '_', $model->nama_rt));
            $dir_upload = 'uploads/' . $nama_rw . '/' . $nama_rt . '/logo/';
            $file_name = 'logo_' . $nama_rt . '.' . $upload->extension;

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
     * Deletes an existing Rt model.
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
     * Finds the Rt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAjaxSelect()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = isset($data['id']) ? $data['id'] : [];
            // print_r($data);
            $data_select = ArrayHelper::map(Warga::find()->andWhere(['id_rt' => $data['rt']])->andWhere(['NOT IN', 'id', $id])->all(), 'id', 'nama_warga');

            echo json_encode($data_select);
        }
    }
}
