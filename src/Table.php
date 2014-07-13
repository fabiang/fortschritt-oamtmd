<?php

namespace Fabiang\Fortschritt;

/**
 * Table generator.
 */
class Table
{

    /**
     * @var RevenueInterface[]
     */
    protected $data;

    /**
     * @param RevenueInterface[] $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Generate table.
     *
     * @param integer $steps
     * @param integer $max
     * @return array
     */
    public function generate($steps, $max)
    {
        $numSteps = ceil($max / $steps);
        $ranges   = array_fill(0, $numSteps, array(
            'total' => 0,
            'days'  => array(),
        ));

        foreach ($this->data as $data) {
            $value      = (int) floor($data->getValue());
            $totalValue = (int) floor($data->getValueTotal());

            $targetStep = (int) floor($totalValue / $steps);
            if ($targetStep < 0) {
                $targetStep = 0;
            }

            $ranges[$targetStep]['total'] += $value;
            $ranges[$targetStep]['days'][] = array(
                'colspan' => abs($value),
                'value'   => $value,
                'title'   => $data->getPurpose(),
            );
        }

        foreach ($ranges as $i => &$range) {
            $total = $range['total'];
            $diff  = $steps - $total;

            // correct last step diff
            if (($i + 1) * $steps > $max) {
                $diff = $max - ($i) * $steps;
            }

            for ($i = 0; $i < $diff; $i++) {
                $range['days'][] = array('colspan' => 1, 'value' => 0, 'title' => null);
            }
        }

        return $ranges;
    }

    /**
     * Generate days overview.
     *
     * @return array
     */
    public function days()
    {
        $days = array();
        foreach ($this->data as $data) {
            $day = $data->getBookingDate()->format('d.m.Y');

            if (!isset($days[$day])) {
                $days[$day] = array(
                    'day'     => $data->getBookingDate()->format('j'),
                    'colspan' => abs(floor($data->getValue()))
                );
            } else {
                $days[$day]['colspan'] += abs(floor($data->getValue()));
            }
        }

        return $days;
    }

    public function steps(array $ranges, $steps, $max)
    {
        $stepList = array();
        $colspanTotal = 0;
        foreach ($ranges as $i => $range) {
            $colspan     = ceil($this->getColspans($range['days']) / 2);
            $colspanNext = 0;

            if ($i > 0) {
                if (isset($ranges[$i + 1])) {
                    $colspanNext = ceil($this->getColspans($ranges[$i + 1]['days']) / 2);
                } else {
                    $colspanNext = ($max - $colspanTotal) / 2;
                }
            }
            
            $stepList[] = array(
                'value'   => $i * $steps,
                'colspan' => $colspan + $colspanNext,
            );
            
            $colspanTotal += $colspan + $colspanNext;
        }
        return $stepList;
    }
    
    protected function getColspans(array $days)
    {
        $colspan = 0;
        foreach ($days as $day) {
            $colspan += $day['colspan'];
        }
        return $colspan;
    }
}
