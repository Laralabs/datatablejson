<?php

namespace Laralabs\DataTableJson\Collections;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;
use Laralabs\DataTableJson\DataTableJsonConverter;
use Laralabs\DataTableJson\Facades\DataTableJsonFacade;

class DataTableCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * Convert collection to JSON and bind to view
     *
     * @param array $columns
     * @return string JSON
     */
    public function toDataTableJson(array $columns = [])
    {
        if($this->items) {
            $item = current($this->items);
            $modelColumns = $item->columns;
        }else{
            $modelColumns = [];
        }

        $columns = empty($columns) ? $modelColumns : $columns;

        if(empty($columns)) {
            abort(500, 'No columns specified in model or function argument');
        }

        $collection = $this->keyBy('id')->map(function ($item) use ($columns) {
            $maps = [];
            foreach($columns as $column) {
                if(!empty($column['content'])) {
                    $regex = preg_match_all('/\{(.+?)\}/', $column['content'], $matches);
                    if($regex > 0) {
                        for ($i = 0; $i < $regex; $i++) {
                            $field = $matches[1][$i];
                            $search = $matches[0][$i];
                            $column['content'] = str_replace($search, $item[$field], $column['content']);
                        }
                    }
                    $maps[$column['field']] = $column['content'];
                }else{
                    $maps[$column['field']] = $item[$column['field']];
                }
            }
            return $maps;
        });

        $collection = $collection->toArray();
        $collection = array_values($collection);

        $put = DataTableJsonFacade::put([
            'data' => [
                'columns' => $columns,
                'rows'    => $collection
            ]
        ]);

        return $put;
    }
}