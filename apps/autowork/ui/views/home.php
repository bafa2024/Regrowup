<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="RegrowUp Freelancing Platform Dashboard - Manage Your Projects, Bids, and Workflows Efficiently">
  <meta name="author" content="RegrowUp">
  <title>RegrowUp | Dashboard</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-KyZXEAg3QhqLMpG8r+8jhAXg7V+1zvN8CM5q2OQ9YG8HxAq0K6M13oQJbVUGla7Q" crossorigin="anonymous">

  <!-- Custom CSS (optional, you can create /assets/css/style.css) -->
  <link href="/apps/autowork/assets/css/style.css" rel="stylesheet">

  <link rel="icon" type="image/png" href="/apps/autowork/assets/images/favicon.png">

  <style>
    html { scroll-behavior: smooth; }
    body { background-color: #f8f9fa; }
    .popup-hidden { display: none; }
    .popup-visible {
      display: block;
      position: fixed;
      bottom: 10%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      border-radius: 8px;
      z-index: 9999;
    }
    .loading-splash {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1000;
    }
    .loader {
      border: 5px solid #f3f3f3;
      border-top: 5px solid #3498db;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 2s linear infinite;
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
    }
    @keyframes spin {
      0% { transform: translate(-50%, -50%) rotate(0deg); }
      100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
  </style>
</head>

<body>


<!-- Popup -->
<div id="popup" class="popup-hidden">
  <span id="popup-message"></span>
</div>

<!-- Loading Splash -->
<div id="loadingSplash" class="loading-splash">
  <div class="loader"></div>
</div>

<!-- Main Content -->

  </div>
</div>

<!-- Limit Dropdown -->
<div class="container mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <h5>Change Project Feed Limit:</h5>
    <select id="limitSelect" class="form-select w-auto" onchange="updateLimit()">
      <?php foreach ([10, 20, 30, 50, 70, 100] as $opt) {
          $selected = ($limit == $opt) ? 'selected' : '';
          echo "<option value='$opt' $selected>$opt</option>";
      } ?>
    </select>
  </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Scripts -->
<script>
function showPopup(message) {
  const popup = document.getElementById("popup");
  const popupMessage = document.getElementById("popup-message");
  popupMessage.textContent = message;
  popup.className = "popup-visible";
  setTimeout(() => { popup.className = "popup-hidden"; }, 3000);
}

function updateLimit() {
  const selectedLimit = document.getElementById('limitSelect').value;
  window.location.href = `?limit=${selectedLimit}`;
}

async function makeSingleBid(project) {
  try {
    let response = await fetch(`/apps/work/api/autowork.php?task=mbid&p=${project}`);
    let result = await response.json();
    if (response.ok && result.status === 200) {
      showPopup("Bid Success: " + result.message);
    } else {
      showPopup("Bid Failed: " + (result.error || result.message));
    }
  } catch (error) {
    showPopup("Error sending bid: " + error.message);
  }
}
</script>

<?php include $path.'/apps/work/ui/layouts/footer.php'; ?>

</body>
</html>
