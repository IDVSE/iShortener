iShortener
===========

A simple iShortener & Image Hosting

In order to use this form you have to enter three things for set contact us:
- your reCAPTCHA private key in contactProcess.php (search for YOUR reCAPTCHA Private KEY = 6Leqf-USAAAAALAerlQxxze_LoKvp0KD1lh7iBK2)
- your reCAPTCHA public key in contact.php (search twice for YOUR reCAPTCHA PUBLIC KEY = 6Leqf-USAAAAALwY8sVy5KXdX0AsQ4IwxIi7G8Bh)
- your email address in contactProcess.php (search for YOUR EMAIL)

Get reCAPTCHA keys at http://www.google.com/recaptcha/whyrecaptcha

Specifications:
- jQuery (client-side) validation
- Send button is disabled if Javascript is disabled
- Server side validation
- Designed based on Twitter bootstrap
- Spam prevention using reCAPTCHA

==========================================================
Open about.php
Edit "yoururl/1"
Ex : "stelso.tk/1"

=======================================================
Open db.php and setting
mysql_connect('localhost', 'db_username', 'password') or die(mysql_error());
mysql_select_db('db_name') or die(mysql_error());

define('ADMIN', 'admin');
define('PASSWORD', 'password');

Installation is easy, go to hosting Cpanel and Create a MySQL Database & Username for it.

Once you've done that, go to PHPMyADmin and import the file called database.sql

Last step is to open db.php and update MySQL Credentials and admin area password (your admin area url is http://site.com/admin.php)

=Image Host=

///////////////////////////////////  iOPTIONS  ///////////////////////////////////////////


$siteurl = "stelso.tk"; // Your domains or subdomains (e.g. idvse.com or idvse.com/folder)


$folder = "i"; // To upload the Folder (folder chmod to 777)


$maxsizekb = 5000; // Maximum file size allowed


$filetype = array("jpeg", "jpg", "gif", "bmp", "png", "ico", "psd"); // Allowed image formats


////////////////////////////////////////////////////////////////////////////////////////
