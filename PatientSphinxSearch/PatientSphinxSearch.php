<?php
/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 22.12.15
 * Time: 13:20
 */

namespace PatientSphinxSearch;


class PatientSphinxSearch extends BaseSphinxSearch
{
    const OPTIN_SQL_PARAM = 'optin';
    const PATIENT_INDEX = 'patient_index';

    public function __construct()
    {
        parent::__construct();
    }

    public function searchPatient($patientInfo, callable $callback = null, $optin = true)
    {
        // convert to sphinx query lang
        if (is_array($patientInfo)) {
            $patientInfo = implode('|', $patientInfo);
        }

        $result = $this->setFilter(self::OPTIN_SQL_PARAM, $optin)
            ->search($patientInfo, self::PATIENT_INDEX)
            ->getArrayResult();

        $callback !== null && $result = $callback($result);

        return $result;
    }
}