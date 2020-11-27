<?php

namespace Vendor\Library\StatisticsInformation\Model;

class UrlStatisticsItem
{
    /**
     * 
     *
     * @var int
     */
    protected $nbVisits;
    /**
     * Country codes as per Eurostat. See  https://ec.europa.eu/eurostat/statistics-explained/index.php/Glossary:Country_codes
     *
     * @var string
     */
    protected $originatingCountry;
    /**
     * 
     *
     * @var string
     */
    protected $deviceType;
    /**
     * 
     *
     * @return int
     */
    public function getNbVisits() : int
    {
        return $this->nbVisits;
    }
    /**
     * 
     *
     * @param int $nbVisits
     *
     * @return self
     */
    public function setNbVisits(int $nbVisits) : self
    {
        $this->nbVisits = $nbVisits;
        return $this;
    }
    /**
     * Country codes as per Eurostat. See  https://ec.europa.eu/eurostat/statistics-explained/index.php/Glossary:Country_codes
     *
     * @return string
     */
    public function getOriginatingCountry() : string
    {
        return $this->originatingCountry;
    }
    /**
     * Country codes as per Eurostat. See  https://ec.europa.eu/eurostat/statistics-explained/index.php/Glossary:Country_codes
     *
     * @param string $originatingCountry
     *
     * @return self
     */
    public function setOriginatingCountry(string $originatingCountry) : self
    {
        $this->originatingCountry = $originatingCountry;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getDeviceType() : string
    {
        return $this->deviceType;
    }
    /**
     * 
     *
     * @param string $deviceType
     *
     * @return self
     */
    public function setDeviceType(string $deviceType) : self
    {
        $this->deviceType = $deviceType;
        return $this;
    }
}