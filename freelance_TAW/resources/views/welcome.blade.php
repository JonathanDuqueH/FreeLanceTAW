<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>freelancer</title>
<!-- Stylesheets -->
<link href="assets-paginaprincipal/css/bootstrap.css" rel="stylesheet">
<link href="assets-paginaprincipal/css/style.css" rel="stylesheet">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/responsive.css" rel="stylesheet">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>
<div class="page-wrapper" >
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    <!-- Main Header -->
    <header class="main-header">
    	<!-- Header Top -->
    	<div class="header-top">
        	<div class="auto-container clearfix">
            	<!-- Top Left -->
            	<div class="top-left">
                	<ul class="clearfix">
                      <!--  <li>Contactanos: @injection('page')</li>-->
                    	<li>Contactanos: 1630206@upv.edu.mx</li>
                        <li>Whatsapp: 831-103-0571</li>
                        <!--ACCEDIENDO CON VARIABLE GLOBAL-->
                         <!--<li>831-103-0571</li>
                        {{ Config::get('siteVars.name') }}-->
                       <li>Horario de atención: Lunes a viernes 9:00-17:30 hrs. </li>
                    </ul>
                </div>
                
                <!-- Top Right -->
                <div class="top-right">
                	<!--Social Links Style One-->
                	<div class="social-links-one clearfix">
                    	<a href="#" class="facebook"><span class="fa fa-facebook-f"></span></a>
                        <a href="#" class="twitter"><span class="fa fa-twitter"></span></a>
                        <a href="#" class="google-plus"><span class="fa fa-google-plus"></span></a>
                       
                    </div>
                </div>
                
            </div>
        </div><!-- Header Top End -->
        
        <!-- Header Lower -->
        <div class="header-lower">
        	<div class="auto-container clearfix">
            	
                <!--Outer Box-->
                <div class="outer-box">
                
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html"><img src="images/images-paginaprincipal/logo.png" width="100" alt="Radium"></a>
                     </div>
                     
                
                    
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        
                        <div class="navbar-header">
                            <!-- Toggle Button -->    	
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation">
                                <li class=""><a href="#inicio">Inicio</a>
                              
                                </li>
                                <li class=""><a href="#faq">Preguntas Frecuntes</a>
                                   
                                </li>
                                
                                @if (Route::has('login'))
                                <li>
                                    @auth
                                        <a href="{{ url('/main') }}">Panel</a>
                                    @else
                                        <a href="{{ route('login') }}">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </li>
                                <div class="flex-center position-ref full-height">
                                @endif
                              <!--<li class="dropdown"><a href="#">login</a>
                                     <div class="flex-center position-ref full-height">-->
            

            <div class="content">
                
            </div>
        </div>
                                </li>
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                    
                </div>
            </div>
        </div><!-- Header Lower End-->
        
    </header><!--End Main Header -->
    
      
    
    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/images-paginaprincipal/imagen3.jpg);">
    	<div class="auto-container">
        	<div class="sec-title">
                <h1>FREELANCER</h1>
            </div>
        </div>
        <!--Down Arrow-->
        <div class="down-arrow scroll-to-target" data-target=".scroll-to-this"></div>
    </section>
    
    
    <!--Default Section-->
    <section class="default-section scroll-to-this">
    	<div class="auto-container">
        	<div class="row clearfix">
            	
                <!--Column-->
                <div class="column text-column col-md-6 col-sm-12 col-xs-12">
                	<div class="inner-box">
                        
                        <div class="sec-title">
                            <h2 class="bigger-title" id="inicio">¿Necesitas que te hagan un trabajo?</h2>
                        </div>
                    
                        <div class="text">
                          <h2 class="bigger-title">Elige freelancers</h2>
                        	<p>
                          Sean cuales sean sus necesidades, habrá un profesional independiente para que lo haga: desde diseño web, desarrollo de aplicaciones móviles, asistentes virtuales, fabricación de productos y diseño gráfico (y mucho más).
                          </p>
                        </div>
                        <br>
                    <div class="sec-title">
                            <h2 class="bigger-title">Paga de forma segura</h2>
                        </div>
             <div class="text">
                        	<p>Con pagos seguros y miles de profesionales revisados para elegir, Freelancer es la forma más sencilla y segura de realizar el trabajo en línea.</p>
                        </div>
                
                    </div>
                </div>
                <!--Column / Image Column-->
                <div class="column image-column col-md-6 col-sm-12 col-xs-12">
                	<figure class="image"><img class="img-responsive" src="images/images-paginaprincipal/trabajo.jpg" width="500" alt=""></figure>
                </div>
                       <div>
                         <h2 class="bigger-title">BENEFICIOS</h2>
                        
                          <div class="text">
                        	<p>1. Encuentre profesionales en los que pueda confiar explorando sus muestras de trabajos anteriores y leyendo sus reseñas de perfil.</p>
                          <p>2. Recibe ofertas gratuitas de nuestros talentosos freelancers en segundos. </p>
                          <p>3. Puede chatear con sus trabajadores independientes para obtener actualizaciones constantes sobre el progreso de su trabajo.</p>
                          <p>4. Pague por el trabajo cuando se haya completado y esté 100% satisfecho.</p>
                          <p>5. Soporte 24/7. Nuestro soporte consiste en personas reales que están disponibles las 24 horas, los 7 días de la semana</p>
                        </div>
                       
      <div class="column image-column col-md-6 col-sm-12 col-xs-12">
                	<figure class="image"><img class="img-responsive" src="images/images-paginaprincipal/faq.jpg" width="500" alt=""></figure>
                </div>
            
                        <div class="sec-title">
                            <h2 class="bigger-title" id="faq">Preguntas Frecuentes</h2>
                        
                      ¿Qué es freelancer?<br>
Freelancer es una plataforma de contratación externa en línea que pone en contacto a empleadores y empresas con una red global de trabajadores independientes. Cualquier miembro puede publicar un proyecto, ya sea un trabajo a corto o largo plazo, y elegir entre profesionales independientes calificados que ofrecen propuestas de ofertas con cotizaciones de tarifas y estimaciones de tiempo para completar el trabajo. Es un acuerdo de beneficio mutuo.
<br>Los empleadores pueden elegir entre miles de trabajadores independientes que tienen las habilidades exactas necesarias para hacer el trabajo, sin asumir el gasto y el compromiso de contratar a empleados a tiempo completo en persona.
<br>

          
        </div>
    </section>
    
    
    
    <!--Main Footer-->
    <footer class="main-footer">
    	
        <!--Footer Upper-->        
        <div class="footer-upper">
            <div class="auto-container">
                <div class="row clearfix">
                
                	<div class="col-lg-4 col-sm-6 col-xs-12 column">
                        <div class="footer-widget about-widget">
                            <h2>Proyecto</h2>
                            <div class="text">
                            	<p>Universidad Politécnica de Victoria </p>
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    
                  
                    
                </div>
            
                
            </div>
        </div>
        
        <!--Footer Bottom-->
    	<div class="footer-bottom">
            <div class="auto-container clearfix">
            	<div class="logo pull-left"><a href="#"><img src="images/images-paginaprincipal/logo.png" width="100" alt=""></a></div>
                <!--Copyright-->
                <div class="copyright pull-right">Copyright 2020 &copy; <strong></strong></div>
            </div>
        </div>
        
    </footer>
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".main-header"><span class="fa fa-arrow-up"></span></div>

<script src="assets-paginaprincipal/js/jquery.js"></script> 
<script src="assets-paginaprincipal/js/bootstrap.min.js"></script>
<script src="assets-paginaprincipal/js/bxslider.js"></script>
<script src="assets-paginaprincipal/js/owl.js"></script>
<script src="assets-paginaprincipal/js/jquery.fancybox.pack.js"></script>
<script src="assets-paginaprincipal/js/jquery.fancybox-media.js"></script>
<script src="assets-paginaprincipal/js/wow.js"></script>
<script src="assets-paginaprincipal/js/script.js"></script>
</body>
</html>
