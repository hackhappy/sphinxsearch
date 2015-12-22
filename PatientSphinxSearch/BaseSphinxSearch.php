<?php
/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 22.12.15
 * Time: 13:12
 */

namespace PatientSphinxSearch;


class BaseSphinxSearch
{
    private $sphinxsearch;
    private $result;

    public function __construct()
    {
        $this->sphinxsearch = new \SphinxClient();
        $this->sphinxsearch->SetServer( PatientSphinxConfig::SERVER, PatientSphinxConfig::PORT );

        $this->setMatchMode();
    }

    protected function setMatchMode($mode = SPH_MATCH_EXTENDED)
    {
        $this->sphinxsearch->SetMatchMode($mode);
    }

    public function setFilter($paramName, $paramData)
    {
        $paramArrayData = ! is_array($paramData) ? [$paramData] : $paramData;

        $this->sphinxsearch->SetFilter($paramName, $paramArrayData);

        return $this;
    }

    public function search($query, $indexName)
    {
        try {
            $this->result = $this->sphinxsearch->Query($query, $indexName);

            if ($this->result === false) {
                throw new \Exception($this->sphinxsearch->GetLastError());
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $this;
    }

    public function getArrayResult()
    {
        return !empty($this->result["matches"]) ? $this->result["matches"] : [];
    }
}