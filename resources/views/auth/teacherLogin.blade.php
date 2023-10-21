@extends('layouts.teachersLogin')
@section('content')


  <!-- ======= Mobile nav toggle button ======= -->
  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
  <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav id="navbar" class="navbar nav-menu">
      <ul>
        <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <div class="row">
    <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
      <div class="card">
            <div class="container" data-aos="zoom-in" data-aos-delay="100">
              <h1><img src="assets/img/loginlogo31.png" 
                      alt="logo"
                      width="400">
              </h1>
               <p>The STI College General Santos' <br> station for <span class="typed" data-typed-items="Exam Schedule, Reschedule Request, Special Exam Request"></span></p>     
            </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" >
      <div class="card card-default">
        <div class="wrapper fadeInDown">
          <div id="formContent">
            <!-- Tabs Titles -->
        
            <!-- Icon -->
            <div class="fadeIn first">
              <h2>Faculty Sign In</h2>
            </div>
        
            <!-- Login Form -->
            <form>
              <input type="number" id="login" class="fadeIn second" name="login" placeholder="Faculty IDN">
              <input type="password" id="password" class="fadeIn third" name="login" placeholder="Password">
              <input type="submit" class="fadeIn fourth" value="Log In">
            </form>
        
            <!-- Remind Passowrd -->
            <div id="formFooter">
              <a class="underlineHover" href="#">Forgot Password?</a>
            </div>
        
          </div>
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><img src="assets/img/loginlogoabout.png" id="icon" alt="User Icon" /></h2>
          <p>ReminEx is an Exam Reminder and Scheduling Management System that provides a comprehensive solution for scheduling exams, managing conflicts, and facilitating rescheduling requests. By incorporating an efficient algorithm and considering various constraints, the system streamlines the exam management process, ensuring accuracy, transparency, and optimal resource utilization. 
          </p>
        </div>

            <!-- ======= About Programmers Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Capstone Project Members</h2>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/basan.png" class="testimonial-img" alt="">
                <h3>Gian Rogel Y. Basan</h3>
                <h4>STI College Gensan - BSIT Student</h4><br>
                <h4>Calumpang, General Santos City</h4>
                <h4>gbasan008@gmail.com</h4>
                <h4>09972282229</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Verify and Execute. Ipasa mi Sir Dan!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End programmers item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/ano.jpg" class="testimonial-img" alt="">
                <h3>Ryan Jun A. Año</h3>
                <h4>STI College Gensan - BSIT Student</h4><br>
                <h4>Phas1 1 La Consolacion, Apopong, General Santos City</h4>
                <h4>ryan.rain79@gmail.com</h4>
                <h4>09217390747</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Pen is Mightier than the Sword.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
            
            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/degamo.jpg" class="testimonial-img" alt="">
                <h3>Maedy Luna E. Degamo</h3>
                <h4>STI College Gensan - BSIT Student</h4><br>
                <h4>Prk. 19, Promiseland 2, Mabuhay, General Santos City</h4>
                <h4>Degamo.2384140@gmail.com</h4>
                <h4>09661348195</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Time is Gold.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/begtasen.jpg" class="testimonial-img" alt="">
                <h3>Rhea Mave C. Begtasen</h3>
                <h4>STI College Gensan - BSIT Student</h4><br>
                <h4>Prk. Malinawon, Poblacion, Polomolok, South Cotabato</h4>
                <h4>rheamavec@gmail.com</h4>
                <h4>093170009789</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Pamasahe is the key.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row mt-1">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>STI College General Santos</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>stigensan@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>STI College General Santos</h3>
      <h4>Lagao, General Santos City</h4>
      <div class="copyright">
        <strong><span>Reminex</span></strong>. All Rights Reserved
      </div>
      <!--
        <div class="credits">
        All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: [license-url] -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/ 
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
        -->
        
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



@endsection

@section('scripts')

 <!-- Vendor JS Files -->
 <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Login Form JS -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection