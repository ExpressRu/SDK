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
 * Class AbstractEntity
 * @package ExpressRuSDK\Model\Entities
 */
abstract class AbstractEntity
{

    /**
     *
     */
    const getterPrefix = 'get';
    /**
     *
     */
    const isPrefix = 'is';
    /**
     *
     */
    const setterPrefix = 'set';
    /**
     *
     */
    const shortName = '';
    /**
     *
     * @var integer
     */
    protected $id = NULL;
    /**
     * @var AbstractEntityMetadata
     */
    protected $entityMetadataObject;
    /**
     *
     * @var AbstractEntity
     */
    protected $original;

    /**
     * @param AbstractEntityMetadata|null $entityMetadataObject
     */
    public function __construct(AbstractEntityMetadata $entityMetadataObject = null)
    {
        $this->entityMetadataObject = $entityMetadataObject;
    }

    /**
     * @return string Class Name
     */
    public static function getClassName()
    {
        return get_called_class();
    }

    /**
     *
     */
    public function __clone()
    {
        $this->id = null;
    }

    /**
     * @return AbstractEntity
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     *
     */
    public function snapshotOriginal()
    {
        $this->original = clone $this;
        $this->original->setId($this->getId());
    }

    /**
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function setId($id)
    {
        if (!$id) {
            return;
        }
        if ($this->id AND $id != $this->id) {
            throw new \Exception('Айди уже установлен :oldid -> :id', array(':oldid' => $this->id, ':id' => $id));
        }
        $this->id = $id;
    }

    /**
     *
     * @return array
     */
    public function getAsArray()
    {
        return get_object_vars($this);
    }

    /**
     *
     * @param array $array
     * @return \ExpressRuSDK\Model\Entities\AbstractEntity
     */
    public function setPropertiesFromArray(array $array)
    {
        $this->checkEntityMetadataObject();
        $properties = $this->entityMetadataObject->getPropertiesFieldsNames();
        foreach ($array as $key => $value) {

            if ($value === null) {
                continue;
            }

            $setter = self::setterPrefix . ucfirst($key);
            if (method_exists($this, $setter) && in_array($key, $properties)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    /**
     *
     * @throws \Exception
     */
    protected function checkEntityMetadataObject()
    {
        if (!$this->entityMetadataObject instanceof AbstractEntityMetadata) {
            throw new \Exception('Set Entity Metadata First');
        }
    }

    /**
     * @param array $array
     * @return $this
     */
    public function setFromArray(array $array)
    {
        foreach ($array as $key => $value) {
            $setter = self::setterPrefix . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getChangedProperties()
    {
        if (!$this->original) {
            throw new \Exception('No original snapshot taken');
        }
        $diff = array_diff_assoc($this->getPropertiesAsArray(), $this->original->getPropertiesAsArray());
        return $diff;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getPropertiesAsArray()
    {
        $this->checkEntityMetadataObject();
        $returnArray = array();
        $pFN = $this->entityMetadataObject->getPropertiesFieldsNames();
        foreach ($pFN as $property) {

            $getter = self::getterPrefix . ucfirst($property);

            if (!method_exists($this, $getter)) {
                $getter = self::isPrefix . ucfirst($property);
            }

            if (method_exists($this, $getter)) {
                $returnArray[$property] = $this->$getter();
            }
        }

        return $returnArray;
    }

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return (string)self::shortName . $this->id;
    }
}
