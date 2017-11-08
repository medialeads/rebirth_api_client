# EUROPEAN SOURCING API V2 CLIENT
*PHP > 5.6, PHP 7*

Once you have an access token to the European Sourcing API you can use 
this API Client to make your calls and easily transform your JSON data 
to objects.

## Simple Use

You can use one of the two basic method of the Client object to make quick calls and retrieve 
instantly all the data as object instances.  

### searchProductsByQuery()
First, you have the `searchProductsByQuery()` method.
With this, you can perform a simple request with only a query handler. Only the first argument is mandatory.

```php
$client = new Client("token", 'lang');

// simple search with only query search handler
$products = $client->searchProductsByQuery($query = "stylo", $page = 1, $offset = 0, $limit = 20, $sort_direction = 'asc');

// here, $products contains an array of Product objects, containing Variant objects, etc...
```

### searchProductsBy()
The second method is the `searchProductsBy()` method. It is the same as the previous one,
but takes the `$handlers` argument instead of `$query`. All other arguments are the same as in
`searchProductsByQuery()`.  
  
If you have seen how the API works, you should know the POST parameters takes a 
search_handlers array.  
Be careful ! `$handlers` is an array of handlers, and a handler is an array. $handlers must be 
an array of arrays, even if there is only one search handler.
```php
$client = new Client("token", 'lang');

$handlers = array(
    array(
        'query' => 'watch'
        'stock_greater_than' => 5
    )
);
$products = $client->searchProductsBy($handlers);
```
Please check the API documentation or demo to have a full preview of all filters available.

## Complex Use

The API Client implements Transformer classes you can statically call to transform an array 
into a Product, Variant, Supplier, etc... object. Everything inside your array will be 
transformed.  
Consider you have an array which should be a Product object and inside of it, you have all 
variants
as arrays. Using the Product transformer will also convert every variant inside as Variant 
objects.
  
In the example below, we consider you have performed a custom request to the API. Your 
response contains a `products` key. We put that in `$products`.
```php
$productsAsObjects = ProductTransformer::fromArray($products);
```
Here, `$productsAsObjects` contains an array of Product objects (even if there is only one).
Variants, SupplierProfile and all others have also been transformed from arrays to objects 
thank to this simple call.
  
For better support, `$products` can be an array of arrays (the products), or a simple array 
(the product).
  
You can use any Transformer you need as above. One is calling all necessary others. So when 
you
call the ProductTransformer, all other transformers are called inside of it (such as 
VariantTransformer, which is also calling others).
  
You can find the complete list of Transformers inside the `Transformer` folder.