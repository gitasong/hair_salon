<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    // renders single stylist template with all clients
    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    // renders form to edit/delete single stylist
    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('edit_stylist.html.twig', array('stylist' => $stylist));
    });

    // renders form to edit/delete single stylist FROM BUTTON/FORM
    $app->post("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('edit_stylist.html.twig', array('stylist' => $stylist));
    });

    // form handler for edit_stylist.html (edit/delete stylist); returns one to view stylist/add clients
    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/delete_stylists", function() use ($app) {
      Stylist::deleteAll();
      return $app['twig']->render('stylists.html.twig');
    });

    $app->get("/clients", function() use ($app) {
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });

    $app->post("/clients", function() use ($app) {
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($name, $stylist_id, $id = null);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    // renders single client template
    $app->get("/client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client.html.twig', array('client' => $client));
    });

    // renders form to edit/delete single client
    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('edit_client.html.twig', array('client' => $client));
    });

    // renders form to edit/delete single client FROM BUTTON/FORM
    $app->post("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('edit_client.html.twig', array('client' => $client));
    });

    // form handler for edit_client.html (edit/delete cliet); returns one to view/add clients
    $app->patch("/clients/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];  // needs to grab data from new stylist field
        $client = Client::find($id);
        $client->update($name, $stylist_id);  // update also w/new stylist ID
        return $app['twig']->render('client.html.twig', array('client' => $client));
    });

    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('clients.html.twig');
    });

    $app->delete("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->delete();
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });

    return $app;

?>
