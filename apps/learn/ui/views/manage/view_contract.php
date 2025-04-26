<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/HomeController.php';

$home=new HomeController();

$home->authCheck();

//$home->notications();

$role=$_SESSION['role'];

include $path.'/work/ui/layouts/nav.php';
if($role=='Professional'){
    ?>

<section class=" py-60">
    <div class="container-lg">
        <div class="row">
            <div class="d-flex  border rounded-3 shadow bg-white p-4">
            
            <form method="POST" action="/api/contractAPI.php" enctype="multipart/form-data">
            
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 fs-28 fs-md-32">
                                Contract Details
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Title</label>

                                    <input type="text" name="title" required
                                     placeholder="Title....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Duration(month)</label>
                                
                                    <input type="number" name="duration" required class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
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
                                    <label for="" class="mytext-black fs-14 text-uppercase">Budget $</label>
                                    <input type="text" name="price" required
                                        value=""
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">brief description of your
                                        contract</label>
                                    <textarea name="description" required id="" cols="30" rows="6"
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Skills</label>
                                    <textarea name="skills" required id="" cols="30" rows="6"
                                        placeholder="Type Skills here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                        
                        

                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>


<?php
}else{
?>

<section class=" py-60">
    <div class="container-lg">
        <div class="row">
            <div class="d-flex  border rounded-3 shadow bg-white p-4">
            
            <form method="POST" action="/api/contractAPI.php" enctype="multipart/form-data">
            
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 fs-28 fs-md-32">
                                Contract Details
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Title</label>

                                    <input type="text" name="title" required
                                     placeholder="Title....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Duration(month)</label>
                                
                                    <input type="number" name="duration" required class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
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
                                    <label for="" class="mytext-black fs-14 text-uppercase">Budget $</label>
                                    <input type="text" name="price" required
                                        value=""
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">brief description of your
                                        contract</label>
                                    <textarea name="description" required id="" cols="30" rows="6"
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Skills</label>
                                    <textarea name="skills" required id="" cols="30" rows="6"
                                        placeholder="Type Skills here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                        
                        

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto" name="post_contract">
                                        Update
                                    </button> 
                                      <button type="submit" class="post-btn ms-auto" name="post_contract">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>


<?php
}
?>




<?php
include $path.'/work/ui/layouts/footer.php';
?>
