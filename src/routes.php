<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \App\Models\User;
use \App\Models\Address;
use \App\Models\City;
use \App\Models\Computerskill;
use \App\Models\Education;
use \App\Models\Experience;
use \App\Models\Otherskill;
use \App\lib\GitHub;

// Routes
$app->get('/info', function (Request $request, Response $response, array $args) {
    $this->logger->info("GET /info");
    
    // Render info view
    return $this->renderer->render($response, 'info.phtml', $args);
});
$app->get('/getstarted', function (Request $request, Response $response, array $args) {

    // Render index view
    return $this->renderer->render($response, 'getstarted.phtml', $args);
});
$app->get('/aboutus', function (Request $request, Response $response, array $args) {

    // Render index view
    return $this->renderer->render($response, 'aboutus.phtml', $args);
});
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    $this->logger->info("GET /");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->post('/cvs', function (Request $request, Response $response, array $args) {
    $this->logger->info("POST /cvs");

    $address = new Address();
    $address->street = $request->getParam('street');
    $address->nr = $request->getParam('nr');
    $address->zip = $request->getParam('zip');
    $address->city = $request->getParam('city');
    $address->save();

    $education = new Education();
    $education->education = $request->getParam('education');
    $education->place = $request->getParam('placeEdu');
    $education->institute = $request->getParam('institute');
    $education->fromEdu = $request->getParam('fromEdu');
    $education->untilEdu = $request->getParam('untilEdu');
    $education->information = $request->getParam('informationEdu');
    $education->save();

    $experience = new Experience();
    $experience->functionExp = $request->getParam('functionExp');
    $experience->place = $request->getParam('placeExp');
    $experience->employer = $request->getParam('employer');
    $experience->fromExp = $request->getParam('fromExp');
    $experience->untilExp = $request->getParam('untilExp');
    $experience->information = $request->getParam('informationExp');
    $experience->save();

    $computerskill = new Computerskill();
    $computerskill->skill = $request->getParam('computerskill');
    $computerskill->level = $request->getParam('computerlevel');
    $computerskill->save();

    $otherskill = new Otherskill();
    $otherskill->skill = $request->getParam('otherskill');
    $otherskill->level = $request->getParam('otherlevel');
    $otherskill->save();

    $user = new User();
    $user->firstname = $request->getParam('firstname');
    $user->lastname = $request->getParam('lastname');
    $user->email = $request->getParam('email');
    $user->phonenumber = $request->getParam('phonenumber');
    $user->birthdate = $request->getParam('birthdate');
    $user->birthplace = $request->getParam('birthplace');
    $user->githubusername = $request->getParam('githubUsername');
    $user->githubToken = $request->getParam('githubToken');
    $user->addresses_id = $address->id;
    $user->educations_id = $education->id;
    $user->experiences_id = $experience->id;
    $user->computerskills_id = $computerskill->id;
    $user->otherskills_id = $otherskill->id;
    $user->save();
    
    
    // Render overview view
    return $this->renderer->render($response, 'overview.phtml', $args);
});
