<?php

include 'Controller.php';

class NotificationsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //Get users emails from database and send them notifications

    public function fetchUsers()
    {
        // Code to fetch users table and check for new records
        // Replace this with your own implementation of fetching the users table and checking for new records

        // Example implementation:
        $query = "SELECT * FROM users";
        $result = $this->run_query->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Process each user record and check for new records
                // You can compare the fetched records with your stored records or use a timestamp to determine if it's a new record

                // If it's a new record, trigger the push notification
                $this->pushNotificationAsAlert("New user created: ID " . $row['id']);
                $this->pushNotificationWithSound("New user created: ID " . $row['id']);
                $this->pushNotificationToEmail("New user created: ID " . $row['id'], '


                ');
            }
        }
    }


    public function fetchContracts($email)
    {
        // Code to fetch contracts table and check for new records
        // Replace this with your own implementation of fetching the contracts table and checking for new records

        // Example implementation:
        $query = "SELECT * FROM contracts";
        $result = $this->run_query->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Process each contract record and check for new records
                // You can compare the fetched records with your stored records or use a timestamp to determine if it's a new record

                // If it's a new record, trigger the push notification
                $this->pushNotificationAsAlert("New contract created: ID " . $row['id']);
                $this->pushNotificationWithSound("New contract created: ID " . $row['id']);
                $this->pushNotificationToEmail("New contract created: ID " . $row['id'], $email);
            }
        }
    }

    public function fetchJobs($email)
    {
        // Code to fetch jobs table and check for new records
        // Replace this with your own implementation of fetching the jobs table and checking for new records

        // Example implementation:
        $query = "SELECT * FROM jobs";
        $result = $this->run_query->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Process each job record and check for new records
                // You can compare the fetched records with your stored records or use a timestamp to determine if it's a new record

                // If it's a new record, trigger the push notification
                $this->pushNotificationAsAlert("New job created: ID " . $row['id']);
                $this->pushNotificationWithSound("New job created: ID " . $row['id']);
                $this->pushNotificationToEmail("New job created: ID " . $row['id'], $email);
            }
        }
    }

    public function fetchGigs($email)
    {
        // Code to fetch gigs table and check for new records
        // Replace this with your own implementation of fetching the gigs table and checking for new records

        // Example implementation:
        $query = "SELECT * FROM gigs";
        $result = $this->run_query->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Process each gig record and check for new records
                // You can compare the fetched records with your stored records or use a timestamp to determine if it's a new record

                // If it's a new record, trigger the push notification
                $this->pushNotificationAsAlert("New gig created: ID " . $row['id']);
                $this->pushNotificationWithSound("New gig created: ID " . $row['id']);
                $this->pushNotificationToEmail("New gig created: ID " . $row['id'], $email);
            }
        }
    }

    public function pushNotificationWithSound($message)
    {
        // Code to push the notification with sound
        // This can be implemented using various methods, such as sending a push notification to a mobile device, playing a sound on the server, or using a third-party notification service.
        // Here, we'll simply echo the message with a sound effect for demonstration purposes.
        echo $message . ' [Notification Sound]';
    }

    public function pushNotificationToEmail($message, $email)
    {
        // Code to send the notification to the user's email
        // This can be implemented using an email service or library of your choice.
        // Here, we'll simply echo the email message for demonstration purposes.
        //send an email 
        $to = $email;
        $subject = "New Notification";
        $txt = $message;
        $headers = "From:system@system.com";

        mail($to, $subject, $txt, $headers);
        

    }

    public function pushNotificationAsAlert($message)
    {
        // Code to display the notification as a JavaScript alert
        // This can be implemented in a web-based application where JavaScript is supported.
        // Here, we'll echo the JavaScript code with a sound effect for demonstration purposes.
        $alertCode = "<script>
                        alert('$message');
                        var audio = new Audio('/ui/assets/audio/notification_sound.mp3'); // Replace 'notification_sound.mp3' with the actual URL or path to the notification sound file
                        audio.play();
                     </script>";
        echo $alertCode;
    }
}

// Usage


?>
