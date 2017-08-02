<?php

namespace Laralabs\DataTableJson;

use Laralabs\DataTableJson\Collections\DataTableCollection;

trait DataTableJsonTrait {

    public function newCollection(array $models = [])
    {
        return new DataTableCollection($models);
    }
}