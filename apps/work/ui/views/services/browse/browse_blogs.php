<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/BlogController.php';
$blog=new BlogController();

include $path.'/apps/work/ui/layouts/nav.php';

?>
  <style>
  .chatbtn{display:none;}
</style>
<section class="d-block py-60">
      <div class="container-lg">
        <div class="row">
          <div class="col-12">
            <div class="d-block bg-white p-4 rounded-3">
              <ul class="topic-slider d-block p-0 ls">
                
                <?php
                $blog->view_blogs($_SESSION['user_id']);
                ?>
                                    
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php
include $path.'/apps/work/ui/layouts/footer.php';
?>
