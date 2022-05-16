<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model;

class FeedbackBatch
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
     * 
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
     * @var int
     */
    protected $nbEntries;
    /**
     * 
     *
     * @var Feedback[]
     */
    protected $feedbacks;
    /**
     * Unique ID for feedback submission for a specific reference period collected from the Unique ID web API call.
     *
     * @return string
     */
    public function getUniqueId() : string
    {
        return $this->uniqueId;
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
     * 
     *
     * @return \DateTime
     */
    public function getTransferDate() : \DateTime
    {
        return $this->transferDate;
    }
    /**
     * 
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
     * @return int
     */
    public function getNbEntries() : int
    {
        return $this->nbEntries;
    }
    /**
     * 
     *
     * @param int $nbEntries
     *
     * @return self
     */
    public function setNbEntries(int $nbEntries) : self
    {
        $this->nbEntries = $nbEntries;
        return $this;
    }
    /**
     * 
     *
     * @return Feedback[]
     */
    public function getFeedbacks() : array
    {
        return $this->feedbacks;
    }
    /**
     * 
     *
     * @param Feedback[] $feedbacks
     *
     * @return self
     */
    public function setFeedbacks(array $feedbacks) : self
    {
        $this->feedbacks = $feedbacks;
        return $this;
    }
}
