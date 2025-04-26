<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/ProfileController.php';
$profile = new ProfileController();
$user_id = $_SESSION['user_id'];
$details=$profile->view($user_id);

$profile_photo = $details['profile_image'];

$name=$profile->sanitize($details['name']);
$phone=$profile->sanitize($details['phone']);
$email=$profile->sanitize($details['email']);
$state=$profile->sanitize($details['state']);
$city=$profile->sanitize($details['city']);
$zip_code=$profile->sanitize($details['zip_code']);
$address=$profile->sanitize($details['address']);


if (isset($_POST['update_profile'])) {

    $photo_name = $_FILES['profile_photo']['name'];
    $photo_tmp = $_FILES['profile_photo']['tmp_name'];
    $photo_size = $_FILES['profile_photo']['size'];
    $name=$profile->sanitize($_POST['name']);
    $phone=$profile->sanitize($_POST['phone']);
    $email=$profile->sanitize($_POST['email']);
    $state=$profile->sanitize($_POST['state']);
    $city=$profile->sanitize($_POST['city']);
    $zip_code=$profile->sanitize($_POST['zip_code']);
    $address=$profile->sanitize($_POST['address']);

    

    $res = $profile->update_profile($photo_name, $photo_tmp, $photo_size, $name, $phone, $email, $state, $city, $zip_code, $address, $user_id);
    if ($res) {
        header("Location: /apps/work/ui/views/profile/profile.php");
    } else {
        echo "Error";
    }

}

include $path . '/apps/work/ui/layouts/nav.php';

?>

<style>
.postform {
    display: none;
}
.op-0 {
    opacity: 0;
    width: inherit;
}
</style>
<section class="py-60 step1">

    <form action="" method="post" enctype="multipart/form-data">
           
        <div class="container-lg">
            <div class="row gy-4">
                
        
                <div class="col-md-6 m-auto">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex gap-4">
                            <div class="user-pic w-80 h-80 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                <img src="<?php echo $profile_photo; ?>" alt="image" />
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <label for="" class="text-black fs-14 fw-600">Upload Profile Image</label>
                                <div class="rel w-140 upload-btn-image">
                                    <input type="file" name="profile_photo"
                                        required                                        title=""
                                        id="profile_photo" class="position-absolute zi-3 op-0" />
                                    <input type="hidden"
                                        value=""
                                        name="oldimage">
                                    <h4
                                        class="mybg-primary text-white fs-14 py-2 px-3 w-100 rel zi-1 text-center rounded-2">
                                        Select
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" value="<?php echo $name; ?>"
                                required placeholder="Enter Your Name" />
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Phone Number <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="phone" value="<?php echo $phone; ?>"
                                required placeholder="Enter Your Phone" />
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Email <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="email" value="<?php echo $email; ?>"
                                required placeholder="Enter Your Email" />
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">State <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="state" value=" <?php echo $state; ?> "
                                required placeholder="Enter Your State Name" />
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">City <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="city" value="<?php echo $city; ?>"
                                required placeholder="Enter Your City Name" />
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Zip Code <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="zip_code"
                                value="<?php echo $zip_code; ?>" required
                                placeholder="Enter Your Zip Code" />
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Address <span
                                    class="text-danger">*</span></label>
                            
                            <input type="text" name="address" value="<?php echo $address; ?>">
                        </div>
                        <div class="d-flex flex-wrap gap-2 upload-btns justify-content-md-end">
                            <button type="submit" name="update_profile">
                                <i class="fal fa-check" aria-hidden="true"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</section>

<?php
include $path . '/apps/work/ui/layouts/footer.php';

?>
