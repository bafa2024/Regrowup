<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ExternalProjects.php';
$bid = new Bidding();

$bid->checkSessionAndRedirect();

include $path.'/apps/work/ui/layouts/nav.php';


?>

<div id="popup" class="popup-hidden">
  <span id="popup-message"></span>
</div>
<style>
  .popup-hidden {
  display: none;
  /* other styles */
}

.popup-visible {
  display: block;
  position: fixed;
  bottom: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  z-index: 1;
  text-align: center;
  border-radius: 4px;
}

.loading-splash {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    z-index: 9999;
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}


  </style>
<div class="container-fluid d-flex">
<div id="loadingSplash" class="loading-splash">
    <div class="loader"></div>
</div>


  <?php
  if ($role == "Client") {
      include 'usermap.php';
  } else {
      $queries = ["Php", "Javascript", "Reactjs","Vuejs","Python","chatgpt","AWS","Java","Django","Flask","Nodejs","Expressjs","Android","Ios","Flutter","React Native","Nextjs","Nuxtjs","Spring","Springboot","Springmvc","Restfulapi","Restapi","Graphql"];
      $limit = $_GET['limit'] ?? 20;

       $bid->bids_history();
    
      ?>
  
    
  </div>

  <!-- Include Bootstrap JS and Your Own Scripts -->
  <!-- Bootstrap 5.1 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></script>

  <script>

function confirmAndMakeManyBids() {
    var result = confirm("Are you sure you want to proceed?");
    if (result) {
        // User pressed OK
        makeManyBids();
    } else {
        // User pressed Cancel
        console.log("Action canceled!");
    }
}




    function showPopupM(message) {
    alert(message);  // Replace with your own popup implementation if you have one
}

function showPopup(message) {
  const popup = document.getElementById("popup");
  const popupMessage = document.getElementById("popup-message");
  
  popupMessage.innerHTML = message;
  popup.className = "popup-visible";
  
  setTimeout(() => {
    popup.className = "popup-hidden";
  }, 1000); // Hide after 3 seconds
}

async function makeSingleBid(p) {
    let url = "/apps/work/api/autowork.php?task=mbid&p=" + p;
    
    try {
        let response = await fetch(url, {
            method: "GET",
            headers: {
                // Add any necessary headers here, like authentication tokens
            }
        });

        if (response.ok) {
            let jsonResponse = await response.json();
            if (jsonResponse.status === 200) {
                showPopup("Bid Success: " + jsonResponse.message);
            } else {
                showPopup("Bid Failed: " + jsonResponse.error);
            }
        } else {
            showPopup("Network response was not ok");
        }
    } catch (error) {
        showPopup("Fetch Error: " + error);
    }
}

function makeManyBids() {
    const multi_bid_url = "/mbid?task=manybid"; // Your API endpoint for multiple bids

    // Show the loading splash
  //  document.getElementById('loadingSplash').style.display = 'block';

    fetch(multi_bid_url)
    .then(response => response.json())
    .then(data => {
        if (data.status === 200) {
            showPopup("MultiBid Success: " + data.message);
        } else {
            showPopup("MultiBid Failed: " + data.message);
        }
        
        // Hide the loading splash after showing the popup
        //document.getElementById('loadingSplash').style.display = 'none';
    })
    .catch((error) => {
        // Show the popup first
        showPopup("MultiBid Failed: Fetch Error");

        // Hide the loading splash even if there's an error
      //  document.getElementById('loadingSplash').style.display = 'none';
        
        console.error('Fetch Error:', error);
    });
}




</script>
  <script>
    function updateLimit() {
      const limitValue = document.getElementById('limitSelect').value;
      window.location.href = `?limit=${limitValue}`;
    }

    const tabLinks = document.querySelectorAll('.nav-link');
    tabLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        tabLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
        const target = link.getAttribute('href');
        document.querySelectorAll('.tab-pane').forEach(tab => {
          tab.classList.remove('show', 'active');
        });
        document.querySelector(target).classList.add('show', 'active');
      });
    });
  </script>
</div>
<?php
}
include $path.'/apps/work/ui/layouts/footer.php';
?>