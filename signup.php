<?php  session_start(); 
if(isset($_SESSION['user_loggedIn'])){
  //Eror Page
  $_SESSION['noty_msg']="Sorry You are already Logged in!";
  $_SESSION['noty_type']="error";
  header("Location:index.php");
  exit;
}
$s="";
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TJ's-Forum :: New account</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom -->
        <link href="css/custom.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->

        <!-- fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">

        <!-- CSS STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

       

    </head>
    <body class="newaccountpage">

        <div class="container-fluid">
            <!-- Start Header Nav Bar -->
           <section class="headernav">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="index.html"><img src="images/final.png" alt=""  /></a></div>
                        <div class="col-lg-5 col-md-4 ">
                        <ul class="menu">
                            <li><a href="index.php">Forum</a></li>
                            <?php if(isset($_SESSION['user_loggedIn'])){?>
                                <li><a href="new_thread.php">Add Thread</a></li>
                            <?php } else{ ?>
                            
                            
                            <li class="active"><a href="signup.php">Registration</a></li>
                            <li><a href="login.php">Login</a></li>
                            <?php } ?>
                        </ul>
                            
                        </div>
                        <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                            <div class="wrap">
                                <form action="index.php" method="get" class="form">
                                    <div class="pull-left txt"><input type="text" name="s" class="form-control" placeholder="Search Threads" value="<?php echo $s;?>"></div>
                                    <div class="pull-right"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                        <?php if(isset($_SESSION['user_loggedIn'])){?>
                        <div class="col-lg-2 col-xs-12 col-sm-5 col-md-2 avt">
                            <!-- <div class="stnt pull-left">                            
                                <form action="http://forum.azyrusthemes.com/03_new_topic.html" method="post" class="form">
                                    <button class="btn btn-primary">Start New Topic</button>
                                </form>
                            </div> -->
                            

                            <div class="avatar pull-left dropdown">
                                <a data-toggle="dropdown" href="#"><img src="uploads/<?php echo $_SESSION['user_image'];?>" alt="" /></a> <b class="caret"></b>
                               
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Thread</a></li>
                                
                                    <li role="presentation"><a role="menuitem" tabindex="-3" href="functions/logout.php">Log Out</a></li>
                                    
                                </ul>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section><!-- End Header Nav Bar -->
              


            <section class="content">
                 <!-- Start Breadcrumb -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf">
                            <a href="#">Create New account</a> 
                        </div>
                    </div>
                </div><!-- End Breadcrumb -->


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-md-offset-2">



                            <!-- POST -->
                            <div class="post">
                                <form action="functions/addUser.php" class="form newtopic" id="signup" method="post" enctype="multipart/form-data">
                                    <div class="postinfotop">
                                        <h2>Create New Account</h2>
                                    </div>

                                    <!-- acc section -->
                                    <div class="accsection">
                                        <div class="acccap">
                                            <div class="userinfo pull-left">&nbsp;</div>
                                            <div class="posttext pull-left"><h3>Required Fields</h3></div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="topwrap">
                                            <div class="userinfo pull-left">
                                               <!--  <div class="avatar">
                                                    <img src="images/avatar-blank.jpg" alt="" />
                                                    <div class="status green">&nbsp;</div>
                                                </div>
                                                <div class="imgsize">60 x 60</div>
                                                <div>
                                                    <input type="file" class="btn" name="user_image">
                                                </div> -->
                                            </div>
                                            <div class="posttext pull-left">
                                                

                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" placeholder="First Name" name="user_fname" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" placeholder="Last Name" name="user_lname" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" placeholder="User Name" name="user_name" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="email" placeholder="Email" name="user_email" class="form-control" />
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="password" placeholder="Password" name="user_password" id="user-pass" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="password" placeholder="Retype Password" name="user_password_con" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="row margin-top-10">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label class="">User Image </label>
                                                        <input type="file" class="form-control" name="user_image">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="clearfix"></div>
                                        </div>  
                                    </div><!-- acc section END -->



                                


                                  









                                    <div class="postinfobot">

                                        <!-- <div class="notechbox pull-left">
                                            <input type="checkbox" name="note" id="note" class="form-control" />
                                        </div>

                                        <div class="pull-left lblfch">
                                            <label for="note"> I agree with the Terms and Conditions of this site</label>
                                        </div> -->

                                        <div class="pull-right postreply">
                                            
                                            <div class="pull-left"><button type="submit" class="btn btn-primary" name="signup">Sign Up</button></div>
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