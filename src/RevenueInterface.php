<?php

namespace Fabiang\Fortschritt;

/**
 * Revenue data object.
 */
interface RevenueInterface
{
    
    /**
     * @return string
     */
    public function getAccountNumber();

    /**
     * @return \DateTime
     */
    public function getBookingDate();

    /**
     * @return \DateTime
     */
    public function getValueDate();

    /**
     * @return string
     */
    public function getClient();

    /**
     * @return string
     */
    public function getBookingText();

    /**
     * @return string
     */
    public function getPurpose();

    /**
     * @return float
     */
    public function getValue();

    /**
     * @return float
     */
    public function getValueTotal();

    /**
     * @return string
     */
    public function getCurrency();

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber);

    /**
     * @param \DateTime $bookingDate
     * @return $this
     */
    public function setBookingDate(\DateTime $bookingDate);

    /**
     * @param \DateTime $valueDate
     * @return $this
     */
    public function setValueDate(\DateTime $valueDate);

    /**
     * @param string $client
     * @return $this
     */
    public function setClient($client);

    /**
     * @param string $bookingText
     * @return $this
     */
    public function setBookingText($bookingText);

    /**
     * @param string $purpose
     * @return $this
     */
    public function setPurpose($purpose);

    /**
     * @param float $value
     * @return $this
     */
    public function setValue($value);

    /**
     * @param string $valueTotal
     * @return $this
     */
    public function setValueTotal($valueTotal);

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency);
}
