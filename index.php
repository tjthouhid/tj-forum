<?php
session_start(); 
include 'Db.php';
include 'Pagination.php';
$links="index.php";
$where="";
$s="";
if(isset( $_GET['s'])){
     $s=$_GET['s'];
    $links.="?s=".$s."&&";

    $where=" && thread_title Like '%$s%'";
}else{
    $links.="?";
}


$page_no=( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$perPage=10; // per page Data
$both_side=4; // BOth Side Page Number
$pagination= new Pagination("thread_id","threads",$where,$page_no,$both_side,$perPage);



$db = new Db();
$dbPrefix=$db->dbPrefix();
$table_name=$dbPrefix."threads";
$table_name2=$dbPrefix."users";
$sql="SELECT thr.thread_title,thr.thread_id,thr.updated,concat(usr.user_fname,' ',usr.user_lname ) as userfull_name,usr.user_image,usr.user_id FROM
 ".$table_name." as thr 
 left join ".$table_name2." as usr on usr.user_id=thr.user_id
 where 
 thr.deleted='0'
 &&
 usr.deleted='0'
 ".$where." 
 order by thread_id ASC";

$result=$pagination->getData( $page_no,$sql);


   



?>

<?php include ("header.php"); ?>


            <section class="content main-div">
                <div class="container">
                    <div class="row">
                        <!-- Start Thread List -->
                        <div class="col-lg-8 col-md-8 col-md-offset-2">
                            
                            <?php
                         
                            if($result->num_rows>0){   
                                echo $pagination->createLinks($links);                                  
                                    while ($obj = $result->fetch_object()){
                                        ?>
                                        <!-- POST -->
                                        <div class="post">
                                            <div class="wrap-ut pull-left">
                                                <div class="userinfo pull-left">
                                                    <div class="avatar">
                                                        <img src="uploads/<?php echo $obj->user_image;?>" alt="" />
                                                        <div class="status green">&nbsp;</div>
                                                    </div>
                                                    <div class="author-name">
                                                        <a href="view_user.php?id=<?php echo $obj->user_id;?>"><?php echo $obj->userfull_name;?></a>
                                                    </div>
                                                    <?php if(isset($_SESSION['user_id'])&&($_SESSION['user_id']==$obj->user_id)){ ?>
                                                    <div class="action-btns">
                                                        <a href="edit_thread.php?id=<?php echo $obj->thread_id;?>" class="edit-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="functions/delete_thread.php?id=<?php echo $obj->thread_id;?>" class="delete-btn"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                    <?php } ?>

                                                    
                                                </div>
                                                <div class="posttext pull-left">
                                                    <h2><a href="view_thread.php?id=<?php echo $obj->thread_id;?>"><?php echo $obj->thread_title;?></a></h2>
                                                    <div class="views">
                                                    <?php $oDate = new DateTime($obj->updated); ?>
                                                     
                                                    <!-- <i class="fa fa-eye"></i> 1,568 &nbsp; -->
                                                    <i class="fa fa-calendar"></i> <?php echo $oDate->format("Y-M-d");?> &nbsp;<i class="fa fa-clock-o"></i>  <?php echo $oDate->format("g:i A");?>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="postinfo pull-left">
                                                <div class="comments">
                                                   
                                                    <div>
                                                        <a href="view_thread.php?id=<?php echo $obj->thread_id;?>" class="btn btn-primary">View</a>
                                                    </div>
                                                    

                                                </div>

                                                                                    
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- POST -->
                                        
                                   <?php                                    
                               }
                                echo $pagination->createLinks($links); 
                                }else{
                                    //No Data Found
                                ?>

                                <!-- POST -->
                                <div class="post">
                                    <div class="wrap-ut pull-left">
                                        <div class="userinfo pull-left">
                                            

                                            
                                        </div>
                                        <div class="posttext pull-left text-center">
                                            <h2>No Thread Found!</h2>
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div><!-- POST -->
                                    
                                   
                                    
                                <?php } ?>
                            


                          



                        </div><!-- End Thread List -->

                       
                    </div>
                </div>



                


            </section>

<?php include 'footer.php' ?>