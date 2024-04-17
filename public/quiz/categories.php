<?php
class Categories
{
    private $api;

    public function __construct($api)
    {
        $this->api = $api;
    }

    public function getQuestions($category)
    {
        $questions = $this->api->getQuestions(10, $category);
        return $questions;
    }
}