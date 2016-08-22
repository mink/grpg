<?
include 'header.php';
function countlines() {
	$d = dir(".");
	while($entry = $d->read()) {
		if ($entry != "." && $entry != "..") {
			if (!is_dir($dirName."/".$entry)) {
				$ext = substr($entry,strpos($entry,"."),strlen($entry));
				if ($ext==".php" || $ext==".css") {
					$count += count(file($entry));
				}
			}
		}
	}
	return $count;
	$d->close();
}
?>
<tr><td class="contenthead">Stats</td></tr>
<tr><td class="contentcontent">
GRPG is currently made up of <? echo countlines(); ?> lines of code.
</td></tr>
<?
include 'footer.php';
?>