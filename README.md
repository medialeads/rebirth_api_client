#EUROPEAN SOURCING API V2 CLIENT

Once you have an access token to the European Sourcing API you can use 
this API Client to make your calls and easily transform your JSON data 
to objects.

##Simple Use

You can use one of the two basic functions of the Client to make quick calls and retrieve 
instantly all the data as object instances.

```php
$client = new Client("token", 'lang');
// simple search with only query search handler
$products = $client->searchProductsByQuery($string = stylo, $page = 1, $offset = 0, $limit = 20, $sort_direction = 'asc');

$handlers = array(
    array(
        'query' => 'sac'
    )
);
$products = $client->searchProductsBy($handlers);
```
