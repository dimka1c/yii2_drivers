<?php

namespace app\controllers;


use app\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;


class UploadController extends Controller
{

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->upfile = UploadedFile::getInstances($model, 'upfile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionIndex()
    {
        phpinfo();
    }

    public function actionUploadFile()
    {
        if (Yii::$app->request->isAjax) {
            if (!empty($_FILES)) {
                $model = new UploadForm();
                if (Yii::$app->request->isPost) {
                    $model->upfile = UploadedFile::getInstancesByName('upfile');
                    if ($model->upload()) {
                        foreach ($model->upfile as $file) {
                            $data[] = $file->baseName;
                        }
                        echo json_encode( $data );
                    }
                }
            }
        }
    }

}