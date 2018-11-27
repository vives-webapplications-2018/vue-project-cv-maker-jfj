<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \App\Models\User;
use \App\Models\Address;
use \App\Models\Computerskill;
use \App\Models\Education;
use \App\Models\Experience;
use \App\Models\Otherskill;
use \App\lib\GitHub\GitHub;

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

$app->get('/cv', function (Request $request, Response $response, array $args) {

    // Render index view
    return $this->renderer->render($response, 'cv.phtml', $args);
});

$app->get('/createcv', function (Request $request, Response $response, array $args) {
    $api_endpoint = "https://selectpdf.com/api2/convert/";
    $key = '84e33984-bb8a-46c1-89ca-f1f184de52c9';
    $test_url = 'https://nl.lipsum.com/';
    $local_file = 'cvs/test41.pdf';
 
    $parameters = array ('key' => $key, 'url' => $test_url);
    // Sample GET
    
    $result = @file_get_contents("$api_endpoint?" . http_build_query($parameters));
    
    if (!$result) {	
        echo "HTTP Response: " . $http_response_header[0] . "<br/>";
    
        $error = error_get_last();
        echo "Error Message: " . $error['message'];
    }
    else {
        // Write on file
        file_put_contents($local_file, $result);
        //echo "HTTP Response: " . $http_response_header[0] . "<br/>";
    }
    return $this->renderer->render($response, 'cv.phtml', $args);

    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
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
    $args['streetname'] = $address->street;
    $address->nr = $request->getParam('nr');
    $args['nr'] = $address->nr;
    $address->zip = $request->getParam('zip');
    $args['zip'] = $address->zip;
    $address->city = $request->getParam('city');
    $args['city'] = $address->city;
    $address->save();

    $user = new User();
    $user->firstname = $request->getParam('firstname');
    $args['firstname'] = $user->firstname;
    $user->lastname = $request->getParam('lastname');
    $args['lastname'] = $user->lastname;
    $user->email = $request->getParam('email');
    $args['email'] = $user->email;
    $user->phonenumber = $request->getParam('phonenumber');
    $args['phonenumber'] = $user->phonenumber;
    $user->birthdate = $request->getParam('birthdate');
    $args['birthdate'] = $user->birthdate;
    $user->birthplace = $request->getParam('birthplace');
    $args['birthplace'] = $user->birthplace;
    $user->githubusername = $request->getParam('githubUsername');
    $user->githubtoken = $request->getParam('githubToken');
    $user->addresses_id = $address->id;
    $user->save();


    
    $educationarray = array();
    $educations= $request->getParam('education');
    $places = $request->getParam('placeEdu');
    $institutes = $request->getParam('institute');
    $fromEdus = $request->getParam('fromEdu');
    $untilEdus = $request->getParam('untilEdu');
    $informations = $request->getParam('informationEdu');

    for($i=0;$i<count($educations);$i++){
        $arr['educations'] = $educations[$i];
        $arr['places'] = $places[$i];
        $arr['institutes'] = $institutes[$i];
        $arr['fromEdus'] = $fromEdus[$i];
        $arr['untilEdus'] = $untilEdus[$i];
        $arr['informations'] = $informations[$i];
        array_push($educationarray,$arr);
    }
    foreach($educationarray as $key => $value){ 
        $education = new Education();
        $education->education = $value['educations'];
        $education->place = $value['places'];
        $education->institute = $value['institutes'];
        $education->fromEdu = $value['fromEdus'];
        $education->untilEdu = $value['untilEdus'];
        $education->information = $value['informations'];
        $education->users_id = $user->id;
        $education->save();
        $args['education'] = $education->education;
        $args['placeEdu'] = $education->place;
        $args['institute'] = $education->institute;
        $args['fromEdu'] = $education->fromEdu;
        $args['untilEdu'] = $education->untilEdu;
        $args['informationEdu'] = $education->informationEdu;
    }
    

    $experience = new Experience();
    $experience->functionExp = $request->getParam('functionExp');
    $args['functionExp'] = $experience->functionExp;
    $experience->place = $request->getParam('placeExp');
    $args['placeExp'] = $experience->place;
    $experience->employer = $request->getParam('employer');
    $args['employer'] = $experience->employer;
    $experience->fromExp = $request->getParam('fromExp');
    $args['fromExp'] = $experience->fromExp;
    $experience->untilExp = $request->getParam('untilExp');
    $args['untilExp'] = $experience->untilExp;
    $experience->information = $request->getParam('informationExp');
    $args['informationExp'] = $experience->informationExp;
    $experience->users_id = $user->id;
    $experience->save();

    $computerskill = new Computerskill();
    $computerskill->skill = $request->getParam('computerskill');
    $args['computerskill'] = $computerskill->skill;
    $computerskill->level = $request->getParam('computerlevel');
    $args['computerlevel'] = $computerskill->level;
    $computerskill->users_id = $user->id;
    $computerskill->save();

    $otherskill = new Otherskill();
    $otherskill->skill = $request->getParam('otherskill');
    $otherskill->level = $request->getParam('otherlevel');
    $otherskill->users_id = $user->id;
    $otherskill->save();

    $github = new GitHub($user->githubusername,$user->githubtoken);
    $githubdata = $github->getPercentage($github->getData());
    $args['githubdata'] = $githubdata;
    foreach($githubdata as $language=>$value)
    {
        $githubskill = new Computerskill();
        $githubskill->skill = $language;
        $githubskill->level=$value;
        $githubskill->users_id = $user->id;
        $githubskill->save();
    };

    // Render overview view
    return $this->renderer->render($response, 'overview.phtml', $args);
});


