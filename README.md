# EUROPEAN SOURCING API V2 CLIENT

Once you have an access token to the European Sourcing API you can use 
this API Client to make your calls and easily transform your JSON data 
to objects.

## Simple Use

You can use one of the two basic method of the Client object to make quick calls and retrieve 
instantly all the data as object instances.  
For these two methods, only the first argument is mandatory.  
First, you have the `searchProductsByQuery()` method.
With this, you can perform a simple request with only a query handler.

```php
$client = new Client("token", 'lang');

// simple search with only query search handler
$products = $client->searchProductsByQuery($query = stylo, $page = 1, $offset = 0, $limit = 20, $sort_direction = 'asc');

// here, $products contains an array of Product objects, containing Variant objects, etc...
```

The second method is the `searchProductsBy()` method. It is the same as the previous one,
but takes the `$handlers` argument instead of `$query`. If you have seen how the API works,
you should know the POST parameters takes a search_handlers array.  
Be careful ! `$handlers` is an array of handlers, and a handler is an array. $handlers must be 
an array of arrays, even if there is only one search handler.
```php
$client = new Client("token", 'lang');

$handlers = array(
    array(
        'query' => 'sac'
        'stock_greater_than' => 5
    )
);
$products = $client->searchProductsBy($handlers);
```
