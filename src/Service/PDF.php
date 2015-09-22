<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Service;

use ExpressRuSDK\Api\Methods\PrintInvoiceMethod;
use ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface;

/**
 * Class PDF
 * @package ExpressRuSDK\Service
 */
class PDF extends AbstractService
{

    /**
     * @param ExpressRuOrderInterface $order
     * @return null|string
     */
    public function getInvoicePDFForOrder(ExpressRuOrderInterface $order)
    {
        $printInvoiceMethod = new PrintInvoiceMethod($order->getExpressRuNumber());
        $apiResponse = $this->apiTransmitter->transmitMethod($printInvoiceMethod);

        /* @var $apiResponse \ExpressRuSDK\API\Responses\PrintInvoiceApiResponse */
        if (!$apiResponse->isSuccess() and $apiResponse->isNotFound()) {
            return null;
        }
        return $apiResponse->getPDF();
    }


    /**
     * @param ExpressRuOrderInterface $order
     * @param $directory
     * @param null $name
     * @param string $ext
     * @param bool|true $rewrite
     * @return string
     * @throws \Exception
     */
    public function saveInvoicePDFForOrderOnDisk(ExpressRuOrderInterface $order, $directory, $name = null, $ext = 'pdf', $rewrite = true)
    {
        if (!is_dir($directory) OR !is_writable($directory)) {
            throw new \Exception(sprintf('Directory %s must be writable', $directory));
        }

        $directory = realpath($directory);

        if (!$name) {
            $name = 'ExpressRuInvoice_' . $order->getExpressRuNumber();
        }

        $invoicePDF = $this->getInvoicePDFForOrder($order);

        if(!$invoicePDF) {
            return null;
        }

        $filename = DIRECTORY_SEPARATOR . trim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $name . '.' . $ext;

        if (file_exists($filename) && !$rewrite) {
            throw new \Exception(sprintf('File %s is already exists', $filename));
        }

        file_put_contents($filename, $invoicePDF);

        return $filename;
    }

}