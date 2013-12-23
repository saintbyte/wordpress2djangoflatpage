#!/usr/bin/php
<?php
$src_login = 'xxx';
$src_password = 'xxxxxxxxxxxx';
$src_host = 'localhost';
$src_db = 'xxxxxxxxx111';

$dest_login = 'xxx';
$dest_password = 'xxxxxxxxxx';
$dest_host = 'localhost';
$dest_db = 'xxxxx';

$src_link = mysql_connect($src_host,$src_login,$src_password);
mysql_select_db($src_db,$src_link);
mysql_query("set names 'utf8'",$src_link);
print mysql_error();
var_dump($src_link);
$src_query = 'SELECT * FROM  wp_posts WHERE  post_status="publish"';
$qh = mysql_query($src_query,$src_link);
print mysql_error();

$dest_link = mysql_connect($dest_host,$dest_login,$dest_password);
mysql_select_db($dest_db,$dest_link);
mysql_query("set names 'utf8'",$dest_link);
print mysql_error();
var_dump($dest_link);


while($src_row = mysql_fetch_array($qh,MYSQL_ASSOC))
{
    var_dump($src_row);
$url = $src_row['post_name'];
$title = mysql_escape_string($src_row['post_title']);
$content = mysql_escape_string($src_row['post_content']);

$sql = 
'
INSERT INTO simplepages_simplepage(url, title,content) 
VALUES ("/'.$url.'/", "'.$title.'","'.$content.'");
';
mysql_query($sql,$dest_link);
}

