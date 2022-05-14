<?php

namespace Digitalist\Library\StatisticsInformation\Model;

class InformationServiceStats
{
    /**
     * Unique ID for feedback submission for a specific reference period collected from the Unique ID web API call.
     *
     * @var string
     */
    protected $uniqueId;
    /**
     * 
     *
     * @var ReferencePeriod
     */
    protected $referencePeriod;
    /**
     * Date Time when the web API is called. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @var \DateTime
     */
    protected $transferDate;
    /**
     * 
     *
     * @var string
     */
    protected $transferType;
    /**
     * 
     *
     * @var float
     */
    protected $nbEntries;
    /**
     * 
     *
     * @var Source[]
     */
    protected $sources;
    /**
     * Unique ID for feedback submission for a specific reference period collected from the Unique ID web API call.
     *
     * @return string
     */
    public function getUniqueId() : string
    {
        $uniqueId = $this->uniqueId;
        return is_null($uniqueId)?"":$uniqueId;
    }
    /**
     * Unique ID for feedback submission for a specific reference period collected from the Unique ID web API call.
     *
     * @param string $uniqueId
     *
     * @return self
     */
    public function setUniqueId(string $uniqueId) : self
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }
    /**
     * 
     *
     * @return ReferencePeriod
     */
    public function getReferencePeriod() : ReferencePeriod
    {
        return $this->referencePeriod;
    }
    /**
     * 
     *
     * @param ReferencePeriod $referencePeriod
     *
     * @return self
     */
    public function setReferencePeriod(ReferencePeriod $referencePeriod) : self
    {
        $this->referencePeriod = $referencePeriod;
        return $this;
    }
    /**
     * Date Time when the web API is called. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @return \DateTime
     */
    public function getTransferDate() : \DateTime
    {
        return $this->transferDate;
    }
    /**
     * Date Time when the web API is called. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @param \DateTime $transferDate
     *
     * @return self
     */
    public function setTransferDate(\DateTime $transferDate) : self
    {
        $this->transferDate = $transferDate;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getTransferType() : string
    {
        return $this->transferType;
    }
    /**
     * 
     *
     * @param string $transferType
     *
     * @return self
     */
    public function setTransferType(string $transferType) : self
    {
        $this->transferType = $transferType;
        return $this;
    }
    /**
     * 
     *
     * @return float
     */
    public function getNbEntries() : float
    {
        return $this->nbEntries;
    }
    /**
     * 
     *
     * @param float $nbEntries
     *
     * @return self
     */
    public function setNbEntries(float $nbEntries) : self
    {
        $this->nbEntries = $nbEntries;
        return $this;
    }
    /**
     * 
     *
     * @return Source[]
     */
    public function getSources() : array
    {
        return $this->sources;
    }
    /**
     * 
     *
     * @param Source[] $sources
     *
     * @return self
     */
    public function setSources(array $sources) : self
    {
        $this->sources = $sources;
        return $this;
    }
}