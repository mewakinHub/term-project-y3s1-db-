<?php
   include_once('component/icon.php');
   function PageHeader($Page) {
      echo "
      <div class='header'>
         <h1"; if ($Page != 'Friends') {echo " class='hidable'";} echo ">$Page</h1>
         <div class='searchbox-wrapper"; if ($Page == 'Friends') {echo " hidden";} echo "'>
            <div class='inputicon-container searchicon'>";
            if ($Page != 'Library') {
               echo "<input type='text' name='searchstore' placeholder='Search Store' maxLength='32' class='iconned'/>";
            }
            else {
               echo "<input type='text' name='searchlibrary' placeholder='Search Library' maxLength='32' class='iconned'/>";
            }
            Icon('search');
            echo "
            </div>
         </div>
      </div>";
      if ($Page != 'Friends') {
      echo "
      <hr class='hr-header'/>";
      }
   }
?>