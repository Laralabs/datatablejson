<?php

namespace Laralabs\DataTableJson;

use Laralabs\DataTableJson\Collections\DataTableCollection;

trait DataTableJsonTrait {

    protected $params;

    public function newCollection(array $models = [])
    {
        $this->params['items'] = $models;
        $this->params['model'] = $this;

        return new DataTableCollection($this->params);
    }
}