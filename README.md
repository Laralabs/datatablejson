# DataTableJson for Laravel

This package aims to simplify the process of creating JSON data for DataTable components.

Recently I started using a Vue DataTable component and found that I needed a simple way of formatting and passing the data into the view to keep everything tidy.

## Installation

Install the package via compser

```json
{
    "require": {
      "laralabs/datatablejson": "~1.0.0"     
    }
}
```

Once you have updated composer, add the Service Provider to your `providers` array within `config/app.php`

```php
'providers' => [
    Laralabs\DataTableJson\DataTableJsonServiceProvider::class
];
```

Now you can publish the config file to `config/datatablejson.php`

```
php artisan vendor:publish --tag=config
```

Edit the published configuration file to suit your application. 

>**It is recommended that you change the namespace from the default 'window'**

## Usage

Add the trait to the top of your Eloquent Model

```php
use DataTableJsonTrait;
```

Add `public $columns = []` to your model, this defines the columns that will be used in the table. 

Here is an example of a populated `$columns` array:

```php
    public $columns = [
        [
            "label" => "ID",
            "field" => "id",
            "searchable" => true,
            "orderable" => true
        ],
        [
            "label" => "First Name",
            "field" => "first_name",
            "searchable" => true,
            "orderable" => true
        ],
        [
            "label" => "Actions",
            "field" => "actions",
            "searchable" => false,
            "orderable" => false,
            "html" => true,
            "content" => '<a class="btn waves-light waves-effect" href="/admin/users/edit/{id}">
                            <i class="fa fa-pencil"></i>
                        </a>'
        ]
    ];
```

The `Actions` column in the example shows how you create columns that can include HTML snippets, pull in data from other fields by using `{field_name}`

Once the columns have been defined you can then create a collection and apply the conversion function.

```php
$users = Users::all();
$users->toDataTableJson();
```

This will build up the data and prepend it to the view that you specified in the configuration file.

Got a special case and need a different set of fields?
You can pass a `$columns` array to this function which will override the columns specified in the model.

```php
$columns = [
    [
      "....." => "...."
    ]
]
$users = Users::all();
$users->toDataTableJson($columns);
```

> This package is designed to work well with [MicroDroid/vue-materialize-datatable](https://github.com/MicroDroid/vue-materialize-datatable)

## Credits

Thanks to Jeffrey Way over at Laracasts for his awesome [Laracasts/PHP-Vars-To-Js-Transformer](https://github.com/laracasts/PHP-Vars-To-Js-Transformer) package which allowed me to include the view binding functionality.

## Support

Please raise an issue on Github if there is a problem.

## License

This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).