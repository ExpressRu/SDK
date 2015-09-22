<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\TrackingStatus;

use ExpressRuSDK\Model\Entities\AbstractEntity;

/**
 * Class TrackingStatus
 * @package ExpressRuSDK\Model\Entities\TrackingStatus
 */
class TrackingStatus extends AbstractEntity
{

    /**
     * @var
     */
    protected $status;
    /**
     * @var
     */
    protected $date;
    /**
     * @var
     */
    protected $note;

    /**
     * @var
     */
    protected $invoiceNumber;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return TrackingStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return TrackingStatus
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }


    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }


    /**
     * @param $note
     * @return TrackingStatus
     */
    public function setNote($note)
    {
        $this->note = $note;
        if (preg_match('/Накладная (.*) от/', $note, $matches)) {
            $this->invoiceNumber = $matches[1];
        }
        return $this;
    }


    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }
}
