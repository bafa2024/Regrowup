<header class="p-1 mb-2 border-bottom shadow ">
    <div class="container">
      <div class="d-flex  align-items-center justify-content-center justify-content-lg-start">
        <a href="/apps/work/ui/views/home/home.php" class="d-flex align-left mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img class="bi me-2" width="80" height="60" role="img"  src="/apps/work/ui/assets/images/logo.png" alt="logo" aria-label="Bootstrap"/>
        </a>
      
        <?php
        $role = $_SESSION['role'];
        if ($role == 'Professional') {
        ?>
        
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          POST
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/post/post_gig.php"> Post a Gig</a></li>
                            
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/post/post_services.php"> Post Local Service </a></li>      
          </ul>
        </div>
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          CREATE
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/create/create_cv.php"> Create CV</a></li>
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/create/create_blog.php"> Blog Post</a></li>
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/create/create_course.php"> Create a Course </a></li>
          </ul>
        </div>
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          BROWSE
          </a>
          <ul class="dropdown-menu text-small">
        
          <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_blogs.php"> Blogs</a></li>
          <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_contracts.php"> Contracts</a></li>            
                            <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_jobs.php"> Jobs

                            </a>
                           </li>
          </ul>
        </div>
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          MANAGE
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_jobs.php"> Employment</a></li>
                            
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_gigs.php"> Gigs</a></li>    
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_blogs.php"> Blogs</a></li> 
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_contracts.php"> Freelance Contracts</a></li>    
                                    
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_services.php"> Local Services</a></li> 
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_courses.php"> Education</a></li>    
          </ul>
        </div>
        <div class="dropdown text-end p-1">
        <a href="#" class="d-block link-body-emphasis text-decoration-none " data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-bell"></i>
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="#">New Contract Posted...</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">New Projects Posted...</a></li>
            <li><a class="dropdown-item" href="#">New Gigs Posted...</a></li>
            <li><a class="dropdown-item" href="#">New Local Services Posted...</a></li>
          </ul>
        </div>
        <div class="text-end p-1 ">
          <a href="/apps/work/ui/views/chat/chat.php" class="d-block link-body-emphasis text-decoration-none " >
        
          <i class="fa fa-envelope"></i>
          </a>
      
        </div>

        <form class="col-5 col-lg-auto mb-3 mb-lg-0 me-lg-3 p-1" role="search" action="" method="POST">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
    
        </form>

        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo $_SESSION['profile_image'] ?>" alt="pic" width="32" height="32" class="rounded-circle">
          </a>
      
    
          <ul class="dropdown-menu text-small">
          
            <li><a class="dropdown-item" href="/apps/work/ui/views/profile/profile.php?ui=<?php echo $_SESSION['id']; ?>"><span class="fs-14 text-black flex-grow"><?php echo $_SESSION['full_name']; ?></span></a><span></span> </li>
            <li><hr class="dropdown-divider"></li>

            <li><a class="dropdown-item" href="/apps/work/ui/views/settings/settings.php?form=profile">Settings</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/home/statistics.php">Statistics</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/finance/finances.php">Finances</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/profile/users_reviews.php">Reviews</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/auth/invite.php">Invite&Earn</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/finance/finances.php">Help desk</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          


            </li>
          </ul>
        </div>

        <div class="dropdown text-end  p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['role']; ?>
            </a>
            <form  action="/log_api" method="POST" >
      
            <div class="dropdown-menu p-4 " >
        
            <input type="radio" name="role" id="role" value="Client"> <h7>Client</h7>
            <br><br />
              <input type="radio" name="role" id="role" value="Professional"><h7> Professional</h7>
              <br><br />
              <input type="hidden" name="ud" id="ud" value="<?php echo $_SESSION['id']; ?>">
            
    <button type="submit" class="btn btn-primary" name="sw">Switch Role </button>
  </div>
          
  </form>

          
          
          </div>
  
    
      



       <?php
        } else {
        ?>

        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          POST
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/post/post_job.php"> Post Jobs</a></li>
                        
          <li><a class="dropdown-item" href="/apps/work/ui/views/post/post_contract.php"> Post  Contracts </a></li>

          </ul>
        </div>
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          CREATE
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/create/create_blog.php"> Blog Post</a></li>
          </ul>
        </div>
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          BROWSE
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_blogs.php"> Blogs</a></li>
                            
                                
                            <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_freelancers.php"> Freelancers</a></li>
                            <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_gigs.php"> Gigs </a></li>
                            <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_education.php"> Courses</a></li>
                            <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_services.php"> Local Services </a></li>
          </ul>
        </div>
        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          MANAGE
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_jobs.php"> Jobs</a></li>
                            
        
                            
                            <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_gigs.php"> Gigs</a></li>    
                            <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_blogs.php"> Blogs</a></li> 
                            <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_contracts.php"> Contracts</a></li>    
                    
                            <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_courses.php"> Education</a></li> 
                            <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_services.php"> Local Services</a></li>  
          </ul>
        </div>
        <div class="dropdown text-end p-1">
        <a href="#" class="d-block link-body-emphasis text-decoration-none " data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-bell"></i>
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="#"></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"></li>
            <li><a class="dropdown-item" href="#"></li>
            <li><a class="dropdown-item" href="#"></li>
          </ul>
        </div>
        <div class="text-end p-1 ">
          <a href="/apps/work/ui/views/chat/chat.php" class="d-block link-body-emphasis text-decoration-none " >
        
          <i class="fa fa-envelope"></i>
          </a>
      
        </div>

        <form class="col-5 col-lg-auto mb-3 mb-lg-0 me-lg-3 p-1" role="search" action="" method="POST">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
    
        </form>

        <div class="dropdown text-end p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo $_SESSION['profile_image'] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
      
    
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="/apps/work/ui/views/profile/profile.php?ui=<?php echo $_SESSION['id']; ?>"><span class="fs-14 text-black flex-grow"><?php echo $_SESSION['full_name']; ?></span></a><span></span> </li>
            <li><hr class="dropdown-divider"></li>

            <li><a class="dropdown-item" href="/settings">Settings</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/home/statistics.php">Statistics</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/finance/finances.php">Finances</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/auth/invite.php">Invite&Earn</a></li>
            <li><a class="dropdown-item" href="/apps/work/ui/views/management/">Help desk</a></li>
          
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          


            </li>
          </ul>
        </div>

        <div class="dropdown text-end  p-1">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['role']; ?>
            </a>
            <form  action="/log_api" method="POST" >
      
            <div class="dropdown-menu p-4 " >
        
            <input type="radio" name="role" id="role" value="Client"> <h7>Client</h7>
            <br>
              <input type="radio" name="role" id="role" value="Professional"><h7> Professional</h7>
              <br>
              <input type="hidden" name="ud" id="ud" value="<?php echo $_SESSION['id']; ?>">
            
    <button type="submit" class="btn btn-primary" name="sw">Switch Role </button>
  </div>
          
  </form>

          
          
          </div>
  
    
      

        <?php
        }
        ?>




      </div>
    </div>
  </header>