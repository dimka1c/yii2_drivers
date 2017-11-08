<?php

namespace app\modules\services\models;

use Yii;
use yii\db\ActiveRecord;

class Client extends ActiveRecord
{

    public static $filesCsv = [];
    public static $path;
    public static $addressArray = [];


    public static function tableName()
    {
        return 'client';
    }

    // получаем список всех файлов csv в папке
    private static function getAllFiles()
    {
        self::$path =  Yii::getAlias('@webroot') . '/files/';
        $dir = new \FilesystemIterator(self::$path);
        foreach ($dir as $item) {
            self::$filesCsv[] = $item;
        }
        if (count(self::$filesCsv) > 0) {
            return true;
        }
        return false;
    }

    private function deleteExtraDataFromArray(Array $arrData = [])
    {
        if (empty($arrData)) return false;
        $data = array_diff($arrData, array(''), array(' '));
        if (isset($data[7])) { // проверяем есть ли 5 стрка, где указано ХВ, в новых файлах это уже 10-я строка
            if ((strpos($data[7], 'Рн№ХВ') !== false) ||
                (strpos($data[7], 'Вк№ХВ') !== false)) {
                // это то, что нам надо
                $arr['name'] = trim($data[0]);
                $arr['city'] = trim($data[1]);
                $arr['address'] = trim($data[2]);
                $arr['contact'] = trim($data[3]);
                return $arr;
            }
        };
        return false;
    }

    // получаем данные из csv-файлов в массив $addressArray[]
    public static function csvToArray()
    {
        if (self::getAllFiles()) {
            foreach (self::$filesCsv as $file) {
                if ($file->isFile()) {
                    if (($handle = fopen($file->getPathname(), 'r')) !== false) {
                        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                            if (($data = self::deleteExtraDataFromArray($data)) !== false) {
                                self::$addressArray[] = $data;
                            };
                        }
                        fclose($handle);
                    }
                }
            }
        }

        if (count(self::$addressArray) > 0) {
            ksort(self::$addressArray, SORT_NATURAL);
            return true;
        }
        return false;
    }

}