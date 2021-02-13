<?php

namespace Digitalist\Library\StatisticsInformation\Model;

class UrlStatisticsItem
{
    /**
     * 
     *
     * @var int
     */
    protected $nbVisits;
    /**
     * Country codes, following the ISO-3166 ALPHA 2 standard, except for Greece which should be described using 'EL'
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
     * Country codes, following the ISO-3166 ALPHA 2 standard, except for Greece which should be described using 'EL'
     *
     * @return string
     */
    public function getOriginatingCountry() : string
    {
        return $this->originatingCountry;
    }
    /**
     * Country codes, following the ISO-3166 ALPHA 2 standard, except for Greece which should be described using 'EL'
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