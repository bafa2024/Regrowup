<?php
include 'Controller.php';


class BlogController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    function save () {
        $this->query("INSERT INTO blogs(user_id,title,content,file_name,file_mime,file_data) VALUES (?,?,?,?,?,?)",
          [
          $_POST['uid'],
          $_POST['title'],
          $_POST['content'],
          $_FILES["upload"]["name"],
          mime_content_type($_FILES["upload"]["tmp_name"]),
          file_get_contents($_FILES["upload"]["tmp_name"])
          ]
        );
        return true;
      }

    public function view_blogs($uid){

        $sql="SELECT * FROM blogs WHERE user_id ='$uid'";
        $results=$this->run_query($sql);
        while($row=$results->fetch_assoc()){
            echo '
        <li>
        <div class="topic-box d-flex flex-column gap-3">
          <a href="#" class="topic-img d-block ofit">
            
            <img  src="data:image/jpeg;base64,'.base64_encode($row['file_data']).'"  width="400px" height="500px"/>
          </a>
          <div class="d-flex flex-column gap-2">
            <a href="#" class="gtext fw-600 fs-14">01 Mar 2023</a>
            <a href="#"
              ><h3 class="mytext-black fw-800 text-uppercase fs-20">
                '.$row['title'].'
              </h3></a
            >
            <a href="#">
              <p class="vclip fs-14 mytext-black fw-400">
              '.$row['content'].'
              </p>
            </a>
            <div class="d-flex gap-2">
              <p class="gtext fs-14 fw-500">
                <a href="http://itsugestion.com/dev/workhouse/lab/view/1"><i class="fas fa-eye"></i></a> <span>3</span>
              </p>
              <p class="gtext fs-14 fw-500">
                <i class="fas fa-comment"></i> <span>0</span>
              </p>
            </div>
          </div>
        </div>
      </li>
        ';    
        }
    
    }
    

    



}