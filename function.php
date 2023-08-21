<?php

use ModelTech\BaseCar;
use ModelTech\Car;
use ModelTech\SpecMachine;
use ModelTech\Truck;

require_once "BaseCar.php";
require_once "Car.php";
require_once "Truck.php";
require_once "SpecMachine.php";

const SEPARATOR_CAR_TYPE = '_';

/**
 * @throws Exception
 */
function getConfigParameter(): false|array
{
    $config = parse_ini_file("config.ini");
    if (empty($config['pathToFileData'])) {
        throw new Exception('Не указан источник данных!' . PHP_EOL);
    }
    return $config;
}

/**
 * @throws Exception
 */
function getDataFromVehicles($fileName): array
{
    $carData = [];
    if (!is_file($fileName) || !is_readable($fileName)) {
        throw new Exception('Источник данных недоступен для чтения!' . PHP_EOL);
    }

    $fh = fopen($fileName, 'r');
    while (!feof($fh)) {
        $carData[] = fgets($fh);
    }
    fclose($fh);

    return $carData;
}

/**
 * @param array $carData
 * @param string $separator
 * @param int $countSeparator
 * @return array
 */
function explodeCorrectData(array $carData, string $separator, int $countSeparator): array
{
    $arrData = [];
    $correctData = [];

    foreach ($carData as $carDatum) {
        if (substr_count($carDatum, $separator) < $countSeparator || strlen(trim($carDatum)) <= $countSeparator) {
            continue;
        } else {
            $arrData[] = $carDatum;
        }
    }

    foreach ($arrData as $arrDatum) {
        $arrDataForVehicle = explode(';', $arrDatum);

        $vehicleType = 'check' . str_replace(SEPARATOR_CAR_TYPE, '', ucwords($arrDataForVehicle[0], SEPARATOR_CAR_TYPE));
        $correctData[] = $vehicleType($arrDataForVehicle);
    }

    return $correctData;
}

/**
 * @param $data
 * @return array|string
 */
function checkCar($data): array|string
{
    array_pop($data);

    if (empty($data[0] || $data[3] || $data[1] || $data[5] || $data[2])) {
        return '';
    }

    $correctData[$data[0]]['photoFileName'] = $data[3];
    $correctData[$data[0]]['brand'] = $data[1];
    $correctData[$data[0]]['carrying'] = floatval($data[5]);
    $correctData[$data[0]]['passengerSeatsCount'] = intval($data[2]);

    return $correctData;
}

/**
 * @param $data
 * @return array|string
 */
function checkTruck($data): array|string
{
    array_pop($data);

    if (empty($data[0] || $data[3] || $data[1] || $data[5] || $data[4])) {
        return '';
    }

    //todo - проверка размеров кузова
    $bodyWHL = explode('x', $data[4]);
    foreach ($bodyWHL as $item) {
        if (floatval($item) <= 0.0) {
            return '';
        }
    }

    $correctData[$data[0]]['body_whl'] = $bodyWHL;
    $correctData[$data[0]]['photoFileName'] = $data[3];
    $correctData[$data[0]]['brand'] = $data[1];
    $correctData[$data[0]]['carrying'] = floatval($data[5]);

    return $correctData;
}

/**
 * @param $data
 * @return array|string
 */
function checkSpecMachine($data): array|string
{
    array_pop($data);

    if (empty($data[0] || $data[3] || $data[1] || $data[5] || $data[6])) {
        return '';
    }

    $correctData[$data[0]]['photoFileName'] = $data[3];
    $correctData[$data[0]]['brand'] = $data[1];
    $correctData[$data[0]]['carrying'] = floatval($data[5]);
    $correctData[$data[0]]['extra'] = $data[5];

    return $correctData;
}

/**
 * @param $vehicleData
 * @return BaseCar|Car|SpecMachine|Truck
 */
function getObjectForVehicle($vehicleData) {

    $objectName = array_key_first($vehicleData);

    return match ($objectName) {
        'car' => new ModelTech\Car($objectName,
            $vehicleData[$objectName]['brand'],
            $vehicleData[$objectName]['photoFileName'],
            $vehicleData[$objectName]['carrying'],
            $vehicleData[$objectName]['passengerSeatsCount']
        ),
        'truck' => new ModelTech\Truck($objectName,
            $vehicleData[$objectName]['brand'],
            $vehicleData[$objectName]['photoFileName'],
            $vehicleData[$objectName]['carrying'],
            $vehicleData[$objectName]['body_whl'][0],
            $vehicleData[$objectName]['body_whl'][1],
            $vehicleData[$objectName]['body_whl'][2],
        ),
        'spec_machine' => new ModelTech\SpecMachine($objectName,
            $vehicleData[$objectName]['brand'],
            $vehicleData[$objectName]['photoFileName'],
            $vehicleData[$objectName]['carrying'],
            $vehicleData[$objectName]['extra'],
        ),
        default => new ModelTech\BaseCar(),
    };
}
