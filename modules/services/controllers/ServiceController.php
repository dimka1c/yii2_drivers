<?php

namespace app\modules\services\controllers;

use yii\web\Controller;
use Yii;
use app\modules\services\models\Client;
use yii\base\ErrorException;

/**
 * Default controller for the `services` module
 */
class ServiceController extends Controller
{

    public $layout = 'default';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReadCsv($path = null)
    {
        if ($path == null) {
            $path = Yii::getAlias('@web') . '/web/files/';
        }

        if (Client::csvToArray()) {
            $countNewRecords = 0;    // колво новых записей
            $addressProcessed = 0;  // колво обработанных адресов
            $arrNewClients = [];
            foreach (Client::$addressArray as $clnt) {
                $addressProcessed++;
                $flagSave = true;
                $findClients = Client::find()->where(['name' => $clnt['name']])->all();
                if (is_array($findClients)) {
                    foreach ($findClients as $findClnt) {
                        if (($findClnt->name == $clnt['name']) &&
                            ($findClnt->address == $clnt['address']) &&
                            ($findClnt->city == $clnt['city'])) {
                            // совпадает имя, город и адрес - значит записывать не надо, такой клиент уже есть
                            $flagSave = false;
                        }
                    }
                }
                if ($flagSave) {
                    $client = new Client();
                    $client->name = $clnt['name'];
                    $client->address = $clnt['address'];
                    $client->city = $clnt['city'];
                    $client->contact = $clnt['contact'];
                    $client->upload_date = date("Y-m-d");
                    if ($client->save()) {
                        new ErrorException("Ошибка записи в базу данных");
                        $countNewRecords++;
                        $arrNewClients[] = $clnt;
                    }
                }
            }
        };

        return $this->render('read-csv', [
            'newClients' => $arrNewClients,
            'newRecords' => $countNewRecords,
            'addressProcessed' => $addressProcessed
        ]);
    }

}
