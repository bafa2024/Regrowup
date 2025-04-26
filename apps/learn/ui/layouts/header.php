<header class="p-1 mb-2 border-bottom shadow">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="/home" class="mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                <img class="bi me-2" width="100" height="80" role="img" src="/storage/website/logo/mainlogo_144x144.png" alt="logo" aria-label="Bootstrap"/>
            </a>

              <!-- Search Form with Chat Button -->
              <div class="input-group col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 p-1">
                <input type="search" class="form-control" placeholder="Search or Chat..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="button" id="chatButton">
                    <i class="bi-chat"></i> Chat
                </button>
            </div>

            <!-- Profile Dropdown (Right Aligned) -->
            <div class="dropdown text-end p-1">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $_SESSION['profile_image'] ?>" alt="pic" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="/work/ui/views/profile/profile.php?ui=<?php echo $_SESSION['id']; ?>">
                        <span class="fs-14 text-black flex-grow"><?php echo $_SESSION['full_name']; ?></span></a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/work/ui/views/settings/settings.php?form=profile">Settings</a></li>
                    <li><a class="dropdown-item" href="/work/ui/views/finance/finances.php">Help desk</a></li>
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
