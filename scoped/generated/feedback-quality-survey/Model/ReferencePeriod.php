<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model;

class ReferencePeriod
{
    /**
     * Start date of the reference period. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @var \DateTime
     */
    protected $startDate;
    /**
     * End date of the reference period. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @var \DateTime
     */
    protected $endDate;
    /**
     * Start date of the reference period. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @return \DateTime
     */
    public function getStartDate() : \DateTime
    {
        return $this->startDate;
    }
    /**
     * Start date of the reference period. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @param \DateTime $startDate
     *
     * @return self
     */
    public function setStartDate(\DateTime $startDate) : self
    {
        $this->startDate = $startDate;
        return $this;
    }
    /**
     * End date of the reference period. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @return \DateTime
     */
    public function getEndDate() : \DateTime
    {
        return $this->endDate;
    }
    /**
     * End date of the reference period. The format must complies with the RFC 3339 standard. E.g.:2020-12-31T23:59:59.00Z (full-dateTfull-timeZ)
     *
     * @param \DateTime $endDate
     *
     * @return self
     */
    public function setEndDate(\DateTime $endDate) : self
    {
        $this->endDate = $endDate;
        return $this;
    }
}
