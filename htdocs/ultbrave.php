<!DOCTYPE html>
<html>
    <head>
        <?PHP 
        require 'header.php';
        require 'championlist.php';
        require 'sumitems.php';
        ?>
        <title>Ultimate-Bravery</title>
    </head>
    <body>
        
        <p>     
        
         Ultimate-Bravery Game Generator
         
            <form action="ultbrave.php" method="get">
              <input type="submit" value="Generate Random Game!">
            </form>
        </p>
        
        
  
        <p>    
<?PHP
            
            function fixlolname($lolname) {
	$lolname = str_replace(" ", "", $lolname);
	$lolname = str_replace("'", "", $lolname);
	$lolname = str_replace(".", "", $lolname);
	return $lolname;
}

           
        
$rand_champions = array_rand($champions_key, 10);
   
           
            // List 10 Random Champions with Lane assignment //
            for ($i = 0; $i < 10; $i++) {
    echo "<div class='card'>";  
    echo "<table>";             
                 $lanes = array("Top", "Middle", "Bottom", "Jungle");
                 shuffle($lanes);
                 $lane = $lanes[0];
                 
                 
                 
                 $champlist = $champions[$champions_key[$rand_champions[$i]]];
                 $selectChamp = $champlist; 
                 
                 $champs = $selectChamp[0];
                 
                 $player = $i + 1;
                 
                 if($player % 2 === 0) {       
                 echo "<div class='blueteam'>" . "<tr><th>" . "Player " . $player . ":  " . $champs . "---" . $lane . "---" . "Team: B" . "</th></tr>" . "</div>";
                 } else {
                 echo "<div class='redteam'>" . "<tr><th>" . "Player " . $player . ":  " . $champs . "---" . $lane . "---" . "Team: A" . "</th></tr>" . "</div>";     
                 };
                //  echo "<th>" . "Lane: " . $lane . "</th> <th>" . "Team: A" . "</th></tr>";
                 
                 $thumb = "<img src='images/" . fixlolname($selectChamp[0]) . "Square.png' > ";
             
             
                 
                 echo "<td>" . $thumb . "</td>";
                 
                
              
                 // Random boot selection for each champion //
                 for ($b = 0; $b < 1; $b++) {
                     $rand_boot = array_rand($bootkey, 2);
                     $bootlist = $sumitems[$bootkey[$rand_boot[$b]]];
                     $select_boot = $bootlist;
                     $boots = "<img src='images/" . $select_boot[0] . "Square.gif' >";
                     
                     echo "<td>" . $boots . "</td>";
                 };
                 // Random 5 items for each champion //
                 for ($b = 0; $b < 5; $b++) {
                     $rand_items = array_rand($sumitemskey, 5);
                     $itemlist = $sumitems[$sumitemskey[$rand_items[$b]]];
                     $selectItem = $itemlist;
                     $items = "<img src='images/" . $selectItem[0] . "Square.gif' >";
                     
                     echo "<td>" . $items . "</td>";  
                 
                 };
                
                    //   echo "</tr>";            
    echo "</table>";             
    echo "</div>";          
            };
            
?>
        </p>
    </body>
</html>

