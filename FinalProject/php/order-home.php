<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>PAPIS PIES</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>


  <body>

    <!-- ********************************************************* NAVAGATION BAR *********************************************************** -->

    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark fixed-top">
      <div class="container">
          <a href="#" class="navbar-brand">(404) 440-4044</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-Menu" aria-controls="navbar-Menu" expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-Menu" align="right">
            <ul class="navbar-nav ml-auto">
              <?php
				session_start();
				if(isset($_SESSION['user_id'])){
					?>
				<li class="nav-item mr-3">
                <a class="nav-link" href="../home.html">HOME</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="UserAccount.php">MY ACCOUNT</a>
              </li>
			  <li class="nav-item mr-3 ">
                <a class="nav-link" href="logout.php">LOG OUT</a>
              </li>
			   <?php
				}else{
					?>
				<li class="nav-item mr-3">
                <a class="nav-link" href="../home.html">HOME</a>
              </li>
			   <li class="nav-item mr-3">
                <a class="nav-link" href="signupForm.php">SIGN UP</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="login.php">SIGN IN</a>
              </li>
			   <?php
				}
			
			 ?>
            </ul>
          </div>
        </div>
    </nav>



  <!-- ********************************************************* MAIN SECTION *********************************************************** -->
    <section>
        <div class="row order-type-main text-light">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 pt-3 text-center pb-3">
            <form class="orderStartForm" action="orderStart.php" method="POST">
              <div class="center-div-left p-4">
                <img src="../img/papislogo.png" alt="logo" style="width: 150px;" class="img-responsive">
                <h4 class="ordertype-header pt-3">TYPE OF ORDER?</h4>
                <div class="radio-btn-container align-right">
                  <input class="radio-btn" type="radio" checked="checked" name="ordertype" value="carryout">  CARRYOUT<br>
                  <input class="radio-btn" type="radio" name="ordertype" value="delivery">  DELIVERY<br>
                </div>
                <label for="radio-btn-reaction"><h4 class="pt-3">WHEN?</h4></label>
                <div class="dropdown">
                  <div class="dropdown-content">
                    <select class="dropbtn text-center" name="order-time">
                      <option value="asap">ASAP</option>
                      <option value="1 hour">1-HOUR</option>
                      <option value="future">FUTURE</option>
                    </select>
                  </div>
                </div>
                  <div class="pt-3">
                    <input type="submit" name="ordertypesubmit" value="submit" class="btn btn-outline-light">
                  </div>
              </div>
            </form>
          </div>
          <div class="order-home-img col-xs-12 col-sm-12 col-md-12 col-lg-9">
            <img class="d-block w-100" src="../img/pizza.jpg" alt="fresh">
          </div>
      </div>
    </section>

      <!-- ********************************************************* CARRYOUT OR DELIV *********************************************************** -->
    <section id="family">
      <div class="container">
        <div class="row">
          <div class="col-xs-12  col-sm-12 col-md-12 col-lg-6 p-5 text-center text-light">
            <h2>CARRYOUT or DELIVERY</h2>
            <p>People always ask why Papi only does carryout or delivery, his answer? </p>
            <p> Simple! Pizza is for family time! Papi encourages family time, and what is better than family time with a pizza!? </p>

          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 p-5 text-light">
            <div class="fam-img">
              <img src="../img/family2.jpg" class="img-fluid" alt="Our Family">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ********************************************************* LOGIN *********************************************************** -->



    <!-- ********************************************************* FOOTER *********************************************************** -->
    <section id="footer" style="
      position: fixed;
      right: 0;
      left: 0;
      bottom: 0;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="copyrights text-light text-center">
              <p>© 2019 Kennesaw Student JGrady6 </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

          </div>
        </div>
      </div>
    </section>




      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <!-- scrollspy -->
      <script>$('body').scrollspy({ target: '#navbar-Menu', offset: 85 })</script>
      <!-- Smooth Scroll -->
      <!-- <script src="../js/smooth-scroll.js"></script> -->
      <!-- <script>var scroll = new SmoothScroll('a[href*="#"]');</script> -->

  </body>
</html>
