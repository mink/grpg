<?
include 'dbcon.php';
$result= mysql_query("SELECT * FROM `carlot` WHERE `id` = '".$_GET['id']."'");
$worked= mysql_fetch_array($result);
?>		
		<html>
		<head>
		
		<title><?= $worked['name'] ?></title>
		
		<style>
		* {
			font-family: tahoma;
			font-size: 12px;
			color: #FFFFFF;
		}
		
		body {
			background-color: #000000;
			margin: 15px;
		}
		
		.wrap {
			background-color: #202020;
			border: 1px solid #444;
		}
		
		.header {
			background-color: #111;
			border: 1px solid #444;
		}
		
		.head_text {
			padding: 5px;
			border: 1px solid #444;
			background-color: #111;
			color: #999999;
			font-weight: bold;
		}
		
		.head_text2l {
			padding: 5px;
			border-left: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #555555;
			color: #999999;
			font-weight: bold;
		}
		
		.head_text2r {
			padding: 5px;
			border-right: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #555555;
			color: #999999;
			font-weight: bold;
		}
		
		.head_text2 {
			padding: 5px;
			border-bottom: 1px solid #444;
			background-color: #555555;
			color: #999999;
			font-weight: bold;
		}
		
		.head_text3 {
			padding: 5px;
			border-left: 1px solid #444;
			border-right: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #333333;
			color: #333333;
		}
		
		.textl {
			padding: 5px;
			border-left: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #333333;
		}
		
		.textr {
			padding: 5px;
			border-right: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #333333;
		}
		
		.text {
			padding: 5px;
			border-bottom: 1px solid #444;
			background-color: #333333;
		}
		
		.textl2 {
			padding: 5px;
			border-left: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #444444;
		}
		
		.textr2 {
			padding: 5px;
			border-right: 1px solid #444;
			border-bottom: 1px solid #444;
			background-color: #444444;
		}
		
		.text2 {
			padding: 5px;
			border-bottom: 1px solid #444;
			background-color: #444444;
		}
		
		.textm {
			padding: 5px;
			background-color: #333333;
			border-left: 1px solid #444;
			border-right: 1px solid #444;
			border-bottom: 1px solid #444;
		}
		
		.textm2 {
			padding: 5px;
			background-color: #333333;
			border-left: 1px solid #444;
			border-right: 1px solid #444;
			border-bottom: 1px solid #444;
		}
		.style1 {padding: 5px; border: 1px solid #444444; background-color: #111; color: #FFFFFF; font-weight: bold; }
        .style2 {padding: 5px; border: 1px solid #444; background-color: #111; color: #FFFFFF; font-weight: bold; }
        </style>
		
		</head>
		<body>
		
		<table class='wrap' width='100%' height='100%' cellpadding='5' cellspacing='0' align='center'>
		<tr>

			<td valign='top'>
			
			<table class='header' width='100%' cellpadding='5' cellspacing='0' align='center'>
			<tr>
				<td><p style='color:white;font-size:16px;font-weight:bold;'><center><?= $worked['name'] ?></center></p></td>
			</tr>
			</table>
			
			<br>
			
			<table width='100%' cellpadding='4' cellspacing='0'>

			<tr>
				<td colspan='2' class='style1'>.: Description</td>
			</tr>
			<tr>
				<td class='textl' align='center'><img src='<?= $worked['image'] ?>' width='100' height='100' style='border: 1px solid #333333'></td>				
				<td class='textm2'><?= $worked['description'] ?></td>
			</tr>
			</table>

			
			<br>
			
			<table width='100%' cellpadding='4' cellspacing='0'>
			<tr>
				<td colspan='4' class='style2'>.: Details</td>
			</tr>
			<tr>
				<td class='textm'>Name: </td>
				<td class='textr'><?= $worked['name'] ?></td>

			</tr>
			<tr>
				<td class='textm'>Sell Value: </td>
				<td class='textr'>$<?= $worked['cost'] * .6 ?></td>
			</tr>
			<tr>
				<td class='textm'>Car Lot Cost: </td>

				<td class='textr'>$<?= $worked['cost'] ?></td>
			</tr>
			<tr>
				<td class='textm' valign='top'>Base Modifier: </td>
				<td class='textr'>
				<?= $worked['basemod'] ?><br>				</td>
			</tr>
			<tr>
				<td class='textm' valign='top'>Required Level: </td>
				<td class='textr'>
				<?= $worked['level'] ?><br>				</td>
			</tr>
			</table>
			
			</td>
		</tr>
		</table>
		
		</body>
		</table>
		
	