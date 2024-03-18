<header class="p-1 mb-1 border-bottom shadow">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="/lib" class="mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                <img class="bi me-2" width="100" height="80" role="img" src="/storage/website/logo/mainlogo_144x144.png" alt="logo" aria-label="Bootstrap"/>
            </a>

              <!-- Search Form with Chat Button -->
              <form action="" method="post">
              <div class="input-group ">
                <input type="search" class="form-control" id="search" name="search" placeholder="Search or Chat..." aria-label="Search">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" id="chatButton">
                    <i class="bi-chat"></i> Chat
                </button>
            </div>
            </form>

            <!-- Profile Dropdown (Right Aligned) -->
            <div class="dropdown text-end p-1">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $_SESSION['profile_image'] ?>" alt="pic" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="/profile?ui=<?php echo $_SESSION['id']; ?>">
                        <span class="fs-14 text-black flex-grow"><?php echo $_SESSION['full_name']; ?></span></a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/settings?form=profile">Settings</a></li>
                    <li><a class="dropdown-item" href="/help">Help desk</a></li>
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script>
const exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  const button = event.relatedTarget
  // Extract info from data-bs-* attributes
  const recipient = button.getAttribute('data-bs-whatever')
  
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  const modalTitle = exampleModal.querySelector('.modal-title')
  const modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = `New message to ${recipient}`
  modalBodyInput.value = recipient
})
</script>