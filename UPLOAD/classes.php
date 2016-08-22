<?php
function Get_ID($username){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `username` = '".$username."'");
	$worked = mysql_fetch_array($result);
	return $worked['id'];
}

function mrefresh($url, $time="1"){
	echo '<meta http-equiv="refresh" content="'.$time.';url='.$url.'">';
}

function car_popup($text, $id) {
	return  "<a href='#' onclick=\"javascript:window.open( 'cardesc.php?id=".$id."', '60', 'left = 20, top = 20, width = 400, height = 400, toolbar = 0, resizable = 0, scrollbars=1' );\">".$text."</a>";
}

function item_popup($text, $id) {
	return  "<a href='#' onclick=\"javascript:window.open( 'description.php?id=".$id."', '60', 'left = 20, top = 20, width = 400, height = 400, toolbar = 0, resizable = 0, scrollbars=1' );\">".$text."</a>";
}

function prettynum($num,$dollar="0") {
// Basic send a number or string to this and it will add commas. If you want a dollar sign added to the
// front and it is a number add a 1 for the 2nd variable.
// Example prettynum(123452838,1)  will return $123,452,838 take out the ,1 and it looses the dollar sign.
        $out=strrev( (string)preg_replace( '/(\d{3})(?=\d)(?!\d*\.)/', '$1,' , strrev( $num ) ) );
		if ($dollar && is_numeric($num)){
			$out= "$".$out;
		}
	return $out;
}

function Check_Item($itemid, $userid){
	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
	$worked = mysql_fetch_array($result);
	
	if($worked['quantity'] > 0){
		return $worked['quantity'];
	} else {
		return 0;
	}
}

function Check_Land($city, $userid){
	$result = mysql_query("SELECT * FROM `land` WHERE `userid`='".$userid."' AND `city`='".$city."'");
	$worked = mysql_fetch_array($result);
		
	if($worked['quantity'] > 0){
		return $worked['quantity'];
	} else {
		return 0;
	}
}
//userid	companyid	howmany
function Give_Share($stock, $userid, $quantity="1"){
	$result = mysql_query("SELECT * FROM `shares` WHERE `userid`='".$userid."' AND `companyid`='".$stock."'");
	$worked = mysql_fetch_array($result);
	$itemexist = mysql_num_rows($result);
	
	if($itemexist == 0){
		$result= mysql_query("INSERT INTO `shares` (`companyid`, `userid`, `amount`)"."VALUES ('$stock', '$userid', '$quantity')");
	} else {
		$quantity = $quantity + $worked['amount'];
		$result = mysql_query("UPDATE `shares` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `companyid`='$stock'");
	}
}

function Take_Share($stock, $userid, $quantity="1"){
	$result = mysql_query("SELECT * FROM `shares` WHERE `userid`='".$userid."' AND `companyid`='".$stock."'");
	$worked = mysql_fetch_array($result);
	$itemexist = mysql_num_rows($result);
	
	if($itemexist != 0){
		$quantity = $worked['amount'] - $quantity;
		if($quantity > 0){
			$result = mysql_query("UPDATE `shares` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `companyid`='$stock'");
		} else {
			$result = mysql_query("DELETE FROM `shares` WHERE `userid`='$userid' AND `companyid`='$stock'");
		}
	}
}
	

function Check_Share($stock, $userid){
	$result = mysql_query("SELECT * FROM `shares` WHERE `userid`='".$userid."' AND `companyid`='".$stock."'");
	$worked = mysql_fetch_array($result);
		
	if($worked['amount'] > 0){
		return $worked['amount'];
	} else {
		return 0;
	}
}

function Give_Land($city, $userid, $quantity="1"){
	$result = mysql_query("SELECT * FROM `land` WHERE `userid`='".$userid."' AND `city`='".$city."'");
	$worked = mysql_fetch_array($result);
	$itemexist = mysql_num_rows($result);
	
	if($itemexist == 0){
		$result= mysql_query("INSERT INTO `land` (`city`, `userid`, `amount`)"."VALUES ('$city', '$userid', '$quantity')");
	} else {
		$quantity = $quantity + $worked['amount'];
		$result = mysql_query("UPDATE `land` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `city`='$city'");
	}
}

function Take_Land($city, $userid, $quantity="1"){
	$result = mysql_query("SELECT * FROM `land` WHERE `userid`='".$userid."' AND `city`='".$city."'");
	$worked = mysql_fetch_array($result);
	$itemexist = mysql_num_rows($result);
	
	if($itemexist != 0){
		$quantity = $worked['amount'] - $quantity;
		if($quantity > 0){
			$$result = mysql_query("UPDATE `land` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `city`='$city'");
		} else {
			$result = mysql_query("DELETE FROM `land` WHERE `userid`='$userid' AND `city`='$city'");
		}
	}
}
	
function Give_Item($itemid, $userid, $quantity="1"){
	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
	$worked = mysql_fetch_array($result);
	$itemexist = mysql_num_rows($result);
	
	if($itemexist == 0){
		$result= mysql_query("INSERT INTO `inventory` (`itemid`, `userid`, `quantity`)"."VALUES ('$itemid', '$userid', '$quantity')");
	} else {
		$quantity = $quantity + $worked['quantity'];
		$result = mysql_query("UPDATE `inventory` SET `quantity` = '".$quantity."' WHERE `userid`='$userid' AND `itemid`='$itemid'");
	}
}

function Take_Item($itemid, $userid, $quantity="1"){
	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
	$worked = mysql_fetch_array($result);
	$itemexist = mysql_num_rows($result);
	
	if($itemexist != 0){
		$quantity = $worked['quantity'] - $quantity;
		if($quantity > 0){
			$result = mysql_query("UPDATE `inventory` SET `quantity` = '".$quantity."' WHERE `userid`='$userid' AND `itemid`='$itemid'");
		} else {
			$result = mysql_query("DELETE FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
		}
	}
}


function Message($text){

	return '<tr><td class="contenthead">.: Important Message</td></tr>

<tr><td class="contentcontent">'.$text.'</td></tr>';

}



function Send_Event ($id, $text){

  $timesent = time();

  $result= mysql_query("INSERT INTO `events` (`to`, `timesent`, `text`)".

  "VALUES ('$id', '$timesent', '$text')");

}



function Is_User_Banned ($id) {

	$result = mysql_query("SELECT * FROM `bans` WHERE `id`='$id'");

    return mysql_num_rows($result);

}

function Why_Is_User_Banned ($id) {

	$result = mysql_query("SELECT * FROM `bans` WHERE `id`='$id'");

    $worked = mysql_fetch_array($result);

    return $worked['reason'];

}

function Radio_Status () {

	$result = mysql_query("SELECT * FROM `serverconfig`");

    $worked = mysql_fetch_array($result);

    return $worked['radio'];

}



function howlongago($ts) {
   $ts=time()-$ts;
   if ($ts<1)
       // <1 second
       return " NOW";
   elseif ($ts==1)
       // <1 second
       return $ts." second";
   elseif ($ts<60)
       // <1 minute
       return $ts." seconds";
	 elseif ($ts<120)
       // 1 minute
      return "1 minute";
    
	 elseif ($ts<60*60)
       // <1 hour
       return floor($ts/60)." minutes";
   elseif ($ts<60*60*2)
       // <2 hour
       return "1 hour";
     elseif ($ts<60*60*24)
       // <24 hours = 1 day
       return floor($ts/(60*60))." hours";
     elseif ($ts<60*60*24*2)
       // <2 days
       return "1 day";
     elseif ($ts<(60*60*24*7))
       // <7 days = 1 week
         return floor($ts/(60*60*24))." days";
   elseif ($ts<60*60*24*30.5)
       // <30.5 days ~  1 month
       return floor($ts/(60*60*24*7))." weeks";
     elseif ($ts<60*60*24*365)
       // <365 days = 1 year
       return floor($ts/(60*60*24*30.5))." months";
   else
       // more than 1 year
       return floor($ts/(60*60*24*365))." years";
};

function howlongtil($ts) {
   $ts=$ts - time();
   if ($ts<1)
       // <1 second
       return " NOW";
   elseif ($ts==1)
       // <1 second
       return $ts." second";
   elseif ($ts<60)
       // <1 minute
       return $ts." seconds";
	 elseif ($ts<120)
       // 1 minute
      return "1 minute";
    
	 elseif ($ts<60*60)
       // <1 hour
       return floor($ts/60)." minutes";
   elseif ($ts<60*60*2)
       // <2 hour
       return "1 hour";
     elseif ($ts<60*60*24)
       // <24 hours = 1 day
       return floor($ts/(60*60))." hours";
     elseif ($ts<60*60*24*2)
       // <2 days
       return "1 day";
     elseif ($ts<(60*60*24*7))
       // <7 days = 1 week
         return floor($ts/(60*60*24))." days";
   elseif ($ts<60*60*24*30.5)
       // <30.5 days ~  1 month
       return floor($ts/(60*60*24*7))." weeks";
     elseif ($ts<60*60*24*365)
       // <365 days = 1 year
       return floor($ts/(60*60*24*30.5))." months";
   else
       // more than 1 year
       return floor($ts/(60*60*24*365))." years";
};



//level 2 - 500

//level 3 - 1500

//level 4 - 3500

//level 5 - 6000





function experience($L) {

  $a=0;

  $end=0;

  for($x=1; $x<$L; $x++) {

    $a += floor($x+1500*pow(4, ($x/7)));

  }

  return floor($a/4);

}



function Get_The_Level($exp) {

  $a=0;

  $end =0;

  for($x=1; ($end==0 && $x<100); $x++) {

    $a += floor($x+1500*pow(4, ($x/7)));

    if ($exp >= floor($a/4)){

	} else {
	
	  return $x;

	  $end=1;

	}

  }

}



function Get_Max_Exp($L){

$end=0;

 if ($exp == 0){

	return 457;

	$end =1;

  }

	for($L=1;($L<100 && $end==0);$L++) {

	  $exp = experience($L);

	  //echo $exp;

	  if ($exp >= $user_class->exp){

		return $exp;

		$end=1;

	  }

	}

}



class User_Stats {

 function User_Stats($wutever){

	$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `username` ASC");

	$result3 = mysql_query("SELECT * FROM `grpgusers` ORDER BY `username` ASC");



		while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

			$secondsago = time()-$line['lastactive'];

			if ($secondsago<=300) {

				$this->playersloggedin++;

			}

		}



		while($line3 = mysql_fetch_array($result3, MYSQL_ASSOC)) {

			$secondsago = time()-$line3['lastactive'];

			if ($secondsago<=86400) {

				$this->playersonlineinlastday++;

			}

		}

	$result2 = mysql_query("SELECT * FROM `grpgusers`");

	$this->playerstotal = mysql_num_rows($result2);

  }

}





class Gang{

 	function Gang($id) {

    $result = mysql_query("SELECT * FROM `gangs` WHERE `id`='$id'");

    $worked = mysql_fetch_array($result);

    $gangcheck = mysql_query("SELECT * FROM `grpgusers` WHERE `gang`='".$id."'");



	$this->id = $worked['id'];

	$this->members = mysql_num_rows($gangcheck);

	$this->name = $worked['name'];

	$this->formattedname = "<a href='viewgang.php?id=".$worked['id']."'>".$worked['name']."</a>";

	$this->description = $worked['description'];

	$this->leader = $worked['leader'];

	$this->tag = $worked['tag'];

	$this->exp = $worked['exp'];

	$this->level = Get_The_Level($this->exp);

	$this->vault = $worked['vault'];

	$gangcheck = mysql_query("SELECT * FROM `grpgusers` WHERE `gang`='".$line['id']."'");

	$members = mysql_num_rows($gangcheck);



	}



}







class User {

  function User($id) {

    $result = mysql_query("SELECT * FROM `grpgusers` WHERE `id`='$id'");

    $worked = mysql_fetch_array($result);

	$result2 = mysql_query("SELECT * FROM `gangs` WHERE `id`='".$worked['gang']."'");

    $worked2 = mysql_fetch_array($result2);

	$result3 = mysql_query("SELECT * FROM `cities` WHERE `id`='".$worked['city']."'");

    $worked3 = mysql_fetch_array($result3);

   	$result4 = mysql_query("SELECT * FROM `houses` WHERE `id`='".$worked['house']."'");

    $worked4 = mysql_fetch_array($result4);

	$result5 = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '".$id."' ORDER BY `userid` DESC");

	$checkcocaine = mysql_query("SELECT * FROM `effects` WHERE `userid`='".$id."' AND `effect`='Cocaine'");

	$cocaine = mysql_num_rows($checkcocaine);

	$speedbonus = ($cocaine > 0) ? (floor($worked['speed'] * .30)) : 0;

	$this->weaponoffense = 0;
	$this->weaponname = "fists";
	$this->armordefense = 0;
	if($worked["eqweapon"] != 0){
		$result6 = mysql_query("SELECT * FROM `items` WHERE `id`='".$worked['eqweapon']."' LIMIT 1");
		$worked6 = mysql_fetch_array($result6);
		$this->eqweapon = $worked6['id'];
		$this->weaponoffense = $worked6['offense'];
		$this->weaponname = $worked6['itemname'];
		$this->weaponimg = $worked6['image'];
	}
	if($worked["eqarmor"] != 0){
		$result6 = mysql_query("SELECT * FROM `items` WHERE `id`='".$worked['eqarmor']."' LIMIT 1");
		$worked6 = mysql_fetch_array($result6);
		$this->eqarmor = $worked6['id'];
		$this->armordefense = $worked6['defense'];
		$this->armorname = $worked6['itemname'];
		$this->armorimg = $worked6['image'];
	}

	$this->moddedstrength = $worked['strength'] * ($this->weaponoffense * .01 + 1);

	$this->moddeddefense = $worked['defense'] * ($this->armordefense * .01 + 1);



	$this->id = $worked['id'];

	$this->ip = $worked['ip'];

	$this->style = ($worked['style'] > 0) ? $worked['style'] : "1";

	$this->speedbonus = $speedbonus;

	$this->username = $worked['username'];
	
	$this->marijuana = $worked['marijuana'];
	
	$this->potseeds = $worked['potseeds'];

	$this->cocaine = $worked['cocaine'];

	$this->nodoze = $worked['nodoze'];

	$this->genericsteroids = $worked['genericsteroids'];

	$this->hookers = $worked['hookers'];

	$this->exp = $worked['exp'];

	$this->level = Get_The_Level($this->exp);

	$this->maxexp = experience($this->level +1);

	$this->exppercent = ($this->exp == 0) ? 0 : floor(($this->exp / $this->maxexp) * 100);

	$this->formattedexp = $this->exp." / ".$this->maxexp." [".$this->exppercent."%]";

	$this->money = $worked['money'];

	$this->bank = $worked['bank'];

	$this->whichbank = $worked['whichbank'];

	$this->hp = $worked['hp'];

	$this->maxhp = $this->level * 50;

	$this->hppercent = floor(($this->hp / $this->maxhp) * 100);

	$this->formattedhp = $this->hp." / ".$this->maxhp." [".$this->hppercent."%]";

	$this->energy = $worked['energy'];

	$this->maxenergy = 9 + $this->level;

	$this->energypercent = floor(($this->energy / $this->maxenergy) * 100);

	$this->formattedenergy = $this->energy." / ".$this->maxenergy." [".$this->energypercent."%]";

	$this->nerve = $worked['nerve'];

	$this->maxnerve = 4 + $this->level;

	$this->nervepercent = floor(($this->nerve / $this->maxnerve) * 100);

	$this->formattednerve = $this->nerve." / ".$this->maxnerve." [".$this->nervepercent."%]";

	$this->workexp = $worked['workexp'];

	$this->strength = $worked['strength'];

	$this->defense = $worked['defense'];

	$this->speed = $worked['speed'] + $speedbonus;

	$this->totalattrib = $this->speed + $this->strength + $this->defense;

	$this->battlewon = $worked['battlewon'];

	$this->battlelost = $worked['battlelost'];

	$this->battletotal = $this->battlewon + $this->battlelost;

	$this->battlemoney = $worked['battlemoney'];

	$this->crimesucceeded = $worked['crimesucceeded'];

	$this->crimefailed = $worked['crimefailed'];

	$this->crimetotal = $this->crimesucceeded + $this->crimefailed;

	$this->crimemoney = $worked['crimemoney'];

	$this->lastactive = $worked['lastactive'];

	$this->age = howlongago($worked['signuptime']);

	$this->formattedlastactive = howlongago($this->lastactive) . " ago";

	$this->points = $worked['points'];

	$this->rmdays = $worked['rmdays'];

	$this->signuptime = $worked['signuptime'];

	$this->lastactive = $worked['lastactive'];

	$this->house = $worked['house'];

	$this->housename = ($worked4['name'] == "") ? "Homeless" : $worked4['name'];

	$this->houseawake = ($worked4['name']== "") ? 100 : $worked4['awake'];

	$this->awake = $worked['awake'];

	$this->maxawake = $this->houseawake;

	$this->awakepercent = floor(($this->awake / $this->maxawake) * 100);

	$this->formattedawake = $this->awake." / ".$this->maxawake." [".$this->awakepercent."%]";

	$this->email = $worked['email'];

	$this->house = $worked['house'];

	$this->admin = $worked['admin'];

	$this->quote = $worked['quote'];
	
	$this->avatar = $worked['avatar'];

	$this->gang = $worked['gang'];

	$this->gangname = $worked2['name'];

	$this->gangleader = $worked2['leader'];

	$this->gangtag = $worked2['tag'];

	$this->gangdescription = $worked2['description'];

	$this->formattedgang = "<a href='viewgang.php?id=".$this->gang."'>".$this->gangname."</a>";

	$this->city = $worked['city'];

	$this->cityname = $worked3['name'];

	$this->jail = $worked['jail'];

	$this->job = $worked['job'];

	$this->hospital = $worked['hospital'];

	$this->searchdowntown = $worked['searchdowntown'];



	if ($this->gang != 0){

		$this->formattedname .= "<a href='viewgang.php?id=".$this->gang."'";

		$this->formattedname .= ($this->gangleader == $this->username) ? " title='Gang Leader'>[<b>".$this->gangtag."</b>]</a>" : ">[".$this->gangtag."]</a>";

	}

	if ($this->rmdays != 0){

	 	$this->type = "Respected Mobster";

		$whichfont = "green";

	} else {

	 	$this->type = "Regular Mobster";

	}

	if ($this->admin == 1) {

		$this->type = "Admin";

		$whichfont = "blue";

	}

	if ($this->admin == 2) {

		$this->type = "Staff";

	}

	if ($this->admin == 3) {

		$this->type = "Pre
		ent";

		$whichfont = "red";

	}

	if ($this->admin == 4) {

		$this->type = "Congress";

		$whichfont = "red";

	}

	if ($this->rmdays > 0){

		$this->formattedname .= "<b><a title='Respected Mobster [".$this->rmdays." RM Days Left]' href='profiles.php?id=".$this->id."'><font color = '".$whichfont."'>".$this->username."</a></font></b>";

	} elseif ($this->admin != 0) {

		$this->formattedname .= "<b><a href='profiles.php?id=".$this->id."'><font color = '".$whichfont."'>".$this->username."</a></font></b>";

	} else {

		$this->formattedname .= "<a href='profiles.php?id=".$this->id."'><font color = '".$whichfont."'>".$this->username."</a></font>";

	}

	if (time() - $this->lastactive < 300) {

		$this->formattedonline= "<font style='color:green;padding:2px;font-weight:bold;'>[online]</font>";

	} else {

		$this->formattedonline= "<font style='color:red;padding:2px;font-weight:bold;'>[offline]</font>";

	}

  }

}

/*

$result2 = mysql_query("SELECT * FROM `gangs` WHERE `id`='$gang'");

$worked2 = mysql_fetch_array($result2);

$gangname = $worked2['name'];

$gangleader = $worked2['leader'];

*/

?>

