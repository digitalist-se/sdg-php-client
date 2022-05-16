<?php

namespace SdgScoped\Digitalist\Library\StatisticsInformation\Model;

class Source
{
    /**
     * 
     *
     * @var string
     */
    protected $sourceUrl;
    /**
     * An object representing the statistical information for one particular source URL. Array of objects because same URL can have several combination of statistics depending on different values of the originating country or type of device.
     *
     * @var UrlStatisticsItem[]
     */
    protected $statistics;
    /**
     * 
     *
     * @return string
     */
    public function getSourceUrl() : string
    {
        return $this->sourceUrl;
    }
    /**
     * 
     *
     * @param string $sourceUrl
     *
     * @return self
     */
    public function setSourceUrl(string $sourceUrl) : self
    {
        $this->sourceUrl = $sourceUrl;
        return $this;
    }
    /**
     * An object representing the statistical information for one particular source URL. Array of objects because same URL can have several combination of statistics depending on different values of the originating country or type of device.
     *
     * @return UrlStatisticsItem[]
     */
    public function getStatistics() : array
    {
        return $this->statistics;
    }
    /**
     * An object representing the statistical information for one particular source URL. Array of objects because same URL can have several combination of statistics depending on different values of the originating country or type of device.
     *
     * @param UrlStatisticsItem[] $statistics
     *
     * @return self
     */
    public function setStatistics(array $statistics) : self
    {
        $this->statistics = $statistics;
        return $this;
    }
}
