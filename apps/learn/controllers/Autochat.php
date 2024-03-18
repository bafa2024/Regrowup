<?php
$path = $_SERVER['DOCUMENT_ROOT'];
//include $path . '/pool/libs/controllers/Controller.php';
//include 'Discovery.php';

class Autochat extends Controller{

    use Discovery;
    
    public $message1 = "Hey Hello Buddy, How are you doing today";

    public $message2 = "I read the project description again, Its an interesting project by the way";

    public $message3 = "Do you mind if I ask you about the timing of the project?";

    public $message4 = "Also,if you dont mind to ask you about the budget of the project?";

    public $message5 = "Hold on a minute";

    public $message6 = "Alright";

    public $message7 = "I don't know if you are agree, to use Upwork rather than this platform?!";

    public $message8 = "here is my upwork profile link";

    public $myupwork_profile = "<a href='https://www.upwork.com/freelancers/~01e1f3b5f5f5f5f5f5'>
    https://www.upwork.com/freelancers/~01e1f3b5f5f5f5f5f5</a>";
    
    public $duration = "3";


    /**
     * Auto Chat Algorithms:
     * Checkup Run by Task Scheduler:::
     * 
     * Checkup for new thread>
     * 1-check if there is new thread
     * 
     * Client Verification=>
     * 2-checkup client verification
     * 
     * Conversation =>
     * 3-if yes or no :
     * 
     * Conversation Message Run =>
     * 2- check if the thread has a message from the user
     *
     * if YES or No => 
     * 3- send a greeting message
     * 
     * Analyze the project =>
     * 4- analyze the the project description :
     * 
     * After Project Analysis =>
     * 5- send a message "I Studied the project again"
     * 6- send the the project description as a message
     * 5- ask for more details of the project details
     * 6- ask about the timing
     * 7- ask about the budget
     * 8- backend checkup if the client's budget is in range and timing is in range
     * 9- quickly modify the bid and create the milestones
     * 9- send a message to the client "Hold on, I will get back to you in a minute, I should check again to make sure that I fully understood the project"
     * 9- quickly modifiy the proposal based on clients budget and timing
     * 10-send a notification to admin and ask for approval,"I have a new bid all in range, please check its details"
     * 11- if the admin approves the proposal, send a message to the client to Award me the project.
     * 12- if the admin rejects the proposal, send a message to the client "Its a hard project for me I cant do it" .
     * 13- if the client awards the project, send a message to the admin to start the project.
     * 14-ask the client for resources.
     * 15-ask the client for creating milestones.
     * 16-if the client decides to dont award the project, send a message to the admin to client didnt award the project.
     * 17-send a follow message can we go further
     * */

    //Running the Autochat
    public function autochat()
    {

        $newthread = $this->newthreads();

        if ($newthread != 1) {

            $this->newChat($newthread);
        }
    }

    //1-New Thread Checkup
    public function newthreads()
    {

        $url = "https://www.freelancer.com/api/messages/0.1/threads/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $res = json_decode($resp);
        $threads = $res->result->threads;

        foreach ($threads as $thread) {
            //echo "<article>" . "Thread Id: " . $thread->id . "</article>";
            $newthread = $thread->is_read;
            if ($newthread != 1) {
                echo $thread->id;
            }
        }
        //curl_close($curl);
        //var_dump($resp);

    }
    /*
    public function threads()
    {

        $url = "https://www.freelancer.com/api/messages/0.1/threads/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $res = json_decode($resp);
        $threads = $res->result->threads;

        foreach ($threads as $thread) {
            $read= $thread->is_read;
            if($read==1){
                $seen="Seen";
            }else{
                $seen="Unseen";
            }

            
            echo ' <div class="col-sm-12 center_2_inner_main_1">
            <div class="center_2_inner_2">';
            echo "<article>" . "Thread Id: ".$thread->id. "</article>";
            echo "<article>" . "Messages Seen/Not Seen: ".$seen. "</article>";
            echo "<a href='https://www.freelancer.com/messages/thread/".$thread->id."' target='_blank'>Project Link</a>";
            echo "<hr>";
            echo '</div>';
            echo '</div>';

            
                
            
        }
        //curl_close($curl);
        //var_dump($resp);

    }

    //Analyze the project
    public function analyzeProject($clientId)
    {
        //get sender id
        $url = "https://www.freelancer.com/api/projects/0.1/projects/";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $obj = json_decode($resp);
        $pros = $obj->result->projects;
        foreach ($pros as $project) {
            $ownerId = $project->owner_id;
            if ($ownerId == $clientId) {
                $projectTitle = $project->title;
                $projectDescription = $project->description;

                echo $projectTitle;
            } else {

                echo "No Project Found";
            }
        }

        curl_close($curl);
    }

    public function manageThread2($thread)
    {


        $url = "https://www.freelancer.com/api/messages/0.1/threads/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "freelancer-oauth-v1: NRiIJt3HAjee1py2HSQymax4HUL44f",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = array(
            'threads[]' => [$thread],
            'action' => 'block',
            'target' => 'inbox',
            'folders[]' => ["inbox", "inbox", "archived", "client"],
            'thread_types[]' => ["primary", "private_chat", "primary"],
            'offset' => 50,
            'limit' => 100,
            'from_updated_time' => 2312212,
            'to_updated_time' => 12312231
        );

        $data = json_encode($data);


        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);


    }
    

    public function manageThread($thread) {

        $url = "https://www.freelancer.com/api/messages/0.1/threads/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array(
            "Content-Type: application/json",
            "freelancer-oauth-v1: NRiIJt3HAjee1py2HSQymax4HUL44f",
        );

        $data = array(
            'threads[]' => [$thread],
            'action' => 'block',
            'target' => 'inbox',
            "folders[]" => ["inbox", "inbox", "archived", "client"],
               
            "thread_types[]" => ["primary", "private_chat", "primary"],
            'offset' => 50,
            'limit' => 100,
            'from_updated_time' => 2312212,
            'to_updated_time' => 12312231
        );
        
        $data = json_encode($data);
        
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $resp = curl_exec($curl);
        curl_close($curl);
        if(curl_errno($curl)){
            echo 'Curl error: ' . curl_error($curl);
        }else{
            $obj = json_decode($resp);
            $status = $obj->result->threads[0]->status;
            echo $status;
        
        }

    }



    //2-Client Verification
    public function clientReplied($thread_id)
    {
        $clientId = $this->messages_sender($thread_id);
        $freelancer = $this->bidder;
        if ($clientId != $freelancer) {
            return true;
        } else {
            return false;
        }
    }

    public function user($user_id)
    {
        $url = "https://www.freelancer.com/api/users/0.1/users/" . $user_id . "/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $res = json_decode($resp);

        return $res->result->display_name;

        curl_close($curl);
        //var_dump($resp);

    }

    public function acceptProject($bidId)
    {
        $url = "https://www.freelancer.com/api/projects/0.1/bids/" . $bidId . "/?action=accept";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/x-www-form-urlencoded",
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
            "Content-Length: 0",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);
    }


    public function newChat($thread_id)
    {

        $url = "https://www.freelancer.com/api/messages/0.1/threads/" . $thread_id;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $res = json_decode($resp);
        $chats = $res->result->threads;

        foreach ($chats as $chat) {
            $newthread_id = $chat->id;
            $client_name = $this->sender($newthread_id);

            $message0 = "Hi, Welcome, How is your day going so far?";
            $clientId = $this->messages_sender($newthread_id);

            $bidId = $this->getBidId($clientId);


            $this->sendmessage($newthread_id, $message0);
            if ($this->clientReplied($newthread_id)) {
                $this->sendmessage($newthread_id, "Great");
                $this->sendmessage($newthread_id, $this->message2);
            } else {
                $this->sendmessage($newthread_id, "Hello, are you there?");
                $this->sendmessage($newthread_id, "Anyways");
                $this->sendmessage($newthread_id, "All seems great!");
                $this->sendmessage($newthread_id, "I was wondering if you want to add some more details to your project?");
                $this->sendmessage($newthread_id, $this->message3);
                $this->sendmessage($newthread_id, $this->message4);
            }

            if ($this->clientReplied($newthread_id)) {
                $this->sendmessage($newthread_id, "Ok");
                $this->update_proposal($bidId);
            } else {
                $this->sendmessage($newthread_id, "Hello, are you there?");
                $this->sendmessage($newthread_id, "Anyways");
                $this->sendmessage($newthread_id, "Let me know what do you think?");
            }
        }

        //echo $thread_id;
        curl_close($curl);
        //var_dump($resp);
    }

    public function sendmessage($thread_id, $message)
    {
        $message = urlencode($message);
        $url = "https://www.freelancer.com/api/messages/0.1/threads/" . $thread_id . "/messages/?message=" . $message;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Length: 0",
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        //var_dump($resp);

    }

    public function getBidId($clientId)
    {

        $url = "https://www.freelancer.com/api/projects/0.1/bids/?bidders%5B%5D=45214417";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1:" . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //date_default_timezone_get("America/Los_Angeles");
        $resp = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $obj = json_decode($resp);
            $bids = $obj->result->bids;
            foreach ($bids as $bid) {
                $ownerId = $bid->project_owner_id;
                if ($clientId == $ownerId) {

                    return $bid->id;
                }
            }
        }
    }

    public function update_proposal($threadId)
    {

        $bidId = $this->messages_sender($threadId);


        $url = "https://www.freelancer.com/api/projects/0.1/bids/" . $bidId . "/";

        $curl = curl_init($url);
        curl_setopt(
            $curl,
            CURLOPT_URL,
            $url
        );
        curl_setopt(
            $curl,
            CURLOPT_PUT,
            true
        );
        curl_setopt(
            $curl,
            CURLOPT_RETURNTRANSFER,
            true
        );

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
            "Content-Type: application/json",
        );
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            $headers
        );

        $data = <<<DATA
        {
    
        "amount": 50
    
        }
        DATA;

        curl_setopt(
            $curl,
            CURLOPT_POSTFIELDS,
            $data
        );

        //for debug only!
        curl_setopt(
            $curl,
            CURLOPT_SSL_VERIFYHOST,
            false
        );
        curl_setopt(
            $curl,
            CURLOPT_SSL_VERIFYPEER,
            false
        );

        $resp = curl_exec($curl);
        //$res= json_decode($resp);


        curl_close($curl);
        var_dump($resp);
    }

    //Messages Checkup
    public function sender($thread_id)
    {
        $url = "https://www.freelancer.com/api/messages/0.1/messages/?threads[]=" . $thread_id;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        $res = json_decode($resp);
        $messages = $res->result->messages;
        foreach ($messages as $message) {
            return $this->user($message->from_user);
        }
        curl_close($curl);
    }

    public function messages_sender($thread_id)
    {

        $url = "https://www.freelancer.com/api/messages/0.1/messages/?threads[]=" . $thread_id;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $res = json_decode($resp);
        $messages = $res->result->messages;

        foreach ($messages as $message) {

            return $message->from_user;
        }
        curl_close($curl);
    }

    function addMembersToThread($oauthAccessToken, $threadId, $members)
    {
        $url = 'https://www.freelancer.com/api/messages/0.1/threads/' . $threadId . '/members/';
        $headers = array(
            'freelancer-oauth-v1: ' . $oauthAccessToken,
            'Content-Type: application/json'
        );
        $data = array(
            "members[]" => $members,
            "action" => "add"
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

// Usage:

    public function fetchChatMessages()
    {
        $sql = 'SELECT * FROM chats ORDER BY date_created ASC';
        $result = $this->run_query($sql);

        $messages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = array(
                    'sender' => $row['sender'],
                    'message' => $row['message']
                );
                $messages[] = $message;
            }
        }

        return $messages;
    }

    public function saveChatMessage($sender, $destination, $message)
    {
        $token = ($sender + $destination) * 2;
        //write query
        $sql="INSERT INTO chats (sender, destination, token, message) VALUES ('$sender', '$destination', '$token', '$message')";
        //run query

        $result = $this->run_query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }

        
    }


    public function chats()
    {
        $url = "https://www.freelancer.com/api/messages/0.1/threads/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: jGCpBU4BKXm9PQqCWAo8GAc7IqzimJ",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $res = json_decode($resp);
        $threads = $res->result->threads;

        foreach ($threads as $thread) {
            echo "<article>" . "Thread Id: " . $thread->id . "</article>";
            echo "<article>" . "Thread Memebers: " . $thread->id . "</article>";
            echo "<hr>";
        }
        curl_close($curl);
        //var_dump($resp);

    }


    public function chat_messages($thread_id)
    {
        $url = "https://www.freelancer.com/api/messages/0.1/threads/" . $thread_id . "/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: jGCpBU4BKXm9PQqCWAo8GAc7IqzimJ",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);
    }
    
   */

}
