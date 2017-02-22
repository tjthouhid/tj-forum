<?php
session_start(); 
include 'Db.php';
include 'Pagination.php';
$thread_id=""; 
$thread_title=""; 
$thread_description=""; 
$topic_id="";
$topic_title="";
$action_access=false;
$user_id="";
$user_image=""; 
$userfull_name="";
$updated="";
$links="view_thread.php?";
if(isset($_GET['id'])){
    $thread_id=$_GET['id'];
    $links="view_thread.php?id=".$thread_id."&&";
    $db = new Db();
    $connection = $db-> connect();
    $dbPrefix=$db->dbPrefix();
    $table_name=$dbPrefix."threads";
    $table_name2=$dbPrefix."topics";
    $table_name3=$dbPrefix."users";
    $sql="SELECT thr.*,top.topic_title,concat(usr.user_fname,' ',usr.user_lname ) as userfull_name,usr.user_image FROM ".$table_name." as thr 
    left join ".$table_name2." as top on top.topic_id=thr.topic_id 
    left join ".$table_name3." as usr on usr.user_id=thr.user_id 
    where thr.thread_id='$thread_id' && thr.deleted='0' && top.deleted='0' Limit 1";
    $result=$connection->query($sql);   
    if($result->num_rows>0){
        
        while ($obj = $result->fetch_object()){
            if(isset($_SESSION['user_loggedIn'])){
                if($obj->user_id==$_SESSION['user_id']){
                    $action_access=true;
                }
            }
            
            $thread_id=$obj->thread_id; 
            $thread_title=$obj->thread_title; 
            $thread_description=$obj->thread_description; 
            $topic_id=$obj->topic_id; 
            $topic_title=$obj->topic_title; 
            $user_id=$obj->user_id; 
            $user_image=$obj->user_image; 
            $userfull_name=$obj->userfull_name; 
            $updated = new DateTime($obj->updated);
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
$where=" && thread_id='$thread_id'";
$s="";



$page_no=( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$perPage=10; // per page Data
$both_side=4; // BOth Side Page Number
$pagination= new Pagination("comment_id","comments",$where,$page_no,$both_side,$perPage);



$db = new Db();
$dbPrefix=$db->dbPrefix();
$table_name=$dbPrefix."comments";
$table_name2=$dbPrefix."users";
$sql="SELECT cmt.*,concat(usr.user_fname,' ',usr.user_lname ) as userfull_name,usr.user_image,usr.user_id FROM
 ".$table_name." as cmt 
 left join ".$table_name2." as usr on usr.user_id=cmt.user_id
 where 
 cmt.deleted='0'
 &&
 usr.deleted='0'
 ".$where." 
 order by comment_id ASC";

$result2=$pagination->getData( $page_no,$sql);


   



?>

<?php include ("header.php"); ?>


           


            <section class="content main-div">
                <!-- Start Breadcrumb -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf col-md-offset-2">
                            <a href="index.php">Forum</a> <span class="diviver">&gt;</span> <a href="view_topic.php?top_id=<?php echo $topic_id;?>"><?php echo $topic_title;?></a> 
                        </div>
                    </div>
                </div><!-- End Breadcrumb -->


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-md-offset-2">

                            <!-- Start Main Thread -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8">  
                                        <div class="post">
                                            <div class="topwrap">
                                                <div class="userinfo pull-left">
                                                    <div class="avatar">
                                                        <img src="uploads/<?php echo $user_image;?>" alt="" />
                                                        <div class="status green">&nbsp;</div>
                                                    </div>
                                                    <div class="author-name">
                                                        
                                                        <a href="view_user.php?id=<?php echo $user_id;?>"><?php echo $userfull_name;?></a>
                                                    </div>
                                                    <?php if($action_access){ ?>
                                                    <div class="action-btns">
                                                        <a href="edit_thread.php?id=<?php echo $thread_id;?>" class="edit-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="functions/delete_thread.php?id=<?php echo $thread_id;?>" class="delete-btn"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="posttext pull-left">
                                                    <h2><?php echo $thread_title;?></h2>
                                                    <div class="thread-details">
                                                        <p><?php echo $thread_description;?></p>
                                                    </div>
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>                              
                                            <div class="postinfobot">

                                               

                                                <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : <?php echo $updated->format("d M, Y");?> @ <?php echo $updated->format("g:i a");?></div>


                                                <div class="clearfix"></div>
                                            </div>
                                        </div><!-- End  Main Thread -->
                                    </div>
                                </div>
                            </div>




                             <?php if(isset($_SESSION['user_loggedIn'])){?>
                            <!-- POST -->
                            <div class="post">
                                <form action="functions/postComment.php" class="form" method="post">
                                <input type="hidden" name="thread_id" value="<?php echo $thread_id;?>">
                                    <div class="topwrap">
                                        <div class="userinfo pull-left">
                                            <div class="avatar">
                                                <img src="uploads/<?php echo $_SESSION['user_image'];?>" alt="" />
                                                <a href="view_user.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $_SESSION['user_name'];?></a>
                                            </div>

                                           
                                        </div>
                                        <div class="posttext pull-left">
                                            <div class="textwraper">
                                                <div class="postreply">Post a Comment</div>
                                                <textarea name="comment_detail" class="comment-thread" id="reply" placeholder="Type your message here"></textarea>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>                              
                                    <div class="postinfobot">

                                        

                                       

                                        <div class="pull-right postreply">
                                            <div class="pull-left smile"><a href="javascript:void(0);"><i class="fa fa-smile-o"></i></a></div>
                                            <div class="pull-left"><button type="submit" class="btn btn-primary">Post Comments</button></div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div><!-- POST -->
                            <?php }else{ ?>

                                <!-- POST -->
                                <div class="post">
                                    <div class="wrap-ut pull-left">
                                        <div class="userinfo pull-left">
                                            

                                            
                                        </div>
                                        <div class="posttext pull-left text-center">
                                             <h2> <a href="signup.php" class="btn btn-primary">Register Here</a> For Comment on this thread.</h2>
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div><!-- POST -->

                                

                            <?php } ?>
                            
    
                           <!-- Start Comment -->
                           <div class="container">
                                <div class="row">                                    
                                    <div class="col-lg-8 col-md-8">
                                        <h4>Comments</h4>
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                    <?php if($result2->num_rows>0){   
                                                                         
                                        while ($obj2 = $result2->fetch_object()){
                                            $action_access2=false;
                                            if(isset($_SESSION['user_loggedIn'])){
                                                if($obj2->user_id==$_SESSION['user_id']){
                                                    $action_access2=true;
                                                }
                                            }

                                        ?>
                                        <!-- POST -->
                                        <div class="post comment-div" comment-id="<?php echo $obj2->comment_id;?>">
                                            <div class="topwrap">
                                                <div class="userinfo pull-left">
                                                    <div class="avatar">
                                                        <img src="uploads/<?php echo $obj2->user_image;?>" alt="" />
                                                        
                                                    </div>
                                                    <div class="author-name">
                                                        
                                                        <a href="view_user.php?id=<?php echo $obj2->user_id;?>"><?php echo $obj2->userfull_name;?></a>
                                                    </div>
                                                    <?php if($action_access2){ ?>
                                                    <div class="action-btns">
                                                        <a href="javascript:void(0);" comment-id="<?php echo $obj2->comment_id;?>" class="edit-btn-comment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="javascript:void(0);" comment-id="<?php echo $obj2->comment_id;?>" class="delete-btn-comment"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                    <?php } ?>

                                                  
                                                </div>
                                                <div class="posttext pull-left">
                                                    <div class="view-feild">
                                                        <p><?php echo $obj2->comment_detail;?></p>
                                                    </div>
                                                    <div style="display: none;" class="edit-feild">
                                                        <textarea name="comment_detail" class="comment-thread" id="reply" placeholder="Type your message here"><?php echo $obj2->comment_detail;?></textarea>
                                                        <div class="postinfobot">

                                                            

                                                           

                                                            <div class="pull-right postreply">
                                                               
                                                                <div class="pull-left"><button type="button" class="btn btn-primary update-comment">Update</button></div>
                                                                <div class="clearfix"></div>
                                                            </div>


                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>                              
                                            <div class="postinfobot">

                                               <?php  $updated2 = new DateTime($obj2->updated); ?>

                                                <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on :  <?php echo $updated2->format("d M, Y");?> @ <?php echo $updated2->format("g:i a");?></div>

                                           
                                                <div class="clearfix"></div>
                                            </div>
                                        </div><!-- POST -->
                                            <?php                                    
                                        }
                                         echo $pagination->createLinks($links); 
                                         } ?>



                                        

                                    </div>
                                </div>
                               
                           </div>
                           <!--  End Comment -->

                            


                        </div>
                        
                    </div>
                </div>



                

            </section>

          
          <?php include 'footer.php' ?>