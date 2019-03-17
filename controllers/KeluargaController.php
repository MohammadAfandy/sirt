<?php

namespace app\controllers;

use Yii;
use app\models\Keluarga;
use app\models\KeluargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\Warga;
use yii\helpers\ArrayHelper;
/**
 * KeluargaController implements the CRUD actions for Keluarga model.
 */
class KeluargaController extends Controller
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
     * Lists all Keluarga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeluargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Keluarga model.
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
     * Creates a new Keluarga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Keluarga();
        $id_existing = $this->getWargaExisting();

        $list_warga = ArrayHelper::map(Warga::find()->where(['not in', 'id', $id_existing])->all(), 'id', 'nama_warga');
        $field_anggota = Keluarga::getFieldAnggota();
        $data_post = Yii::$app->request->post();

        if ($data_post) {
            $model->load($data_post);

            if ($model->validate()) {
                $upload = $this->uploadFoto($model, 'path_kk');
                if ($upload[0]) {
                    $model->path_kk = $upload[1] . $upload[2];
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'list_warga' => $list_warga,
            'field_anggota' => $field_anggota,
        ]);
    }

    /**
     * Updates an existing Keluarga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $id_existing = $this->getWargaExisting($model->kepala_keluarga);
        $list_warga = ArrayHelper::map(Warga::find()->where(['not in', 'id', $id_existing])->all(), 'id', 'nama_warga');
        $field_anggota = Keluarga::getFieldAnggota();
        $data_post = Yii::$app->request->post();

        if ($data_post) {
            $old_path = $model->path_kk;
            $model->anggota_keluarga = null;
            $model->load($data_post);

            if ($model->validate()) {
                $upload = $this->uploadFoto($model, 'path_kk');
                if ($upload[0]) {
                    $model->path_kk = $upload[1] . $upload[2];
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'list_warga' => $list_warga,
            'field_anggota' => $field_anggota,
        ]);
    }

    public function uploadFoto($model, $attribute)
    {
        $upload = UploadedFile::getInstance($model, $attribute);
        
        if ($upload) {
            $dir_upload = 'uploads/kk/';
            $file_name = 'kk_' . $model->no_kk . '.' . $upload->extension;

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
     * Deletes an existing Keluarga model.
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
     * Finds the Keluarga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Keluarga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keluarga::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getWargaExisting($kepala_keluarga = false)
    {
        $id_existing = [];
        $warga_existing = Keluarga::find()->select(['kepala_keluarga', 'anggota_keluarga'])->asArray()->all();
        foreach ($warga_existing as $warga) {
            if ($kepala_keluarga == $warga['kepala_keluarga']) {
                continue;
            }
            $id_existing[] = $warga['kepala_keluarga'];
            $anggota = json_decode($warga['anggota_keluarga'], true);
            if ($anggota) {
                foreach ($anggota as $ang) {
                    foreach ($ang as $a) {
                        if ($a) {
                            $id_existing[] = $a;
                        }
                    }
                }
            }
        }

        return $id_existing;
    }

    public function actionAjaxSelect()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = isset($data['id']) ? $data['id'] : [];
            $kepala_keluarga = $data['kepala_keluarga'];

            $id_existing = array_merge($this->getWargaExisting($kepala_keluarga), $id);
            $data_select = ArrayHelper::map(Warga::find()->where(['NOT IN', 'id', $id_existing])->all(), 'id', 'nama_warga');

            Yii::$app->response->data = json_encode($data_select);
        }
    }
}
