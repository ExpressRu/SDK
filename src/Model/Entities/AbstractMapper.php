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
 * Class AbstractMapper
 * @package ExpressRuSDK\Model\Entities
 */
abstract class AbstractMapper
{

    /**
     *
     * @var \ExpressRuSDK\Model\Entities\AbstractEntityMetadata
     */
    protected $entityMetadataObject;

    /**
     * @var string
     */
    protected $entityClassName;

    /**
     * @var string
     */
    protected $entityShortName;

    /**
     * @param AbstractEntityMetadata $entityMetadataObject
     */
    function __construct(AbstractEntityMetadata $entityMetadataObject)
    {
        $this->entityMetadataObject = $entityMetadataObject;
        $this->entityClassName = $entityMetadataObject->getEntityClassName();
        $this->entityShortName = $entityMetadataObject->getShortName();
    }

    /**
     * @return mixed|string
     */
    public function getEntityShortName()
    {
        return $this->entityShortName;
    }


    /**
     * @param $entity
     * @return array
     * @throws \Exception
     */
    public function getAsArray($entity)
    {
        $resultArray = array();
        foreach ($this->entityMetadataObject->getPropertiesFieldsNames() as $property) {
            $getter = AbstractEntity::getterPrefix . ucfirst($property);
            if (method_exists($entity, $getter)) {
                $resultArray[$property] = $entity->$getter();
            } else {
                throw new \Exception('No Getter for Property ' . $property);
            }
        }
        return $resultArray;
    }


    /**
     * @param AbstractEntity $entity
     * @param array $array
     */
    protected function mapEntityFromArray(AbstractEntity $entity, array $array)
    {
        $entity->setPropertiesFromArray($array);
    }
}
