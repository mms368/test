<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
   <title>Project 1</title>
   <link rel="stylesheet" href="style.css">
   <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
</head>
<body>
   <ul id="nav">
      <?php  
         $navbar=array(
             'Home' => 'index.php',
             'Academics' => 'Academics.php', 
             'Extracurriculars' => 'Extracurriculars.php',
             'Family'=> 'Family.php',
             'Contact Me' => 'ContactMe.php'
         );
         foreach($navbar as $title => $link){
             print("<li><a href='$link'>$title</a></li>");
         }
         
         ?>
   </ul>
      
    
    
   <?php 
      function title($page) {
          echo $page;
      }
      ?>