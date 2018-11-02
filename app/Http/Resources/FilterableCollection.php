<?php
/**
 * Created by PhpStorm.
 * User: shahid
 * Date: 2018-11-02
 * Time: 01:28
 */

namespace App\Http\Resources;


trait FilterableCollection
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $withFields = [];

    /**
     * Set the keys to be exposed.
     *
     * @param array $fields
     * @return $this
     */
    public function includeFields(array $fields)
    {
        $this->withFields = $fields;

        return $this;
    }
}