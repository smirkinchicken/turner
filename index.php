<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Turner NCAA assessment</title>
  
  
  
      <link rel="stylesheet" href="style.css">

  
</head>
<body>
  <div class="parent">
<?php 
$str = file_get_contents('http://ncaa-cssu.s3.amazonaws.com/webdev/coding-challenge/scoreboard.json');

$json = json_decode($str, true); 

//
//echo '<pre>' . print_r($json['games'][0]['game']['title']) . '</pre>';
//buid out game status specific arrays
$pre_gm = array();
$live_gm = array();
$final_gm = array();
$i=0; 
foreach ($json['games'] as $game) {
   
    
    $game_status = $game['game']['gameState'];
    switch ($game_status) {
        case "pre":
            $pre_gm[] = $game;
            break;
        case "live":
            $live_gm[] = $game;
            break;
        case "final":
            $final_gm[] = $game;
            break;
    }
$i++;}


$i=0;
foreach ($live_gm as $game) {

    $game_title = $game['game']['title'];
    
    $home = $game['game']['home']['names']['short'];
    $away = $game['game']['away']['names']['short'];
    $home_final = $game['game']['home']['score'];
    $away_final = $game['game']['away']['score'];
    $game_status = $game['game']['gameState'];
    $start_time = $game['game']['startTime'];
    
    switch ($game_status) {
        case "pre":
            $status = "Pre-Game";
            break;
        case "live":
            $status = "Live";
            break;
        case "final":
            $status= "Final";
            if($game['game']['home']['winner']=="true") {
                $home = "(W)".$home;
            }elseif($game['game']['away']['winner']=="true") {
                $away = "(W)".$away;
            }
            break;
    }
    $url = $game['game']['url'];
    if($game_status !="final")  {
        $watch = "<div><a href=\"".$url."\">Watch >></a></div>";
    }   else    {$watch = "";}
    ?>
        <div class="child livegame">
		<h3><?php echo $start_time." - ".$away." at ".$home;?><span class ="status"><?php echo $status;?></span> </h3>
		
		<div>
			<div>
					<table width="100%">
						<tbody>
							<tr>
								<th colspan="1"></th>
								<th></th>
								<th></th>
								<th colspan="2" align="right"><span>Score</span></th>
							
							</tr>
							<tr>
								<td>
									<div>
										<?php echo $away; ?>
										</td>
								<td></td>
								<td></td>
								<td align="right"><span class="final"><?php echo $away_final; ?></span></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<div>
										<?php echo $home; ?>
										</td>
								<td></td>
								<td></td>
								<td align="right"><span class="final"><?php echo $home_final; ?></span></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php echo $watch;?>
		</div>

        </div>
        
	
	<?php 
       
        $i++;
}



foreach ($pre_gm as $game) {

    $game_title = $game['game']['title'];
    
    $home = $game['game']['home']['names']['short'];
    $away = $game['game']['away']['names']['short'];
    $home_final = $game['game']['home']['score'];
    $away_final = $game['game']['away']['score'];
    $game_status = $game['game']['gameState'];
    $start_time = $game['game']['startTime'];
    
    
            $status = "Pre-Game";
            
            if(isset($game['game']['url']) && ($game['game']['url'] != ""))  {
    $url = $game['game']['url'];
    
$watch = "<div><a href=$url>Watch >></a></div>";}
 ?>
        <div class="child pregame">
		<h3><?php echo $start_time." - ".$away." at ".$home;?><span class ="status"><?php echo $status;?></span> </h3>
		
		<div>
			<div>
					<table width="100%">
						<tbody>
							<tr>
								<th colspan="1"></th>
								<th></th>
								<th></th>
								<th colspan="2" align="right"><span>Score</span></th>
							
							</tr>
							<tr>
								<td>
								
										<?php echo $away; ?>
										</td>
								<td></td>
								<td></td>
								<td align="right"><span class="final"><?php echo $away_final; ?></span></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<div>
										<?php echo $home; ?>
										</td>
								<td></td>
								<td></td>
								<td align="right"><span class="final"><?php echo $home_final; ?></span></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php echo $watch;?>
		</div>

        </div>
        
	
	<?php 
       
        $i++;
}


foreach ($final_gm as $game) {

    $game_title = $game['game']['title'];
    
    $home = $game['game']['home']['names']['short'];
    $away = $game['game']['away']['names']['short'];
    $home_final = $game['game']['home']['score'];
    $away_final = $game['game']['away']['score'];
    $game_status = $game['game']['gameState'];
    $start_time = $game['game']['startTime'];
    
    
            $status = "Final";
            
    
    $url = $game['game']['url'];
  $watch = "";
    ?>
        <div class="child pregame">
		<h3><?php echo $start_time." - ".$away." at ".$home;?><span class ="status"><?php echo $status;?></span> </h3>
		
		<div>
			<div>
					<table width="100%">
						<tbody>
							<tr>
								<th colspan="1"></th>
								<th></th>
								<th></th>
								<th colspan="2" align="right"><span>Score</span></th>
							
							</tr>
							<tr>
								<td>
									<div>
										<?php echo $away; ?>
										</td>
								<td></td>
								<td></td>
								<td align="right"><span class="final"><?php echo $away_final; ?></span></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<div>
										<?php echo $home; ?>
										</td>
								<td></td>
								<td></td>
								<td align="right"><span class="final"><?php echo $home_final; ?></span></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php echo $watch;?>
		</div>

        </div>
        
	
	<?php 
       
        $i++;
}

?>
</div>




  
  
</body>
</html>

