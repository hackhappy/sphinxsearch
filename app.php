<?php

require_once 'sphinxapi.php';

require_once "PatientSphinxSearch/BaseSphinxSearch.php";
require_once "PatientSphinxSearch/PatientSphinxSearch.php";
require_once "PatientSphinxSearch/PatientSphinxConfig.php";

use PatientSphinxSearch\PatientSphinxSearch as PatientSearch;

$ps = new PatientSearch();

$callback = function ($result) {
    //operations with search result

    return $result;
};

$result = $ps->searchPatient(['Sophia', 'Max'], $callback);

print_r($result);
