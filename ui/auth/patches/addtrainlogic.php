<?php
    $form_errors = array();
    if(isset($_POST['submit'])){

        $required_fields = array('train_name', 'train_no');
        //check empty fields and merge the error msg
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
         if(empty($form_errors)) {
            // if empty, process data
    try{
        $sqlInsert =  "INSERT INTO trains_info (train_name, train_no, s_station_id, d_station_id, type, sl1, ac1) ";
        $sqlInsert .= "VALUES (:tname, :tno, :sid, :did, :type, :sl, :ac)";

        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':tname' => $_POST['train_name'], ':tno' => $_POST['train_no'], ':sid' => $_POST['s_station_id'], ':did' => $_POST['d_station_id'], ':type' => $_POST['type'], ':sl' => $_POST['sl1'], ':ac' => $_POST['ac1']));

                if($statement -> rowCount() == 1){
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats !\", 
                        type:'success',  
                        text: \"Train Added.\",
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