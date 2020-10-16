<?php

class Book
{
    private $Books_ISBN;
    private $Name;
    private $Author;
    private $Publisher;
    private $IssuedBookFlag;
    private $ReturnBookCount;

    //getters
    function getBooksISBN() : string
    {
        return $this->Books_ISBN;
    }
    function getName(): string
    {
        return $this->Name;
    }
    function getAuthor(): string
    {
        return $this->Author;
    }
    function getPublisher(): string 
    {
        return $this->Publisher;
    }
    function getIssuedBookFlag(): int
    {
        return $this->IssuedBookFlag;
    }
    function getReturnBookCount(): string 
    {
        return $this->ReturnBookCount;
    }

    //setters

    function setBooksISBN($newISBN)
    {
        $this->Books_ISBN = $newISBN;
    }
    
    function setName($newName)
    {
        $this->Name = $newName;
    }

    function setAuthor($newAuthor)
    {
        $this->Author = $newAuthor;
    }

    function setPublisher($newPublisher)
    {
        $this->Publisher = $newPublisher;
    }

    function setIssuedBookFlag($newIssuedBookFlag)
    {
        $this->IssuedBookFlag = $newIssuedBookFlag;
    }

    function setReturnBookCount($newBookCount)
    {
        $this->ReturnBookCount= $newBookCount;
    }

}
?>