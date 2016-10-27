<?php
    $form_errors = array();
    if(isset($_POST['deleteschedule'])){

       if(empty($form_errors)) {
    try{
        $sqlInsert =  "DELETE FROM train_schedule WHERE train_no = :tno";

        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':tno' => $_POST['trainno']));

                if($statement -> rowCount() == 1 || 2){
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats !\", 
                        type:'success',  
                        text: \"Schedule Deleted.\",
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