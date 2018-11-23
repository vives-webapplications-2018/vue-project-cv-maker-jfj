<?php

namespace App\lib\GitHub;


class GitHub
{
    public function __construct($githubUsername,$token)
    {
        $this->githubUsername = $githubUsername;
        $this->token = $token;
        $this->authentication($token);
    }

    public function authentication(){
        $this->auth = base64_encode($this->token);
        $this->opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP',
                    "Authorization: Basic $this->auth",
                ],
            ],
        ];


    }

    public function createJSONRepos()
    {
        $context = stream_context_create($this->opts);
        $content = file_get_contents("http://api.github.com/user/repos?type=all", false, $context);
        $this->decodeContent($content);
    }

    public function createJSONLanguage($repos)
    {
        $context = stream_context_create($this->opts);
        $content = file_get_contents("https://api.github.com/repos/$repos/languages", false, $context);
        $this->decodeContent($content);
    }

    
    public function decodeContent($content)
    {
        $this->json = json_decode($content);

    }

    public function getData()
    {
        $this->totalvalue=0;
        $this->createJSONRepos();
        $this->repos = $this->json;
        $nonpercentagearray=array();
        foreach ($this->repos as $repo => $value) {
            $name = $value->full_name;
            $languages = $this->getLanguages($name);
            foreach ($languages as $language => $value){
                error_reporting(0);
                $nonpercentagearray[$language]+=$value;
                error_reporting(-1);
                $this->totalvalue += $value;
 
            }

        }
        return $nonpercentagearray;
    }

    public function calculatePercentage($language,$value)
    {
        $cvalue=round((($value/$this->totalvalue)*100),2);
        return $cvalue;
    }

    public function getPercentage($languages)
    {
        $percentagearray=array();
        foreach($languages as $language =>$value)  
        {
            $percentagevalue=$this->calculatePercentage($language,$value);
            $percentagearray[$language]=$percentagevalue;
        } 
        return $percentagearray;
    }

    public function getLanguages($names)
    {
        $this->createJSONLanguage($names);
        $languages = $this->json;
        return $languages;   
    }






}