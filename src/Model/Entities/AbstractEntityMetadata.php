<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities;

/**
 * Class AbstractEntityMetadata
 * @package ExpressRuSDK\Model\Entities
 */
abstract class AbstractEntityMetadata
{

    /**
     * @var
     */
    protected $shortName;


    /**
     *
     * @var array
     */
    protected $propertiesFieldsNames = array();

    /**
     *
     */
    public function __construct()
    {
        $this->definePropertiesFieldsNames();
    }

    /**
     * @return mixed
     */
    abstract protected function definePropertiesFieldsNames();

    /**
     * @return mixed
     */
    abstract public function getEntityClassName();

    /**
     *
     * @return array
     */
    public function getPropertiesFieldsNames()
    {
        return $this->propertiesFieldsNames;
    }

    /**
     *
     * @param array $propertiesFieldsNames
     */
    protected function setPropertiesFieldsNames($propertiesFieldsNames)
    {
        $this->propertiesFieldsNames = array_merge($this->propertiesFieldsNames, $propertiesFieldsNames);
    }

    /**
     *
     * @return \Model\AggregationSchemeRoot
     */
    public function getAggregationScheme()
    {
        return $this->scheme;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param $fieldName
     * @return bool
     */
    public function hasPrimaryField($fieldName)
    {
        return in_array($fieldName, $this->propertiesFieldsNames);
    }
}
