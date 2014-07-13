<?php

namespace Fabiang\Fortschritt;

use \DataTime;

/**
 * Revenue data object.
 */
class Revenue implements RevenueInterface
{
    /**
     *
     * @var string
     */
    protected $accountNumber;
    
    /**
     *
     * @var \DateTime
     */
    protected $bookingDate;
    
    /**
     *
     * @var \DateTime
     */
    protected $valueDate;
    
    /**
     *
     * @var string
     */
    protected $client;
    
    /**
     *
     * @var string
     */
    protected $bookingText;
    
    /**
     *
     * @var string
     */
    protected $purpose;
    
    /**
     *
     * @var float
     */
    protected $value;
    
    /**
     *
     * @var float
     */
    protected $valueTotal;
    
    /**
     *
     * @var string
     */
    protected $currency;
    
    /**
     * {@inheritDoc}
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getValueDate()
    {
        return $this->valueDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * {@inheritDoc}
     */
    public function getBookingText()
    {
        return $this->bookingText;
    }

    /**
     * {@inheritDoc}
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function getValueTotal()
    {
        return $this->valueTotal;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = (string) $accountNumber;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setBookingDate(\DateTime $bookingDate)
    {
        $this->bookingDate = $bookingDate;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setValueDate(\DateTime $valueDate)
    {
        $this->valueDate = $valueDate;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setClient($client)
    {
        $this->client = (string) $client;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setBookingText($bookingText)
    {
        $this->bookingText = (string) $bookingText;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPurpose($purpose)
    {
        $this->purpose = (string) $purpose;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = (float) $value;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setValueTotal($valueTotal)
    {
        $this->valueTotal = (float) $valueTotal;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrency($currency)
    {
        $this->currency = (string) $currency;
        return $this;
    }
}
