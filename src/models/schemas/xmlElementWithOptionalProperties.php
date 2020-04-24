<?php

namespace migvitram\xmlgenerator\models\schemas;

trait xmlElementWithOptionalProperties
{
    /** @var array $optionalProperties */
    protected $optionalProperties = [];

    /**
     * @return bool
     */
    public function hasOptionalProperties()
    {
        return !empty($this->optionalProperties);
    }

    /**
     * @return array
     */
    public function getOptionalPropertiesNames()
    {
        return array_keys($this->optionalProperties);
    }
}