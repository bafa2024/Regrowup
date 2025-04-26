<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/HomeController.php';

$home=new HomeController();

$home->authCheck();

//$home->notications();

$user_type=$_SESSION['user_type'];


  include $path.'/work/ui/layouts/nav.php';
?>
<style>
.freelancerprofile {
    display: none;
}

.studentservice {
    display: none;
}

.contractservice {
    display: none;
}

/* Chrome, Safari, Edge, Opera */
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

<section class="py-60 offerpage">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-4 rounded-3">
                    <div class="row gy-4">
                        <div class="col-12">
                            <h2 class="mytext-black fw-800 text-uppercase fs-30 fs-md-38">
                                What service would you like to offer
                            </h2>
                        </div>
                        <div class="col-md-3">
                            <a onclick="return freelancerserverice()" href="javascript:void(0)"
                                class="d-block text-center ser-icon-box p-4 rounded-3">
                                <div class="mx-auto w-70 fulw mb-3">
                                    <img src="/ui/assets/images/icon-ser1.png" alt="image" /> 
                                    <img src="/ui/assets/images/icon-white1.png" alt="image" />
                                </div>
                                <h3 class="fw-800 text-uppercase fs-23">
                                    Freelance <br />
                                    Services
                                </h3>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" onclick="return studentserverice()"
                                class="d-block text-center ser-icon-box p-4 rounded-3">
                                <div class="mx-auto w-70 fulw mb-3">
                                    <img src="/ui/assets/images/icon-ser2.png" alt="image" />
                                    <img src="/ui/assets/images/icon-white2.png" alt="image" />
                                </div>
                                <h3 class="fw-800 text-uppercase fs-23">
                                  <!--   Student -->
                                  Educational
                                   <br />
                                    Services 

                                </h3>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" onclick="return contractserverice()"
                                class="d-block text-center ser-icon-box p-4 rounded-3">
                                <div class="mx-auto w-70 fulw mb-3">
                                     <img src="/ui/assets/images/icon-ser3.png" alt="image" /> 
                                    <img src="/ui/assets/images/icon-white3.png" alt="image" /> 
                                </div>
                                <h3 class="fw-800 text-uppercase fs-23">
                                    Contract <br />
                                    Services
                                </h3>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/work/ui/views/jobs/local_jobs.php" class="d-block text-center ser-icon-box p-4 rounded-3">
                                <div class="mx-auto w-70 fulw mb-3">
                                    <img src="/ui//assets/images/icon-ser3.png" alt="image" />
                                    <img src="/ui//assets/images/icon-white3.png" alt="image" />
                                </div>
                                <h3 class="fw-800 text-uppercase fs-23">
                                    Local <br />
                                    Services
                                </h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class=" py-60 freelancerprofile">
    <div class="container-lg">
        <div class="row">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="i2xEfay3yZYDBiFM8ZIPzamyPCaEQK3UsWyz0LAo">                <input type="hidden" name="id"
                    value=" 5 ">
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                    Provide the following information to get started
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Job</label>

                                    <input type="text" name="niche" required
                                        value=" asds "
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Hours per
                                        week</label>
                                    <!-- <select name="hourperweek" id="" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select</option>
                                                                                <option value="1" >1                                        </option>
                                                                                <option value="2" >2                                        </option>
                                                                                <option value="3" >3                                        </option>
                                                                                <option value="4" >4                                        </option>
                                                                                <option value="5" >5                                        </option>
                                                                                <option value="6" >6                                        </option>
                                                                                <option value="7" >7                                        </option>
                                                                                <option value="8" >8                                        </option>
                                                                                <option value="9" >9                                        </option>
                                                                                <option value="10" >10                                        </option>
                                                                                <option value="11" >11                                        </option>
                                                                                <option value="12"  selected >12                                        </option>
                                                                                <option value="13" >13                                        </option>
                                                                                <option value="14" >14                                        </option>
                                                                                <option value="15" >15                                        </option>
                                                                                <option value="16" >16                                        </option>
                                                                                <option value="17" >17                                        </option>
                                                                                <option value="18" >18                                        </option>
                                                                                <option value="19" >19                                        </option>
                                                                                <option value="20" >20                                        </option>
                                                                                <option value="21" >21                                        </option>
                                                                                <option value="22" >22                                        </option>
                                                                                <option value="23" >23                                        </option>
                                                                                <option value="24" >24                                        </option>
                                                                                <option value="25" >25                                        </option>
                                                                                <option value="26" >26                                        </option>
                                                                                <option value="27" >27                                        </option>
                                                                                <option value="28" >28                                        </option>
                                                                                <option value="29" >29                                        </option>
                                                                                <option value="30" >30                                        </option>
                                                                                <option value="31" >31                                        </option>
                                                                                <option value="32" >32                                        </option>
                                                                                <option value="33" >33                                        </option>
                                                                                <option value="34" >34                                        </option>
                                                                                <option value="35" >35                                        </option>
                                                                                <option value="36" >36                                        </option>
                                                                                <option value="37" >37                                        </option>
                                                                                <option value="38" >38                                        </option>
                                                                                <option value="39" >39                                        </option>
                                                                                <option value="40" >40                                        </option>
                                                                            </select> -->
                                    <input type="number" name="hourperweek" required class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Availability</label>
                                    <select name="availability" id="" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select</option>
                                        <option value="Yes" >Yes</option>
                                        <option value="No"  selected >No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">$/hr</label>
                                    <input type="text" name="price" required
                                        value=" qweqwe "
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Skills</label>
                                    <select name="skill[]" required multiple placeholder="Skill Select"
                                        data-search="true" id="multipleselect" data-silent-initial-value-set="true">
                                                                                <option value="4"
                                            >
                                            Data analysis</option>
                                                                                <option value="3"
                                            >
                                            Web development</option>
                                                                                <option value="2"
                                            >
                                            Graphic design</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">brief description of your
                                        self</label>
                                    <textarea name="description" required id="" cols="30" rows="6"
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">qweqweqwe</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto">
                                        Save details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class=" py-60 studentservice">
    <div class="container-lg">
        <div class="row">
            <form method="POST" action="http://itsugestion.com/dev/workhouse/serviceoffer/studentservice" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="i2xEfay3yZYDBiFM8ZIPzamyPCaEQK3UsWyz0LAo">                <input type="hidden" name="id" value="">
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                    Provide the following information to get started
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Name Of Course</label>

                                    <input type="text" value="" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        name="educationstatus">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Awarding body/Individual
                                        publication</label>
                                    <input type="text" required name="awarding" value=""
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Attach File</label>
                                    <input type="hidden" name="stfile"
                                        value="">
                                    <input type="file"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        name="file"
                                        title=""
                                         required >
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Description</label>
                                    <textarea type="text" name="description" required id="" placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto">
                                        Save details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="py-60 contractservice">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-4 rounded-3">
                    <div class="row gy-4">
                        <div class="col-12">
                            <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                Provide the following information to get started
                            </h2>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-3">
                                <div class="flex-shrink-0">
                                    <div class="w-40 h-40 rounded-circle overflow-hidden ofit">
                                        <img src="http://itsugestion.com/dev/workhouse/assets/images/user1.png" alt="image" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column gap-1">
                                        <h3 class="text-black fw-300 fs-16 text-uppercase">
                                            Alex
                                        </h3>
                                        <h6 class="text-black fw-300 fs-16 text-uppercase">
                                            Educational status
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="d-flex justify-content-between gap-2 border border-secondary border-opacity-25 rounded-2 p-3">
                                <div class="d-flex flex-column flex-grow-1 gap-2">
                                    <h3 class="text-black fw-700 fs-20 text-uppercase">CV</h3>
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-30 fulw">
                                                <img src="http://itsugestion.com/dev/workhouse/assets/images/re.png" alt="image" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-column gap-1">
                                                <h3 class="text-black fw-300 fs-16 text-uppercase">
                                                    Current resume
                                                </h3>
                                                <h6 class="text-black fw-300 fs-16 text-uppercase">
                                                    Updated                                                 </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <button class="text-black bg-transparent border-0" type="button"
                                        data-bs-toggle="modal" data-bs-target="#editcv">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="d-flex justify-content-between gap-2 border border-secondary border-opacity-25 rounded-2 p-3">
                                <div class="d-flex flex-column flex-grow-1 gap-2">
                                    <h3 class="text-black fw-700 fs-20 text-uppercase">
                                        Contact verification anf id
                                    </h3>

                                    <div class="d-flex flex-column gap-1">
                                        <h3 class="text-black fw-300 fs-16 text-uppercase">
                                            Email
                                        </h3>
                                        <h6 class="text-black fw-300 fs-16 text-uppercase">
                                            Phone number
                                        </h6>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <button class="text-black bg-transparent border-0" type="button"
                                        data-bs-toggle="modal" data-bs-target="#editcontact">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="d-flex justify-content-between gap-2 border border-secondary border-opacity-25 rounded-2 p-3">
                                <div class="d-flex flex-column flex-grow-1 gap-2">
                                    <h3 class="text-black fw-700 fs-20 text-uppercase">
                                        Job preference
                                    </h3>

                                    <div class="d-flex flex-column gap-1">
                                        <h3 class="text-black fw-300 fs-16 text-uppercase">
                                            Save specific detail like desire pay and schedule that
                                            help us match you with better jobs
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <button class="text-black bg-transparent border-0" type="button"
                                        data-bs-toggle="modal" data-bs-target="#editpre">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-justify-end">
                                <a href="http://itsugestion.com/dev/workhouse/jobs/contracts" class="post-btn ms-auto">
                                    Save details/Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Edit About --->
<div class="modal fade" id="editcv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Cv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="http://itsugestion.com/dev/workhouse/serviceoffer/contracts_cv" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="i2xEfay3yZYDBiFM8ZIPzamyPCaEQK3UsWyz0LAo">                        <div class="col-12">
                            <div class="col-md-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Upload Cv</label>
                                    <input type="file" name="file" accept="application/pdf"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required>
                                </div>
                            </div>
                            <div class="float-end mt-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editcontact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONTACT VERIFICATION ANF ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="http://itsugestion.com/dev/workhouse/serviceoffer/contracts_contact"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="i2xEfay3yZYDBiFM8ZIPzamyPCaEQK3UsWyz0LAo">                        <div class="col-12">
                            <div class="col-md-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Phone <span
                                            class="text-danger fs-16 fw-900">*</span></label>
                                    <input type="text" value="" name="phone"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Email <span
                                            class="text-danger fs-16 fw-900">*</span></label>
                                    <input type="email" value="mark@gmail.com" name="email"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required>
                                </div>
                            </div>
                            <div class="float-end mt-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editpre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">JOB PREFERENCE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="http://itsugestion.com/dev/workhouse/serviceoffer/contracts_jobpre"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="i2xEfay3yZYDBiFM8ZIPzamyPCaEQK3UsWyz0LAo">                        <div class="col-12">
                            <div class="col-md-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">JOB PREFERENCE <span
                                            class="text-danger fs-16 fw-900">*</span></label>
                                    <textarea type="text" name="job_prefrence"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                        required></textarea>
                                </div>
                            </div>

                            <div class="float-end mt-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include $path.'/work/ui/layouts/footer.php';


?>
