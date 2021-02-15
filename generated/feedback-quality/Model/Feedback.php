<?php

namespace Digitalist\Library\FeedbackQuality\Model;

class Feedback
{
    /**
     * Source URL for this feedback.
     *
     * @var string
     */
    protected $source;
    /**
     * 
     *
     * @var string
     */
    protected $category;
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @var int
     */
    protected $rating;
    /**
     * 
     *
     * @var string
     */
    protected $foundInformation;
    /**
     * 
     *
     * @var string
     */
    protected $helpUsImprove;
    /**
     * Source URL for this feedback.
     *
     * @return string
     */
    public function getSource() : string
    {
        return $this->source;
    }
    /**
     * Source URL for this feedback.
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
     * 
     *
     * @return string
     */
    public function getCategory() : string
    {
        return $this->category;
    }
    /**
     * 
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
     * User rating from 1 (worst) to 5 (best).
     *
     * @return int
     */
    public function getRating() : int
    {
        return $this->rating;
    }
    /**
     * User rating from 1 (worst) to 5 (best).
     *
     * @param int $rating
     *
     * @return self
     */
    public function setRating(int $rating) : self
    {
        $this->rating = $rating;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getFoundInformation() : string
    {
        return $this->foundInformation;
    }
    /**
     * 
     *
     * @param string $foundInformation
     *
     * @return self
     */
    public function setFoundInformation(string $foundInformation) : self
    {
        $this->foundInformation = $foundInformation;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getHelpUsImprove() : string
    {
        return $this->helpUsImprove;
    }
    /**
     * 
     *
     * @param string $helpUsImprove
     *
     * @return self
     */
    public function setHelpUsImprove(string $helpUsImprove) : self
    {
        $this->helpUsImprove = $helpUsImprove;
        return $this;
    }
}