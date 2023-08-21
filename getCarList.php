#!/usr/bin/php
<?php
require_once "function.php";

try {
    $objectList = [];
    $config = getConfigParameter();
    $fileName = $config['pathToFileData'];

    $carData = getDataFromVehicles($fileName);

    $countSeparator = substr_count($carData[0], $config['separatorInFileData']);
    array_shift($carData);

    $arrCorrectData = explodeCorrectData($carData, $config['separatorInFileData'], $countSeparator);

    foreach ($arrCorrectData as $vehicleData) {
        if (!empty($vehicleData)) {
            $objectList[] = getObjectForVehicle($vehicleData);
        }
    }

    print_r($objectList);


} catch (Exception $e) {
    echo $e->getMessage();
    die();
}







