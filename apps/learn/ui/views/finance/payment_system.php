<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/FinancesController.php';
$profile = new FinancesController();
$user_id = $_SESSION['user_id'];
$details=$profile->view($user_id);

$profile_photo = $details['profile_image'];
$first_name=$profile->sanitize($details['first_name']);
$last_name=$profile->sanitize($details['last_name']);
$dob=$profile->sanitize($details['dob']);
$phone=$profile->sanitize($details['phone']);
$email=$profile->sanitize($details['email']);
$state=$profile->sanitize($details['state']);
$city=$profile->sanitize($details['city']);
$country=$profile->sanitize($details['country']);
$zip_code=$profile->sanitize($details['zip_code']);
$address=$profile->sanitize($details['address']);
$role=$profile->sanitize($details['role']);


$role = $_SESSION['role'];

include $path . '/work/ui/layouts/nav.php';
?>



<body>
  <div class="container shadow">
    <h1 class="mt-4">Payment System( Fees & Payments)</h1>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Gig</h2>
            <p class="card-text">
              Agent: 10% (The Workhouse fee)<br>
              Customer: 3% (Administration Fee)
            </p>
          </div>
          <div class="card-footer">
            <h3 class="card-title">Extras</h3>
            <p class="card-text">Can pay to make Gig go to the top in Featured listings (7 days): £9.99. Can be renewed every 7 days.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Freelancer Contracts</h2>
            <p class="card-text">
              Agent:
              <ul>
                <li>£0–£500 in earnings: 20% service fee</li>
                <li>£500.01–£10,000 in earnings: 10% service fee</li>
                <li>£10,000.01 or more in earnings: 5% service fee</li>
              </ul>
              Client: 3%
            </p>
          </div>
          <div class="card-footer">
            <h3 class="card-title">Extras</h3>
            <p class="card-text">50 extra invites: £4.99</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Local Jobs</h2>
            <p class="card-text">
              Agent: 2.5%<br>
              Customer: 0.5%
            </p>
          </div>
          <div class="card-footer">
            <h3 class="card-title">Extras</h3>
            <p class="card-text">£4.99 to be hosted as a featured service for 7 days</p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Educational Courses</h2>
            <p class="card-text">
              Agent: 2.5%<br>
              Customer: 1%
            </p>
          </div>
          <div class="card-footer">
            <h3 class="card-title">Extras</h3>
            <p class="card-text">Make course featured for £4.99 for 7 days</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Employment</h2>
            <p class="card-text">
              Posting a job advert: £39.99
            </p>
          </div>
          <div class="card-footer">
            <h3 class="card-title">Extras</h3>
            <p class="card-text">5 Adverts: £139.99 (Allows posting 5 adverts)</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
