<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/ContractController.php';
$contract=new ContractController();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if(isset($_POST['post_contract'])){
    
    $uid=$_SESSION['user_id'];
    $title=$_POST['title'];
    $duration=$_POST['duration'];
    $availability=json_encode($_POST['availability']);
    $price=$_POST['price'];
    $skills=$_POST['skills'];
    $type=$_POST['contract_type'];
    $description=$_POST['description'];
    $week_hours=$_POST['week_hours'];
    $contract_status=0;
    $res=$contract->post_contract($uid, $title, $duration, $availability,$type,$price,$week_hours,$skills, $description, $contract_status);
     if($res){

      
        
        $contract->alert_redirect("Contract Posted Successfully", "/work/ui/views/finance/deposit.php?am=$price");

     }else{
        
        $contract->alert_redirect("Contract not saved", "/work/ui/views/freelancing/post_contract.php");
     }        
}

if(isset($_POST['apply'])){

   $contract_id=$_POST['contract_id'];
   $client_id=$_POST['client_id'];
   $applicant_id=$_POST['applicant_id'];

   //check if already applied

   $res=$contract->check_if_applied($contract_id,$applicant_id);

   if($res){
      $contract->alert_redirect("You have already applied for this contract", "/work/ui/views/browse/browse_contracts.php");
   }else{
      $res=$contract->apply_contracts();
      if($res){
          
          $contract->alert_redirect("Contract applied successfully", "/work/ui/views/browse/browse_contracts.php");
  
       }else{
          
          $contract->alert_redirect("Failed Try again", "/work/ui/views/applications/apply_contract.php");
       }
   }
   
            
}

if(isset($_POST['mg_action'])){
    $contract_id=$_POST['contract_id'];
    $applicant_id=$_POST['applicant_id'];
    $client_id=$_POST['client_id'];
    $action=$_POST['action'];
    if($action==1){
    
        
    $res=$contract->award_contract($client_id,$contract_id,$applicant_id);
    if($res){
        $contract->alert_redirect("Contract awarded successfully", "/work/ui/views/manage/manage_contracts.php");
     }else{    
        $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/applications.php");
     }

    }
            
}

if(isset($_POST['ct_action'])){

   $contract=$_POST['contract'];
   $client=$_POST['client'];
   $action=$_POST['act'];
   $action=(int)$action;

   if($action==1){

   $res=$contract->delete_contracts($client, $contract);
   
   
   if($res){
      $contract->alert_redirect('Contract Deleted Successfully', '/work/ui/views/browse/browse_contracts.php');
  }else{
       $contract->alert_redirect('Error Deleting Contract', '/work/ui/views/browse/browse_contracts.php');
  }


   }elseif($action==0){
     echo "Edit";
   }
           
}

if(isset($_POST['action_offer'])){

   $contract_id=$_POST['contract_id'];
   $applicant_id=$_POST['applicant_id'];
   $client_id=$_POST['client_id'];
   $action=$_POST['act'];
   if($action==1){
   
       
   $res=$contract->accept_contract($client_id,$contract_id,$applicant_id);
   if($res){
       $contract->alert_redirect("Contract Accepted ", "/work/ui/views/manage/manage_contracts.php");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/manage_contracts.php");
    }

   }

            
}

if(isset($_POST['final_action'])){

   $contract_id=$_POST['contract_id'];
   $applicant_id=$_POST['applicant_id'];
   $client_id=$_POST['client_id'];
   $action=$_POST['act'];

   
       
   $res=$contract->contract_final($contract_id,$action);
   if($res){
       $contract->alert_redirect("Contract Completed ", "/work/ui/views/manage/manage_contracts.php");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/manage_contracts.php");
    }

   

            
}


if(isset($_POST['create_milestone'])){

   $res=$contract->add_milestone();
   $ct=$_POST['contract'];
   $cl=$_POST['client'];
   if($res){
       $contract->alert_redirect("Milestone Created ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }
   
         
}


if(isset($_POST['create_task'])){

   $res=$contract->add_task();
   $ct=$_POST['contract'];
   $cl=$_POST['client'];
   $ml=$_POST['milestone'];
   if($res){
       $contract->alert_redirect("Task is  Created ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml");
    }
         
}


//Complete task submission
if(isset($_POST['complete_task'])){
   $ts=$_POST['task'];
   $ct=$_POST['contract'];
   $cl=$_POST['client'];
   $ml=$_POST['milestone'];
   $res=$contract->task_completed($ts);

   if($res){
       $contract->alert_redirect("Task is  Completed ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml&ts=$ts");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml&ts=$ts");
    }
         
}

//Update task submission
if(isset($_POST['update_task'])){
   $ts=$_POST['task'];
   $ct=$_POST['contract'];
   $cl=$_POST['client'];
   $ml=$_POST['milestone'];
   $res=$contract->update_task($ts);
   if($res){
       $contract->alert_redirect("Task is  Updated ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml&ts=$ts");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml&ts=$ts");
    }
         
}


//Complete the contract

if(isset($_POST['complete_contract'])){

   $ct=$_POST['contract'];
   $cl=$_POST['client'];
   $freelancer=$_POST['freelancer'];
   $amount=$contract->proposal($ct,$freelancer);

   $contract->pay_freelancer($freelancer,$amount["charges"]);

   $res=$contract->complete_contract($ct);

   
   if($res){
       $contract->alert_redirect("Contract is  Completed ", "/work/ui/views/manage/manage_contracts.php");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }
         
}

//Delete the contract

if(isset($_POST['delete_contract'])){

   $ct=$_POST['contract'];
   $cl=$_POST['client'];

   $res=$contract->delete_contract($ct);

   
   if($res){
       $contract->alert_redirect("Contract is  Deleted ", "/work/ui/views/manage/manage_contracts.php");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }
         
}

//Delete the task

if(isset($_POST['delete_task'])){

   $ts=$_POST['task'];
   $ct=$_POST['contract'];
   $cl=$_POST['client'];
   $ml=$_POST['milestone'];

   $res=$contract->delete_task($ts);

   
   if($res){
       $contract->alert_redirect("Task is  Deleted ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl&ml=$ml");
    }
         
}


//Delete the milestone

if(isset($_POST['delete_milestone'])){

   $ml=$_POST['milestone'];
   $ct=$_POST['contract'];
   $cl=$_POST['client'];

   $res=$contract->delete_milestone($ml);

   
   if($res){
       $contract->alert_redirect("Milestone is  Deleted ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }
         
}
    

//Update the milestone

if(isset($_POST['update_milestone'])){

   $ml=$_POST['milestone'];
   $ct=$_POST['contract'];
   $cl=$_POST['client'];

   $res=$contract->update_milestone($ml);

   
   if($res){
       $contract->alert_redirect("Milestone is  Updated ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }
         
}

//Mark the milestone as completed

if(isset($_POST['complete_milestone'])){

   $ml=$_POST['milestone'];
   $ct=$_POST['contract'];
   $cl=$_POST['client'];

   $res=$contract->complete_milestone($ml);

   
   if($res){
       $contract->alert_redirect("Milestone is  Completed ", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/project.php?ct=$ct&cl=$cl");
    }
         
}

//Request Milestone Payment

if(isset($_GET['act']) && ($_GET['act']=="release_req")){

   $ml=$_GET['ml'];
   

   $res=$contract->release_milestone_request($ml);

   
   if($res){
       $contract->alert_redirect("Payment Requested ", "/work/ui/views/manage/manage_contracts.php");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/manage_contracts.php");
    }
         
}

if(isset($_GET['act']) && ($_GET['act']=="release")){

   $ml=$_GET['ml'];
   $ct=$_GET['ct'];

   $milestone=$contract->get_milestone_details($ml);
   $ml_amount=$milestone['ml_payment'];
   $freelancer=$milestone['freelancer'];

   
   //$proposal=$contract->proposal($ct,$freelancer);
   //$charges=$proposal["charges"];

   //if($ml_amount<=$charges){
      if($ml_amount){

   $payment=$contract->pay_freelancer($freelancer,$ml_amount);

   $res=$contract->release_milestone($ml);

   if($res && $payment){
       $contract->alert_redirect("Milestone Released ", "/work/ui/views/manage/manage_contracts.php");
    }else{    
       $contract->alert_redirect("Failed Try again", "/work/ui/views/manage/manage_contracts.php");
    }

   }   


}
