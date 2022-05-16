<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model;

class AssistanceSurvey
{
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $clearOffer;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $easiness;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $responsiveness;
    /**
     * 
     *
     * @var string
     */
    protected $delays;
    /**
     * 
     *
     * @var string
     */
    protected $onlinePayment;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getClearOffer() : int
    {
        return $this->clearOffer;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $clearOffer
     *
     * @return self
     */
    public function setClearOffer(int $clearOffer) : self
    {
        $this->clearOffer = $clearOffer;
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
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getResponsiveness() : int
    {
        return $this->responsiveness;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $responsiveness
     *
     * @return self
     */
    public function setResponsiveness(int $responsiveness) : self
    {
        $this->responsiveness = $responsiveness;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getDelays() : string
    {
        return $this->delays;
    }
    /**
     * 
     *
     * @param string $delays
     *
     * @return self
     */
    public function setDelays(string $delays) : self
    {
        $this->delays = $delays;
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
