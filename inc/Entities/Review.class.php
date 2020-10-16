<?php

class Review
{
    private $BookISBN;
    private $review;

    public function getBookISBN()
    {
        return $this->BookISBN;
    }

    public function getReview()
    {
        return $this->review;
    }

    public function setBookISBN($newISBN)
    {
        $this->BookISBN = $newISBN;
    }

    public function setReview($newReview)
    {
        $this->review = $newReview;
    }

    function jsonSerialize() : stdClass    {

        //Serialize customer
        $obj = new stdClass;
        $obj->isbn = $this->BookISBN;
        $obj->review = $this->review;
    
        return $obj;
        }
}


?>