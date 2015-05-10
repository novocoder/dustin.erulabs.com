<!DOCTYPE html>
<html>
    <head>
        <?PHP 
        require 'header.php';
        require 'championlist.php';
        require 'sumitems.php';
        ?>
        <title>Ultimate-Bravery</title>
        
        Ultimate-Bravery Generator Testingzes
        
        <br><br>
        
        <form action="ultbrave.php" method="get">
          <input type="submit" value="Generate Random Game!">
        </form>





            <?PHP
            
            function fixlolname($lolname) {
	$lolname = str_replace(" ", "", $lolname);
	$lolname = str_replace("'", "", $lolname);
	$lolname = str_replace(".", "", $lolname);
	return $lolname;
}

        //   echo $sumitems[3254][1];  
        
$rand_champions = array_rand($champions_key, 10);

//   $list_size = 5;   
  
            
                     
//                       $show_items = $itemlist[0];
//                       $show_boots = $itemlist[1];
                     
                     
                      
   
            echo "<br><br> Champions: <br><br>";
           
            for ($i = 0; $i < 10; $i++) {
                
                 $champlist = $champions[$champions_key[$rand_champions[$i]]];
                 $selectChamp = explode(',',$champlist); 
                 $show_champ = fixlolname($selectChamp[0]);
                 echo $selectChamp[0] . "<br>" . "<img src='images/" . $show_champ . "Square.png' > ";
                    
               
                
                for ($a = 0; $a < 6; $a++) {
                    
                    $select_rand_items = array_rand($sumitemskey, 6);
                    $itemlist = $sumitems[$sumitemskey[$select_rand_items[$a]]];
                    
                    
                    
                        
                         $check_for_boot = in_array("boot", $itemlist);
                         
                        //  while ($check_for_boot == false) {
                             
                             echo "<img src='images/" . $itemlist[0] . "Square.gif' > ";
                             
                            //  $check_for_boot = true;
                        //  }
                        
                      
                        
                }
                        

function check() {
    in_array("boot", $itemlist);
    
    
}
                       
                    // while ($check_for_boot == false) {
                        
                        //   echo "<img src='images/" . $itemlist[0] . "Square.gif' > ";
                        
                    // }
                    
                    // $check_for_boot == true;
                  
                    
                
            
                 
               echo "<br><br>";
                     
            
              
             }
            
                 
                 
              
                           
                    // echo "<img src='images/" . $show_items . "Square.gif' > ";
                    //  echo $show_items;
                   
                //  do {
                //      $select_rand_items = array_rand($sumitemskey, 6); 
                //      $itemlist = $sumitems[$sumitemskey[$select_rand_items]];
                //      $show_items = $itemlist[0];
                //      $check_for_boot = in_array("boot", $itemlist);
                //          if ($check_if_boot == false){
                                
                //          }
                //      }  
                   
                   
                         
                         
                        //   $check_for_boot = true;
                             
                         
                     
                     
                     
                        //  if (in_array("boot", $itemlist))
                        //  {
                        //      echo "This thang hur is a boot -->";
                        //  }
                    // //  echo $selectItem[1];
                    //  echo "<img src='images/" . $show_items . "Square.gif' > ";
                 
                // echo "<br><br><br><br>"; 
            // };
            
            
// $rand_boots = array_rand($bootKey, 1);

// $listboots = $sumitems[$bootKey[$rand_boots]];


// $selectBoot = explode(',',$listboots);

// echo $selectBoot[1];

//         function check_if_boot() {
            
//         }



// if(in_array())
            
            
            
            ?>
        
</html>

