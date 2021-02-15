<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Model;

class InformationSurvey
{
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $userFriendliness;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $accuracy;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $comprehensiveness;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $clarity;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $easyFinding;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $structure;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $upToDate;
    /**
     * 
     *
     * @var string
     */
    protected $lastUpdate;
    /**
     * 
     *
     * @var string
     */
    protected $ownership;
    /**
     * 
     *
     * @var string
     */
    protected $legalActs;
    /**
     * 
     *
     * @var string
     */
    protected $englishAvailability;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getUserFriendliness() : int
    {
        return $this->userFriendliness;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $userFriendliness
     *
     * @return self
     */
    public function setUserFriendliness(int $userFriendliness) : self
    {
        $this->userFriendliness = $userFriendliness;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getAccuracy() : int
    {
        return $this->accuracy;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $accuracy
     *
     * @return self
     */
    public function setAccuracy(int $accuracy) : self
    {
        $this->accuracy = $accuracy;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getComprehensiveness() : int
    {
        return $this->comprehensiveness;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $comprehensiveness
     *
     * @return self
     */
    public function setComprehensiveness(int $comprehensiveness) : self
    {
        $this->comprehensiveness = $comprehensiveness;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getClarity() : int
    {
        return $this->clarity;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $clarity
     *
     * @return self
     */
    public function setClarity(int $clarity) : self
    {
        $this->clarity = $clarity;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getEasyFinding() : int
    {
        return $this->easyFinding;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $easyFinding
     *
     * @return self
     */
    public function setEasyFinding(int $easyFinding) : self
    {
        $this->easyFinding = $easyFinding;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getStructure() : int
    {
        return $this->structure;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $structure
     *
     * @return self
     */
    public function setStructure(int $structure) : self
    {
        $this->structure = $structure;
        return $this;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getUpToDate() : int
    {
        return $this->upToDate;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $upToDate
     *
     * @return self
     */
    public function setUpToDate(int $upToDate) : self
    {
        $this->upToDate = $upToDate;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getLastUpdate() : string
    {
        return $this->lastUpdate;
    }
    /**
     * 
     *
     * @param string $lastUpdate
     *
     * @return self
     */
    public function setLastUpdate(string $lastUpdate) : self
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getOwnership() : string
    {
        return $this->ownership;
    }
    /**
     * 
     *
     * @param string $ownership
     *
     * @return self
     */
    public function setOwnership(string $ownership) : self
    {
        $this->ownership = $ownership;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getLegalActs() : string
    {
        return $this->legalActs;
    }
    /**
     * 
     *
     * @param string $legalActs
     *
     * @return self
     */
    public function setLegalActs(string $legalActs) : self
    {
        $this->legalActs = $legalActs;
        return $this;
    }
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
}