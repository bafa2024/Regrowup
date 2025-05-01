
<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/HomeController.php';

$home=new HomeController();

$home->authCheck();

//$home->notications();

$user_type=$_SESSION['user_type'];

  include $path.'/apps/work/ui/layouts/nav.php';
  ?>
  
  
  <section class="d-block py-60 upload-profile-box">
    <div class="container-lg">

        <div class="row gy-3 mb-3">
            <div class="col-12">
                <div class="d-block rounded-3 bg-white px-4 pb-50 pt-4">
                    <div class="d-flex justify-content-between upload-btns">
                        <h2 class="text-black fs-20 text-uppercase fw-600">
                            Jump into course creation
                        </h2>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
                            Create your course
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="row gigview bg-white  p-md-5 bg-white rounded-3 shadow mt-4">
            <style>
            p.scroll-box {
                overflow-y: auto;
                height: 100px;
            }
            </style>
            <!--Item 1 -->
                                    <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> tset</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/p1.png" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> fejosa</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 4 days ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                test
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$1500</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> What is an API
Difference between API &amp; Webservice
HTTP Basics
Difference between XML &amp; JSON
How to create a mock API
How to test APIs using Postman</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/michael-dam-mEZ3PoFGs_k-unsplash.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Bharti Kumari</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 6 days ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                API Crash Course: How to Create, Test, &amp; Document your APIs
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$2580</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/user.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Hi</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 6 days ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                Test Title
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$1200</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> Build 16 web development projects for your portfolio, ready to apply for junior developer jobs.
Learn the latest technologies, including Javascript, React, Node and even Web3 development.
After the course you will be able to build ANY website you want.
Build fully-fledged websites and web apps for your startup or business.
Work as a freelance web developer.
Master frontend development with React
Master backend development with Node
Learn professional developer best practices</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/michael-dam-mEZ3PoFGs_k-unsplash.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Bharti Kumari</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 6 days ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                The Complete 2023 Web Development Bootcamp
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$2583</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> Automate tasks on their computer by writing simple Python programs.
Write programs that can do text pattern recognition with &quot;regular expressions&quot;.
Programmatically generate and update Excel spreadsheets.
Parse PDFs and Word documents.
Crawl web sites and pull information from online sources.
Write programs that send out email notifications.
Use Python&#039;s debugging tools to quickly figure out bugs in your code.
Programmatically control the mouse and keyboard to click and type for you.</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/michael-dam-mEZ3PoFGs_k-unsplash.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Bharti Kumari</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 6 days ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                Automate the Boring Stuff with Python Programming
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$2000</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> Master Digital Marketing Strategy, Social Media Marketing, SEO, YouTube, Email, Facebook Marketing, Analytics &amp; More!</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/michael-dam-mEZ3PoFGs_k-unsplash.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Bharti Kumari</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 3 weeks ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                The Complete Digital Marketing Course - 12 Courses in 1
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$2000</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> dfdsf</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/user.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Hi</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 3 weeks ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                df
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$dsfdsfdsf</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> hgh</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/user.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Hi</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 3 weeks ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                gh
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <p class="scroll-box"> description</p>



                                <ul
                                    class="mtext-black ls d-flex gap-2 p-0 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                                                        <img src="http://itsugestion.com/dev/workhouse/public/profileimage/user.jpg" alt="logo">
                                                                                    </div>
                                    </li>
                                    <li> Hi</li>
                                </ul>




                                <ul class="d-flex gap-4 p-0 flex-wrap ls">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            Posted 3 weeks ago
                                        </h4>
                                    </li>

                                </ul>
                            </div>

                            <strong class="vclip d-block mytext-black fs-14 mt-1">
                                Test
                            </strong>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>$</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
                                    <!--Item 2 -->

        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Your Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="/api/coursesAPI.php" enctype="multipart/form-data">
                        <input type="hidden" name="status" value="1">                       
                         <div class="col-12">
                            <div class="col-md-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Title <span
                                            style="color:red; font-size:16px;">*</span></label>
                                    <input type="text" name="title"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required>
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Picture
                                    </label>
                                    <input type="file" name="picture"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Discipline <span
                                            style="color:red; font-size:16px;">*</span></label>
                                    <input type="text" name="discipline"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required>
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Level <span
                                            style="color:red; font-size:16px;">*</span></label>
                                    <select required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        name="level">
                                        <option value="">--Select--</option>
                                        <option value="Basic">Basic</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advanced">Advanced</option>
                                        <option value="Master">Master</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Description <span
                                            style="color:red; font-size:16px;">*</span></label>
                                    <textarea name="description"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required /></textarea>
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Course File (optional)
                                    </label>
                                    <input type="file" name="file"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Course Link (optional)
                                    </label>
                                    <input type="text" name="link"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Country
                                    </label>
                                    <input type="text" name="country"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                                <div class="d-flex flex-column gap-2 mt-4">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Price of Course
                                    </label>
                                    <input type="text" name="price"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="float-end mt-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="create_course">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include $path.'/apps/work/ui/layouts/footer.php';


?>
