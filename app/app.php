<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Home, bifurcates to view stores or brands

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

   //BRAND ROUTES

   //Brands home GET, lists all brands and allows adding a brand. Pass in: ALL BRANDS
    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array("brands" => Brand::getAll()));
    });

    //Brands home POST, for sumbitting a new brand. Pass in: ALL BRANDS
    $app->post("/brands", function() use ($app) {
        $name = $_POST['name'];
        $new_brand = new Brand($name);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array("brands" => Brand::getAll()));
    });

    //Brands home POST, to delete all brands. Pass in: ALL BRANDS
    $app->post("/delete_brands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array("brands" => Brand::getAll()));
    });

    // Brand detail GET to display name of brand and form to add store Pass in: ALL STORES, BRAND STORES, BRAND
    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array("all_stores" => Store::getAll(), "brand_stores" => $brand->getStores(), "brand" => $brand));
    });
    //Brand detail POST to add a store and return to brand detail
    $app->post("/add_store", function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array("all_stores" => Store::getAll(), "brand_stores" => $brand->getStores(), "brand" => $brand));
    });

    //STORE ROUTES

    //Stores home GET, contains list of all stores and form to add new stores
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array("stores" => Store::getAll()));
    });

    //Stores home POST, adds new store and returns to stores home
    $app->post("/stores", function() use ($app) {
        $name = $_POST['name'];
        $new_store = new Store($name);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array("stores" => Store::getAll()));
    });

    //Stores home POST to delete all stores.
    $app->post("/delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array("stores" => Store::getAll()));
    });

    //Store detail GET, displays store name, forms to add brands, delete or edit.
    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array("all_brands" => Brand::getAll(), "store_brands" => $store->getBrands(), "store" => $store));
    });

    //store detail POST to add a brand and return store detail
    $app->post("/add_brand", function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array("all_brands" => Brand::getAll(), "store_brands" => $store->getBrands(), "store" => $store));
    });

    //store detail PATCH to update store, return to store detail
    $app->patch("/update_store/{id}", function($id) use ($app){
        $store = Store::find($id);
        $new_name = $_POST['name'];
        $store->update($new_name);
        return $app['twig']->render('store.html.twig', array("all_brands" => Brand::getAll(), "store_brands" => $store->getBrands(), "store" => $store));
    });


    //store detail DELETE to delete individual store. return to stores home

    return $app;
 ?>
