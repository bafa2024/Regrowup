<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];

include $path.'/work/ui/layouts/nav.php';



?>
<style>
  .chatbtn{
    display:none;
  }
</style>
<section class="d-block py-60 upload-profile-box">
  <div class="container-lg">
    <div class="d-block rounded-3 bg-white p-4">
      <form action="/api/blogAPI.php" method="post" enctype="multipart/form-data">
             
      <div class="row gy-3 mb-3 order-md-1">
          <div class="col-12">
            <h2 class="text-black fs-20 text-uppercase fw-600">
              Post Blog
            </h2>
          </div>
          <div class="col-md-4 order-md-3 ms-auto">
            <div
              class="d-flex flex-wrap gap-2 upload-btns justify-content-md-end"
            >
            
              <button type="submit"  class="btn btn-primary" name="save">
              
              Create Blog
              </button>
            </div>
          </div>
          <div class="col-md-4 order-md-2">
            <div class="d-flex gap-4">
          
              <div class="d-flex flex-column gap-1">
                
                <div class="rel w-100 upload-btn-image">
                  <input type="file" name="upload"  id="upload" class="position-absolute zi-3"/>
                  <h4  class="mybg-primary text-white fs-14 py-2 px-3 w-200 rel zi-1 text-center rounded-2">
                    Upload Image
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row gy-3">
          <div class="col-md-6">
            <div class="d-flex flex-column gap-1">
              <label for="" class="text-black fs-14 fw-600">Heading of Post</label>

                <input type="text" name="title" id="title" required placeholder="Enter Your Name" />

               <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['user_id']; ?>" />

            </div>
          </div>
          <div class="col-12">
            <div class="d-flex flex-column gap-1">
              <label for="" class="text-black fs-14 fw-600">Your Message / Content</label>
              <textarea
                name="content" required
                id="content"
                cols="30"
                rows="5"
                class=""
              ></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="/ui/assets/js/blog.js"></script>
<?php
include $path.'/work/ui/layouts/footer.php';
?>