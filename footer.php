<footer>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-1 col-xs-3 col-sm-2 logo "><a href="index.php"><img src="images/final.png" alt=""  /></a></div>
                        <div class="col-lg-8 col-xs-9 col-sm-5 ">Copyrights 2017, <a href="http://www.tjthouhid.com" target="_blank">tjthouhid</a></div>
                        <div class="col-lg-3 col-xs-12 col-sm-5 sociconcent">
                            <ul class="socialicons">
                                <li><a href="http://www.fb.com/tjthouhid" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                <li><a href="http://www.twitter.com/tjthouhid" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/tj-thouhid-5a874677/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>


        <!-- get jQuery from the google apis -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/bootbox.min.js"></script>
        <!-- Summernote Ediotor-->
        <script src="summernote/summernote.js"></script>
        <script type="text/javascript" src="js/signup.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
        <script type="text/javascript" src="js/notify.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>

        <?php  if(isset($_SESSION['noty_type'])){  ?>        
        
        <script type="text/javascript">
        var noty_msg="<?php echo $_SESSION['noty_msg'];?>";
        var noty_type="<?php echo $_SESSION['noty_type'];?>";
            showNotifyJs(noty_msg,noty_type);
        </script>
        <?php 
        unset($_SESSION['noty_msg']); 
        unset($_SESSION['noty_type']); 
        } ?>
    </body>


</html>