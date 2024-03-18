<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/edu/controllers/BlogController.php';
$blog = new BlogController();
//$blog->check_auth();

include $path . '/apps/edu/ui/layouts/nav.php';

// Function to send email
function sendEmail($from, $to, $subject, $message) {
    // To send HTML mail, the Content-type header must be set
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: ' . $from . "\r\n";

    // Send email
    mail($to, $subject, $message, $headers);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Retrieve form data
    $from_email = $_POST['from_email'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Your email content
    $email_content = "Title: $title <br> Content: $content";

    // Recipient email (change this to your desired email address)
    $to_email = $_POST['to_email'];

    // Email subject
    $subject = "New Note Posted";

    // Send email
    sendEmail($from_email, $to_email, $subject, $email_content);
}

?>

<section class="bg-light py-1">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title mb-4 fs-3">Post Note</h2>
                        <form action="/edu_blog" method="post">
                        
                            <div class="mb-3">
                                <label for="from_email" class="form-label">From</label>
                                <input type="email" class="form-control" name="from_email" placeholder="From" required>
                            </div>
                            <div class="mb-3">
                                <label for="from_email" class="form-label">To</label>
                                <input type="email" class="form-control" name="to_email" placeholder="From" required>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Subject</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter the title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Message</label>
                                <textarea class="form-control" name="content" rows="15" cols="5" required></textarea>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" name="insert">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include $path . '/apps/edu/ui/layouts/footer.php';
?>
