
    <?php session_start(); ?>

    <div id="navDiv" >
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">

            <div class="navbar-header">
                <div class=" navbar-brand  stage" >
                  <div class=" cube" >
                    <figure class="back"></figure>
                    <figure class="top"></figure>
                    <figure class="bottom"></figure>
                    <figure class="left"></figure>
                    <figure class="right"></figure>
                    <figure class="front"><div>3DP</div></figure>
                  </div>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand page-scroll" href="index.php">3D Platforma</a>
            </div>
           

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                  

                     
                    <?php

                         if(!isset($_SESSION['Username'])) {
                           
                        print(" <li>
                        <a class='page-scroll' href='signup.php'>SignUp</a>
                    </li>
                    ");
                            }

                           
                           

                     ?>
                    
                    <li>
                        <a class="page-scroll" href="tableAndLinks.php">Info</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="kontakt.php">Kontakt</a>
                    </li>
                       <?php

                         if(isset($_SESSION['Username'])) {
                            $username=$_SESSION['Username'];
                        print(" <li  id='tdp_border' >
                       
                       <a class='username page-scroll' href='indexLogovan.php'>" .$_SESSION['Username']."</a>
                        </li>

                        <li>
                        <a class='page-scroll' href='logout.php'>LogOut</a>
                        </li>
                    ");
                            }

                           
                     ?>
                    
                    

                </ul>
            </div>
           
        </div>
        
    </nav>
</div>






