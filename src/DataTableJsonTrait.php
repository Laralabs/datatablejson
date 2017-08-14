<?php

namespace Laralabs\DataTableJson;

use Laralabs\DataTableJson\Collections\DataTableCollection;

trait DataTableJsonTrait {

    protected $model;

    protected $params;

    public function __construct()
    {
        $this->model = $this;
        $this->params = [
            'model' => $this->model
        ];
    }

    public function newCollection(array $models = [])
    {
        $this->params['items'] = $models;

        return new DataTableCollection($this->params);
    }
}