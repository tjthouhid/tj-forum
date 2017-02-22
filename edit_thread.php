<?php  
include 'Db.php';
session_start();
$s="";
$thread_id=""; 
$thread_title=""; 
$thread_description=""; 
$topic_id=""; 
if(isset($_GET['id'])&&isset($_SESSION['user_loggedIn'])){
    $thread_id=$_GET['id'];
    $db = new Db();
    $connection = $db-> connect();
    $dbPrefix=$db->dbPrefix();
    $table_name=$dbPrefix."threads";
    $sql="SELECT * FROM ".$table_name." where thread_id='$thread_id' && deleted='0' Limit 1";
    $result=$connection->query($sql);   
    if($result->num_rows>0){
        
        while ($obj = $result->fetch_object()){
            if($obj->user_id==$_SESSION['user_id']){
                $thread_id=$obj->thread_id; 
                $thread_title=$obj->thread_title; 
                $thread_description=$obj->thread_description; 
                $topic_id=$obj->topic_id; 
            }else{
                //Eror Page
                $_SESSION['noty_msg']="Sorry You Are Not Allowed to edit another User's Thread!";
                $_SESSION['noty_type']="error";
                header("Location:index.php");
                exit;
            }
        }
    }else{
        //Eror Page
        $_SESSION['noty_msg']="Sorry There is No Post For This id!";
        $_SESSION['noty_type']="error";
        header("Location:index.php");
        exit;
        
    }

}else{
    //Eror Page
    $_SESSION['noty_msg']="Sorry You Have Tried To Access Protected Page!";
    $_SESSION['noty_type']="error";
    header("Location:index.php");
    exit;
}
?>
<?php include ("header.php"); ?>


            <section class="content main-div">
                 <!-- Start Breadcrumb -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf col-md-offset-2">
                            <a href="javascript:void(0);">Edit Thread</a> 
                        </div>
                    </div>
                </div><!-- End Breadcrumb -->


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-md-offset-2">



                            <!-- POST -->
                            <div class="post">
                                <form action="functions/updateThread.php" class="form newtopic" id="new_thread" method="post">
                                <input type="hidden" name="thread_id" value="<?php echo $thread_id;?>">
                                    <div class="topwrap">
                                        <div class="userinfo pull-left">
                                            <div class="avatar">
                                                <img src="uploads/<?php echo $_SESSION['user_image'];?>" alt="" />
                                                
                                            </div>

                                           
                                        </div>
                                        <div class="posttext pull-left">

                                            <div>
                                                <input type="text" placeholder="Enter Thread Title" name="thread_title" class="form-control" value="<?php echo $thread_title;?>"/>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <select name="topic_id" id="topic_id"  class="form-control" >
                                                        <option value="0" disabled selected>Select Topic</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                   or <button type="button" class="btn btn-primary" id="add-new-topic">Add New Topic</button>
                                                </div>
                                            </div>

                                            <div>
                                                <textarea name="thread_description" id="thread-textarea" placeholder="Description"  class="form-control" ><?php echo $thread_description;?></textarea>
                                            </div>
                                            


                                        </div>
                                        <div class="clearfix"></div>
                                    </div>                              
                                    <div class="postinfobot">

                                        

                                        <div class="pull-right postreply">
                                            <div class="pull-left smile"><a href="javascript:void(0);"><i class="fa fa-smile-o"></i></a></div>
                                            <div class="pull-left"><button type="submit" class="btn btn-primary">Update</button></div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div><!-- POST -->

                            
                        </div>
                        
                    </div>
                </div>



             


            </section>

          <?php include 'footer.php' ?>
          <script type="text/javascript">
              jQuery(function($){
                load_topics("<?php echo $topic_id;?>");
              })
          </script>