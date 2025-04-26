<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/ProfileController.php';
$profile = new ProfileController();

$reviewer = $profile->url_var($_GET['reviewer']);
$reviewee = $profile->url_var($_GET['reviewee']);
$contract= $profile->url_var($_GET['ct']);
        




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
<section class="p-5 shadow bordered ">

    <form action="/api/profileAPI.php" method="post" style="" >
           
        <div class="container-lg">
            <div class="row gy-4">
                <input type="hidden" name="reviewer" value="<?php echo $reviewer; ?>">
                <input type="hidden" name="reviewee" value="<?php echo $reviewee; ?>">
                <input type="hidden" name="contract" value="<?php echo $contract; ?>">

        
                <div class="col-md-6 m-auto">
                    <div class="d-flex flex-column gap-2">
                        
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Review 
                            <span class="text-danger">*</span></label>
                            <textarea name="review" id="review" cols="30" rows="10" class="form-control" required>
                             
                            </textarea>
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <label for="" class="text-black fs-14 fw-600">Stars 
                            <span class="text-danger">*</span></label>
                            <input type="number" name="rating" id="rating" class="form-control" required>
                        
                        </div>

                        
                        <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</section>

<?php
include $path . '/apps/work/ui/layouts/footer.php';

?>
