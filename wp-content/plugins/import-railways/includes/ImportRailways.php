<?php

namespace Necoline;

use Exception;
use Shuchkin\SimpleXLSX;

class ImportRailways
{
    private array $allStations;
    private array $fields = [
        'repeaterKey'       => 'field_6571eca6c87af',
        'num'               => 'field_6571ee1454ae2',
        'data'              => 'field_655aa7b8a546b',
        'station_start'     => 'field_655aa80d23f35',
        'station_end'       => 'field_655aa8935af04',
        'station_operation' => 'field_655aa8bd76690',
        'distance'          => 'field_655aa9323955a',
    ];
    private array $xlsx;
    private int $pageIdRu = 2839;
    private int $pageIdEn = 999;
    private array $stationTypesTermsRu = [77,64,66];
    private array $stationTypesTermsEn = [581,38,39];

    public function __construct()
    {
        $this->allStations = $this->getStations();
    }

    private function getStations()
    {
        global $wpdb;

        $query = "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'stations' AND post_status = 'publish';";
        $results = $wpdb->get_results($query);

        $arrayStations = [];
        foreach ($results as $object) {
            $arrayStations[$object->ID] = mb_strtolower(trim($object->post_title));
        }

        return $arrayStations;
    }

    public function importFormRailwaysHandler()
    {
        $file = $_FILES['import']['tmp_name'] ?? null;

        if ($xlsx = SimpleXLSX::parse($file)) {
            $this->handlerXlsx($xlsx->rows());
        } else {
            echo SimpleXLSX::parseError();
        }

        $url = get_locale() === "en_US" ? '/en/train-schedule' : '/railway-schedule';
        wp_redirect($url);
    }

    private function handlerXlsx($arrayOfArrays)
    {
        $this->xlsx = $this->clearData($arrayOfArrays);
        $this->handlerRu();
        $this->handlerEn();
    }

    private function handlerRu(): void
    {
        delete_field($this->fields['repeaterKey'], $this->pageIdRu);
        $this->setRepeaterRu();
    }

    private function handlerEn()
    {
        delete_field($this->fields['repeaterKey'], $this->pageIdEn);
        $this->setRepeaterEn();
    }

    private function clearData($arrayOfArrays)
    {
        $data = [];
        foreach ($arrayOfArrays as $array) {

            $arrayWithoutEmptyStrings = array_filter($array, function($value) {
                return $value !== '';
            });

            if (empty($arrayWithoutEmptyStrings)) {
                continue;
            }

            $arrayWithoutEmptyStrings = array_map(function($row) {
                return mb_strtolower(trim($row));
            }, $arrayWithoutEmptyStrings);

            $data[] = $arrayWithoutEmptyStrings;
        }
        return $data;
    }

    private function setRepeaterRu()
    {
        $values = [];
        foreach($this->xlsx as $index => $importRow) {

            if ($index === 0) continue;
            $values[] = array(
                $this->fields['num']               => $importRow[1] ?? '',
                $this->fields['data']              => $importRow[2] ?? '',
                $this->fields['station_start']     => $this->getStationIdRu($importRow[3]),
                $this->fields['station_end']       => $this->getStationIdRu($importRow[4]),
                $this->fields['station_operation'] => $this->getStationIdRu($importRow[5]),
                $this->fields['distance']          => $importRow[6] ?? '',
            );
        }

        try {
            update_field($this->fields['repeaterKey'], $values, $this->pageIdRu);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function setRepeaterEn()
    {
        $values = [];
        foreach($this->xlsx as $index => $importRow) {

            if ($index === 0) continue;
            $values[] = array(
                $this->fields['num']               => $importRow[1] ?? '',
                $this->fields['data']              => $importRow[2] ?? '',
                $this->fields['station_start']     => $this->getStationIdEn($this->transliterate($importRow[3])),
                $this->fields['station_end']       => $this->getStationIdEn($this->transliterate($importRow[4])),
                $this->fields['station_operation'] => $this->getStationIdEn($this->transliterate($importRow[5])),
                $this->fields['distance']          => $importRow[6] ?? '',
            );
        }

        try {
            update_field($this->fields['repeaterKey'], $values, $this->pageIdEn);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getStationIdRu($nameStation)
    {
        $stationId = array_search($nameStation, $this->allStations);
        if (!$stationId) {
            $stationId = $this->createStation($nameStation);
            $this->allStations[$stationId] = $nameStation;
        }
        $this->setStationTypes($stationId, $this->stationTypesTermsRu, 'ru');
        return $stationId;
    }

    public function getStationIdEn($nameStation)
    {
        $stationId = array_search($nameStation, $this->allStations);
        if (!$stationId) {
            $stationId = $this->createStation($nameStation);
            $this->allStations[$stationId] = $nameStation;
        }
        $this->setStationTypes($stationId, $this->stationTypesTermsEn, 'en');
        return $stationId;
    }

    public function createStation($title)
    {
        $newStation = array(
            'post_title' => mb_convert_case($title, MB_CASE_TITLE, "UTF-8"),
            'post_status' => 'publish',
            'post_type' => 'stations'
        );

        $newStationId = wp_insert_post($newStation);
        if (is_wp_error($newStationId)) {
            throw new Exception($newStationId->get_error_message());
        }

        return $newStationId;
    }

    private function setStationTypes($stationId, $termsId, $locale)
    {
        $locale === 'ru' ? $locale='ru_RU' : $locale='en_US';
        pll_set_post_language($stationId, $locale);
        wp_set_post_terms(
            $stationId,
            $termsId,
            'station_type'
        );
    }

    private function transliterate($nameStation)
    {
        $cyr = array(
           'эксп', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я' );
        $lat = array(
            'exp', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sh', 'y', 'i', 'y', 'e', 'yu', 'ya');

        return str_replace($cyr, $lat, $nameStation);
    }

}