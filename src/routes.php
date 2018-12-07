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
    $test_url = 'https://jop-todo.herokuapp.com/';
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
    $placeEdus = $request->getParam('placeEdu');
    $institutes = $request->getParam('institute');
    $fromEdus = $request->getParam('fromEdu');
    $untilEdus = $request->getParam('untilEdu');
    $informationEdus = $request->getParam('informationEdu');

    for($i=0;$i<count($educations);$i++){
        $arr['educations'] = $educations[$i];
        $arr['placeEdus'] = $placeEdus[$i];
        $arr['institutes'] = $institutes[$i];
        $arr['fromEdus'] = $fromEdus[$i];
        $arr['untilEdus'] = $untilEdus[$i];
        $arr['informationEdus'] = $informationEdus[$i];
        array_push($educationarray,$arr);
    }

    foreach($educationarray as $key => $value){ 
        $education = new Education();
        $education->education = $value['educations'];
        $education->place = $value['placeEdus'];
        $education->institute = $value['institutes'];
        $education->fromEdu = $value['fromEdus'];
        $education->untilEdu = $value['untilEdus'];
        $education->information = $value['informationEdus'];
        $education->users_id = $user->id;
        $education->save();
        $args['education'][$i] = $education->education;
        $args['placeEdu'] = $education->place;
        $args['institute'] = $education->institute;
        $args['fromEdu'] = $education->fromEdu;
        $args['untilEdu'] = $education->untilEdu;
        $args['informationEdus'] = $education->informationEdus;
    }
    
    $experiencearray = array();
    $experiences= $request->getParam('functionExp');
    $placeExps = $request->getParam('placeExp');
    $employers = $request->getParam('employer');
    $fromExps = $request->getParam('fromExp');
    $untilExps = $request->getParam('untilExp');
    $informationExps = $request->getParam('informationExp');

    for($i=0;$i<count($experiences);$i++){
        $arr['experiences'] = $experiences[$i];
        $arr['placeExps'] = $placeExps[$i];
        $arr['employers'] = $employers[$i];
        $arr['fromExps'] = $fromExps[$i];
        $arr['untilExps'] = $untilEdus[$i];
        $arr['informationExps'] = $informationExps[$i];
        array_push($experiencearray,$arr);
    }

    foreach($experiencearray as $key => $value){ 
        $experience = new Experience();
        $experience->functionExp = $value['experiences'];
        $experience->place = $value['placeExps'];
        $experience->employer = $value['employers'];
        $experience->fromExp = $value['fromExps'];
        $experience->untilExp = $value['untilExps'];
        $experience->information = $value['informationExps'];
        $experience->users_id = $user->id;
        $experience->save();
        $args['functionExp'] = $experience->functionExp;
        $args['placeExp'] = $experience->place;
        $args['employer'] = $experience->employer;
        $args['fromExp'] = $experience->fromExp;
        $args['untilExp'] = $experience->untilExp;
        $args['informationExp'] = $experience->informationExp;

    }

    $computerskillarray = array();
    $computerskills= $request->getParam('computerskill');
    $computerlevels = $request->getParam('computerlevel');

    for($i=0;$i<count($computerskills);$i++){
        $arr['computerskills'] = $computerskills[$i];
        $arr['computerlevels'] = $computerlevels[$i];
        array_push($computerskillarray,$arr);
    }

    foreach($computerskillarray as $key => $value){ 
        $computerskill = new Computerskill();
        $computerskill->skill = $value['computerskills'];
        $computerskill->level = $value['computerlevels'];
        $computerskill->users_id = $user->id;
        $computerskill->save();
        $args['computerskill'] = $computerskill->skill;
        $args['computerlevel'] = $computerskill->level;
    }

    $otherskillarray = array();
    $otherskills= $request->getParam('otherskill');
    $otherlevels = $request->getParam('otherlevel');

    for($i=0;$i<count($otherskills);$i++){
        $arr['otherskills'] = $otherskills[$i];
        $arr['otherlevels'] = $otherlevels[$i];
        array_push($otherskillarray,$arr);
    }

    foreach($otherskillarray as $key => $value){ 
        $otherskill = new Otherskill();
        $otherskill->skill = $value['otherskills'];
        $otherskill->level = $value['otherlevels'];
        $otherskill->users_id = $user->id;
        $otherskill->save();
        $args['otherskill'] = $otherskill->skill;
        $args['otherlevel'] = $otherskill->level;
    }


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
    return $this->renderer->render($response, 'cv.phtml', $args);
});


