<!DOCTYPE html>
<html lang="en">
<head>
   <!--Default-->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="asset/logo.png">
   <link rel="stylesheet" href="style/global.css">
   <link rel="stylesheet" href="style/variables.css">
   <?php
      require_once('script/connect.php');
      include_once('component/icon.php');
      include_once('component/alert.php');
   ?>
   <!--Custom-->
   <title>GGG - Store Page</title>
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/maincontent.css">
   <link rel="stylesheet" href="style/storepage.css">
   <?php
      session_start();
      include_once('component/navbar.php');
      include_once('component/pageheader.php'); 
      $gameID = $_GET['gameID']
   ?>
   <script src='script/slides.js'></script>
</head>
<body onload="currentSlide(1)">
   <?php Navbar('', $_SESSION['email']) ?>
   <main class="storepage">
      <a class="button-icon back" onclick="history.back()" draggable="false">
         <?php Icon('back') ?>
      </a>
      <div class="header-container">
         <div class="slideshow-container">
            <div class="slideshow-image">
               <?php
                  $q = "SELECT file FROM media WHERE gameID='$gameID'";
                  $result = $conn->query($q);
                  if (!$result) {
                     Alert("Query error: " . $conn->error);
                  }
                  else {
                     while ($row = $result->fetch_array()) {
                        echo'
                        <div class="mySlides fade">
                           <img src="data:image/png;base64,'.base64_encode($row[0]).'">
                        </div>';
                     }
                  }
               ?>
            </div>
            <div class="slideshow-controller">
               <span class="prev button-icon" onclick="plusSlides(-1)">
                  <?php Icon('arrowLeft'); ?>
               </span>
               <?php
                  $i = 1;
                  while ($row = $result->fetch_array()) {
                     echo "
                     <span class='dot-wrapper' onclick='currentSlide($i)'>
                        <div class='dot'></div>
                     </span>";
                     $i++;
                  }
               ?>
               <span class="dot-wrapper" onclick="currentSlide(1)">
                  <div class="dot"></div>
               </span><span class="dot-wrapper" onclick="currentSlide(1)">
                  <div class="dot"></div>
               </span><span class="dot-wrapper" onclick="currentSlide(1)">
                  <div class="dot"></div>
               </span>
             </div>
         </div>
         <div class="subheader-container">
            <h1 class="title webkitclamp">Baldur's Gate 3</h1>
            <span class="buy-container flex-row">
               <button>BUY NOW</button>
               <h3>฿ 1699</h3>
            </span>
            <div class="grid-info">
               <span>Tags:</span>
               <h5>RPG, Strategy, Story-rich</h5>
               <span>Developer:</span>
               <h5>Larian Studios</h5>
               <span>Publisher:</span>
               <h5>Larian Studios</h5>
               <span>Release Date:</span>
               <h5>03/08/2023</h5>
            </div>
         </div>
      </div>
      <hr/>
      <div class="description">
         <h5>
            Baldur’s Gate 3 is a story-rich, party-based RPG set in the universe of Dungeons & Dragons, where your choices shape a tale of fellowship and betrayal, survival and sacrifice, and the lure of absolute power.
         </h5>
         <br>
         <p>Gather your party and return to the Forgotten Realms in a tale of fellowship and betrayal, sacrifice and survival, and the lure of absolute power.</p>
         <br>
         <p>Mysterious abilities are awakening inside you, drawn from a mind flayer parasite planted in your brain. Resist, and turn darkness against itself. Or embrace corruption, and become ultimate evil.</p>
         <br>
         <p>From the creators of Divinity: Original Sin 2 comes a next-generation RPG, set in the world of Dungeons & Dragons.</p>
         <br>
         <h3>GATHER YOUR PARTY</h3>
         <p>Choose from 12 classes and 11 races from the D&D Player's Handbook and create your own identity, or play as an Origin hero with a hand-crafted background. Or tangle with your inner corruption as the Dark Urge, a fully customisable Origin hero with its own unique mechanics and story. Whoever you choose to be, adventure, loot, battle and romance your way across the Forgotten Realms and beyond. Gather your party. Take the adventure online as a party of up to four.</p>
         <br>
         <h3>AN EXPANSIVE ORIGINAL STORY</h3>
         <p>Abducted, infected, lost. You are turning into a monster, but as the corruption inside you grows, so does your power. That power may help you to survive, but there will be a price to pay, and more than any ability, the bonds of trust that you build within your party could be your greatest strength. Caught in a conflict between devils, deities, and sinister otherworldly forces, you will determine the fate of the Forgotten Realms together.</p>
      </div>
   </main>
</body>
</html>