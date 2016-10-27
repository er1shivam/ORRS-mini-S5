<?php
    $form_errors = array();
    if(isset($_POST['deletestation'])){

       if(empty($form_errors)) {
    try{
        $sqlInsert =  "DELETE FROM train_route WHERE station_id = :tno";

        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':tno' => $_POST['stationid']));

                if($statement -> rowCount() == 1){
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats !\", 
                        type:'success',  
                        text: \"Station Deleted.\",
                        confirmButtonText: \"Thank you!\",    
                        
                        });
                        </script>";
                //$result = flashMessage("Registration succesful" ,"pass");
                }
            }catch (PDOException $ex){
                    $result = flashMessage("Error occured : " . $ex->getMessage() );
            }
    }
    else{
        if(count($form_errors) == 1){
             $result  = flashMessage("There was one error in the form <br/>");
        }
        else{
        $result  = flashMessage("There were " . count($form_errors). " errors in the form <br />");
        }
    }
    }
?>