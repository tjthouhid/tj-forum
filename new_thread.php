<?php  session_start();
if(!isset($_SESSION['user_loggedIn'])){
  //Eror Page
  $_SESSION['noty_msg']="Sorry You Need to Logged in for access!";
  $_SESSION['noty_type']="error";
  header("Location:index.php");
  exit;
}
 $s=""; ?>




            <?php include ("header.php"); ?>


                <section class="content main-div">
                 <!-- Start Breadcrumb -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf col-md-offset-2">
                            <a href="#">Add New Thread</a> 
                        </div>
                    </div>
                </div><!-- End Breadcrumb -->


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-md-offset-2">



                            <!-- POST -->
                            <div class="post">
                                <form action="functions/addThread.php" class="form newtopic" id="new_thread" method="post">
                                    <div class="topwrap">
                                        <div class="userinfo pull-left">
                                            <div class="avatar">
                                                <img src="uploads/<?php echo $_SESSION['user_image'];?>" alt="" />
                                                
                                            </div>

                                           
                                        </div>
                                        <div class="posttext pull-left">

                                            <div>
                                                <input type="text" placeholder="Enter Thread Title" name="thread_title" class="form-control" />
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
                                                <textarea name="thread_description" id="thread-textarea" placeholder="Description"  class="form-control" ></textarea>
                                            </div>
                                            


                                        </div>
                                        <div class="clearfix"></div>
                                    </div>                              
                                    <div class="postinfobot">

                                        

                                        <div class="pull-right postreply">
                                            <div class="pull-left smile"><a href="javascript:void(0);"><i class="fa fa-smile-o"></i></a></div>
                                            <div class="pull-left"><button type="submit" class="btn btn-primary">Post</button></div>
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
                load_topics(0);
              })
          </script>