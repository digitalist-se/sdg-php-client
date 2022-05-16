<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model;

class ProcedureSurvey
{
    /**
     * 
     *
     * @var string
     */
    protected $englishAvailability;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $easiness;
    /**
     * 
     *
     * @var string
     */
    protected $nationalAuthentication;
    /**
     * 
     *
     * @var string
     */
    protected $complianceEvidence;
    /**
     * 
     *
     * @var string
     */
    protected $onlinePayment;
    /**
     * 
     *
     * @return string
     */
    public function getEnglishAvailability() : string
    {
        return $this->englishAvailability;
    }
    /**
     * 
     *
     * @param string $englishAvailability
     *
     * @return self
     */
    public function setEnglishAvailability(string $englishAvailability) : self
    {
        $this->englishAvailability = $englishAvailability;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getEasiness() : int
    {
        return $this->easiness;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $easiness
     *
     * @return self
     */
    public function setEasiness(int $easiness) : self
    {
        $this->easiness = $easiness;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getNationalAuthentication() : string
    {
        return $this->nationalAuthentication;
    }
    /**
     * 
     *
     * @param string $nationalAuthentication
     *
     * @return self
     */
    public function setNationalAuthentication(string $nationalAuthentication) : self
    {
        $this->nationalAuthentication = $nationalAuthentication;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getComplianceEvidence() : string
    {
        return $this->complianceEvidence;
    }
    /**
     * 
     *
     * @param string $complianceEvidence
     *
     * @return self
     */
    public function setComplianceEvidence(string $complianceEvidence) : self
    {
        $this->complianceEvidence = $complianceEvidence;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getOnlinePayment() : string
    {
        return $this->onlinePayment;
    }
    /**
     * 
     *
     * @param string $onlinePayment
     *
     * @return self
     */
    public function setOnlinePayment(string $onlinePayment) : self
    {
        $this->onlinePayment = $onlinePayment;
        return $this;
    }
}
