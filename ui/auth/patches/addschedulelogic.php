<?php
    $form_errors = array();
    if(isset($_POST['addschedule'])){
        $required_fields = array('tname', 'station_id');
        //check empty fields and merge the error msg
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
         if(empty($form_errors)) {
            // if empty, process data
    try{
        $sqlInsert =  "INSERT INTO train_schedule (train_no, station_id, arr_time, dep_time) ";
        $sqlInsert .= "VALUES (:tno, :sid, :arrival, :departure)";

        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':tno' => $_POST['tname'], ':sid' => $_POST['station_id'], ':arrival' => $_POST['arrival'], ':departure' => $_POST['departure']));

                if($statement -> rowCount() == 1){
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats !\", 
                        type:'success',  
                        text: \"Train Timing Added.\",
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