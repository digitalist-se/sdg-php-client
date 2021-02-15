<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Model;

class Feedback
{
    /**
     * The URL of the webpage.
     *
     * @var string
     */
    protected $source;
    /**
     * Must match the survey type
     *
     * @var string
     */
    protected $category;
    /**
     * Detailed user surveys for detailed Feedback EITHER [1] on Information, [2] OR on cross-border accessibility of an online Procedure, [3] OR on an Assistance or problem solving service.
     *
     * @var mixed
     */
    protected $survey;
    /**
     * The URL of the webpage.
     *
     * @return string
     */
    public function getSource() : string
    {
        return $this->source;
    }
    /**
     * The URL of the webpage.
     *
     * @param string $source
     *
     * @return self
     */
    public function setSource(string $source) : self
    {
        $this->source = $source;
        return $this;
    }
    /**
     * Must match the survey type
     *
     * @return string
     */
    public function getCategory() : string
    {
        return $this->category;
    }
    /**
     * Must match the survey type
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory(string $category) : self
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Detailed user surveys for detailed Feedback EITHER [1] on Information, [2] OR on cross-border accessibility of an online Procedure, [3] OR on an Assistance or problem solving service.
     *
     * @return mixed
     */
    public function getSurvey()
    {
        return $this->survey;
    }
    /**
     * Detailed user surveys for detailed Feedback EITHER [1] on Information, [2] OR on cross-border accessibility of an online Procedure, [3] OR on an Assistance or problem solving service.
     *
     * @param mixed $survey
     *
     * @return self
     */
    public function setSurvey($survey) : self
    {
        $this->survey = $survey;
        return $this;
    }
}