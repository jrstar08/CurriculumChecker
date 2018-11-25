<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <style>
        /* ---- reset ---- */ body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #ffffff; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
    </style>
</head>
<body>    
    <div id="particles-js" style="height: 100vh;"></div>     
    <!--Main Layout-->
    <main style="margin-top: 0; padding-top: 0; top: 0;">
           <!-- START -->
            <div style="height: 25vh;"></div>
            <div class="ui card" style="border: 0; box-shadow: 0 0 0; margin: 0 auto; text-align: center;">
                <div id="loader">
                    <img src="lib/loader.svg">
                    <h2>ANALYZING STUDENT GRADES</h2>
                </div>
            </div>
            <!-- END -->
    </main>
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/particles.min.js"></script>
    <script>
        particlesJS("particles-js", {"particles":{"number":{"value":20,"density":{"enable":true,"value_area":500}},"color":{"value":"#b71c1c"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"https://www.plm.edu.ph/images/PLM_Seal_BOR-approved_2014.png","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":10,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":500,"color":"#ffffff","opacity":0.4,"width":2},"move":{"enable":true,"speed":4,"direction":"top","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":0.5}},"bubble":{"distance":400,"size":4,"duration":0.3,"opacity":1,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
    </script>   
    <script>
        $.ajax({  
            url:"sidenav.php",  
            method:"POST",  
            data: {},
            success:function(data){
                location = "sidenav.php";
            }  
        });
    </script>
</body>
</html>