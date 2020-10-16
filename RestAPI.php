<?php
//Require configuration
require_once('inc/configforwebservice.inc.php');
//Require Entities
require_once('inc/Entities/Review.class.php');
//Require Utillity Classes
require_once('inc/Utility/PDOAgent.class.php');
require_once('inc/Utility/ReviewDAO.class.php');

//Instantiate a new Customer Mapper
ReviewDAO::init();


//Pull the request data
parse_str(file_get_contents('php://input'), $requestData);
//json_encode($requestData);


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST, Its Insert time!
   
    break;

    //If there was a request with an id return that customer, if not return all of them!
    case "GET":

        if (isset($requestData['id']))    {

            //Return the customer object
            $sc = ReviewDAO::getReview($requestData['id']);
            //Set the header
            if($sc == false)
            {
                return false;
            }
            header('Content-Type: application/json');
            //Barf out the JSON version
            echo json_encode($sc->jsonSerialize());

        } else {

            //All the customers!
            $customers = ReviewDAO::getReviews();
            
            //Walk the customers and add them to a serialized array to return.
            $serializedCustomers = array();

            foreach ($customers as $customer)    {
                $serializedCustomers[] = $customer->jsonSerialize();
            }
            //Return the results

            //Set the header
            header('Content-Type: application/json');
            //Return the entire array
            echo json_encode($serializedCustomers);            
        }
    break;
   
    case "PUT":
    
    break;

    case "DELETE":
      
    break; 

    default:
        echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}


?>
