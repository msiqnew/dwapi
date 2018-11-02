<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractFilterableResource extends JsonResource
{
    /**
     * All of default exposed fields
     *
     * @var array
     */
    protected $fields;

    /**
     * All of default exposed fields
     *
     * @var array
     */
    protected $withFields;

    /**
     * @var array
     */
    protected $withoutFields = [];

    /**
     * Set the keys to be exposed.
     *
     * @param array $fields
     * @return $this
     */
    public function includeFields(array $fields)
    {
        $this->fields = $fields;

        if (!empty($fields['fields'])) {
            $this->withoutFields = array_diff($this->withFields, $fields['fields']);
        }

        return $this;
    }

    /**
     * filter the fields
     *
     * @param array $fields
     * @return array
     */
    protected function filterFields(array $fields)
    {
        return collect($fields)->forget($this->withoutFields)->toArray();
    }

    protected function relatedEntityFields(string $relatedEntity)
    {
        if (array_key_exists($relatedEntity, $this->fields)) {
            return $this->fields[$relatedEntity];
        }

        return [];
    }
}
