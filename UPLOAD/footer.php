

</table>



                </td>

              </tr>

            </table>

			<br />

          </td>

        </tr>

      </table>

    </td>

  </tr>

</table>



<table width="827">

<tr>

    <td height="20" colspan="2" align="center" class="contentcontent">

<?php

$stats = new User_Stats("bang");

?>





     | <a href='citizens.php'><?php echo $stats->playerstotal; ?> Total Mobsters</a>

			 &nbsp; | &nbsp;

			<a href='online.php'><?php echo $stats->playersloggedin; ?> Mobsters Online</a>

			 &nbsp; | &nbsp;

			<a href='24hour.php'><?php echo $stats->playersonlineinlastday; ?> Mobsters Online (24 Hours)</a> |<br>

	<?

	$endtime = microtime_float();

	$totaltime= round($endtime - $starttime,2);

	echo "This page was generated in " . $totaltime . " seconds";

?>

<br />&copy; MyNeoCorp Productions 2007 Brandon Werner (Publius)



    </td>

  </tr>

</table>

</body>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">

</script>

<script type="text/javascript">

_uacct = "UA-1189333-1";

urchinTracker();

</script>

</body>

</html>
<?
ob_end_flush();
?>