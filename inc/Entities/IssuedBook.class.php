<?php

class IssuedBook
{
    private $Books_ISBN;
    private $CustomerID;
    private $dateTime;
    

    //getters
    function getBooksISBN() : string
    {
        return $this->Books_ISBN;
    }
    function getCustomerID(): int
    {
        return $this->CustomerID;
    }
    function getDateTime(): string
    {
        return $this->dateTime;
    }
    
    //setters

    function setBooksISBN($newISBN)
    {
        $this->Books_ISBN = $newISBN;
    }
    
    function setCustomerID($newCustomerID)
    {
        $this->CustomerID = $newCustomerID;
    }

    function setDateTime($newDateTime)
    {
        $this->dateTime = $newDateTime;
    }

}
?>