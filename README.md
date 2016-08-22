# GRPG Framework v.1.1

GRPG Framework (also known as Generic RPG) is a a text-based MMORPG base written in PHP that was created by Brandon Werner (Publius) in 2007. Please note that this code contains short tags, SQL injection vulnerabilities and deprecated calls throughout.

Here are the installation instructions provided with the original readme:

## Install Instructions
1. Dump the grpgtables.sql dump file into the MySQL database.
2. Go into the UPLOAD folder and open dbcon.php, then replace the values inside that script with the correct username, password, and database, then save it.
3. Upload all the files in the UPLOAD folder onto your webserver.
4. Go to your site and create an account.
5. In the MySQL Database, go to the grpgusers table and edit the admin field on your account and change it to 1, now you are an admin and you can now access the control panel.
6. Set rollover.php to run at midnight every night via crontab on your server.
7. Enjoy!
