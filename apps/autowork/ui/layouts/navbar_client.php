
        <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-lg">
                            <a class="navbar-brand w-120 w-md-140 fulw" href="/apps/work/ui/views/home/home.php">
                                <img src="/ui/assets/images/logo.png" alt="logo" />
                            </a>
                            <button class="navbar-toggler rounded-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/apps/work/ui/views/home/home.php">Home</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                    <a class="nav-link  dropdown-toggle bold" href="#" data-bs-toggle="dropdown"> Post </a>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/post/post_job.php"> Post Jobs</a></li>
                        
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/post/post_contract.php"> Post  Contracts </a></li>
  
                                </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                    <a class="nav-link  dropdown-toggle bold" href="#" data-bs-toggle="dropdown"> Create </a>
                                    <ul class="dropdown-menu">
                            
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/create/create_blog.php"> Blog Post</a></li>
                            
                                      </ul>
                                    </li>

                            
                                    <li class="nav-item dropdown">
                                    <a class="nav-link  dropdown-toggle bold" href="#" data-bs-toggle="dropdown"> Browse </a>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_blogs.php"> Blogs</a></li>
                            
                                
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_freelancers.php"> Freelancers</a></li>
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_gigs.php"> Gigs </a></li>
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_education.php"> Courses</a></li>
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/browse/browse_services.php"> Local Services </a></li>
                                      </ul>
                                    </li>
                        
                        
                        
                                    <li class="nav-item dropdown">
                                    <a class="nav-link  dropdown-toggle bold" href="#" data-bs-toggle="dropdown"> Manage </a>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_jobs.php"> Employment</a></li>
                        
                        

                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_jobs.php"> Jobs</a></li>
                            
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_gigs.php"> Gigs</a></li>    
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_blogs.php"> Blogs</a></li> 
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_contracts.php"> Contracts</a></li>    
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_services.php">Local Services</a></li> 
                                    <li><a class="dropdown-item" href="/apps/work/ui/views/manage/manage_courses.php"> Courses </a></li>
                                </ul>
                                    </li>
                            
                            
                                
                                
                                </ul>

                                <div class="nav-item">
                                <form action="/api/searchAPI.php" method="GET">
            <div class="mb-3">
                <input type="text" class="form-control" name="searchTerm" placeholder="Enter your search term">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

                               </div>
                            

                        
                                    <div class="bell-noti rel">
                                        <button type="button" class="rel" id="noti-box">
                                            <img src="/ui/assets/images/bell.png" alt="bell" />
                                        </button>
                                        <div class="notifi-box" style="display: none">
                                            <div class="d-flex flex-column">
                                                <a href="javascript:void(0)">
                                                    <h1 class="mytext-black fs-12 fw-700">Heading</h1>
                                                    <p class="vclip fs-12 mytext-black">
                                                        Adipisicing aute sint nulla culpa enim dolore mollit
                                                        ea esse. Elit aliquip proident ullamco et consequat ut
                                                        consectetur duis pariatur duis incididunt. Sint
                                                        deserunt laboris excepteur tempor fugiat consectetur
                                                        veniam aliquip nostrud anim cupidatat. Voluptate
                                                        ullamco dolor ad sint adipisicing incididunt magna ut.
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-pic rel w-400">
                                        <button type="button" id="user-log" class="d-flex gap-3 align-items-center w-400">
                                            <div class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0">
                                                <img src="<?php echo $_SESSION['profile_image'] ?>" alt="logo" />
                                        
                                            </div>
                                            <span class="fs-14 text-black flex-grow"><?php echo $_SESSION['first_name']; ?></span>
                                        </button>
                                        <div class="user-log-box">
                                            <div class="row">
                                            <div class="hotel_a">
                                             <div class="stars-outer">
                                               <div class="stars-inner"></div>
                                               </div>
                                             </div>

                                            </div>
                                            <div class=" d-flex flex-column">
                                
                                        
                                        
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-sm ">Online</button>
          
                    <button type="button" class="btn btn-success">Busy</button>
                  </div>
          
                  <a href="/apps/work/ui/views/profile/profile.php?ui=<?php echo $_SESSION['id']; ?>" target="_blank"><i class="fal fa-address-card"></i>
                                                    Profile</a>
                                                    <a href="/apps/work/ui/views/home/statistics.php"><i class="fas fa-eye mt-2"></i> 
                                                    Statistics</a>
                                                    <a href="/apps/work/ui/views/finance/finances.php"><i class="fas fa-eye mt-2"></i> 
                                                    Finances</a>
                                                    <a href="/apps/work/ui/views/settings/settings.php?form=profile"><i class="fas fa-eye mt-2"></i> 
                                                    Settings</a>
                                                    <a href="/apps/work/ui/views/auth/invite.php"><i class="fas fa-eye mt-2"></i> 
                                                    Invite&Earn</a>
                                                <hr>
                                                <form action="/api/logsAPI.php" method="post">
                                        
                                                     <input type="hidden" name="act" id="act" value="logout">
                                                    <div class="shrink">
                                                        <button type="submit" class="btn btn-sm">
                                                         Logout
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                        
                                        </div>
                                    </div>
                        

                            
                                    <div class="user-pic rel w-100">
                        
                                    <form  action="/api/logsAPI.php" method="POST" >

                                                                            
                                    
                                    <div class="flex fs-13">
                            <input type="hidden" name="ud" id="ud" value="<?php echo $_SESSION['id']; ?>">
                                    <h7><?php echo $_SESSION['role']; ?></h7>
                                    |<h7><?php echo $_SESSION['country']; ?></h7>
                            <select name="role" id="role">
                                    <option value="Select">Select</option>
                                    <option value="Professional">Professional</option>
            
    
                                    <option value="Client">Client</option>
                    
                                </select>
                                <button type="submit" name="sw">Switch</button>
                            
                            </div>
                        
    
                
        
             </form>
                            
                                       </div>
                           
                                </div>


                    
                            </div>
                        </nav>
