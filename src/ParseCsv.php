<?php

namespace Fabiang\Fortschritt;

/**
 * Parse csv file into objects.
 */
class ParseCsv
{

    /**
     * @var string
     */
    protected $csv;

    /**
     * @var integer
     */
    protected $skip;

    /**
     * @var string
     */
    protected $charset;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var string
     */
    protected $enclosure;

    /**
     * @var string
     */
    protected $escape;

    /**
     *
     * @param string  $csv       CSV file path
     * @param integer $skip      Skip lines
     * @param string  $charset   Input charset.
     * @param string  $delimiter Delimiter between data
     * @param string  $enclosure Enclosure for data
     * @param string  $escape    Escape string
     */
    public function __construct($csv, $skip = 0, $charset = 'utf-8', $delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        $this->csv       = $csv;
        $this->skip      = (int) $skip;
        $this->charset   = (string) $charset;
        $this->delimiter = (string) $delimiter;
        $this->enclosure = (string) $enclosure;
        $this->escape    = (string) $escape;
    }

    /**
     * Parse csv.
     *
     * @param RevenueInterface $revenue
     * @return RevenueInterface[]
     */
    public function parse(RevenueInterface $revenue)
    {
        $handle = fopen($this->csv, 'r');

        $data = array();
        $row = 0;
        while (false !== ($csvData = fgetcsv($handle, 2048, $this->delimiter, $this->enclosure, $this->escape))) {
            $row++;
            // skipped lines
            if ($row <= $this->skip) {
                continue;
            }

            $dataObject = clone $revenue;
            list($accountNumber, $bookingDate, $valueDate, $client, $bookingText) = $csvData;

            $dataObject->setAccountNumber($accountNumber);
            $dataObject->setBookingDate(\DateTime::createFromFormat('d.m.Y', $bookingDate));
            $dataObject->setValueDate(\DateTime::createFromFormat('d.m.Y', $valueDate));
            $dataObject->setClient($this->convertCharset($client));
            $dataObject->setBookingText($this->convertCharset($bookingText));

            // purpose of the booking is split into 14 fields!
            $purpose = implode('', array_slice($csvData, 5, 14));
            $dataObject->setPurpose($purpose);

            list($value, $valueTotal, $currency) = array_slice($csvData, 19, 3);
            $dataObject->setValue($this->convertFloat($value));
            $dataObject->setValueTotal($this->convertFloat($valueTotal));
            $dataObject->setCurrency($currency);

            $data[] = $dataObject;
        }

        fclose($handle);
        return $data;
    }

    /**
     * Convert german number format to float.
     *
     * @param string $string
     * @return float
     */
    protected function convertFloat($string)
    {
        return (float) str_replace(',', '.', $string);
    }

    /**
     * Convert string to UTF-8.
     *
     * @param string $string
     * @return string
     */
    protected function convertCharset($string)
    {
        return iconv($this->charset, 'UTF-8', $string);
    }
}
