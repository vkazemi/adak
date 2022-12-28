# nafispanel
This is an Open Source sea transport web application. you can customize it for any kind of freight transportation system. It has an admin user that defines in database and it has access all parts if application. You can see demo at below website

http://adak.freehost.io

username and password for login:   username: admin password:123456

This user can create other user and give custom access ti them. I this application you can add, edit and delete drivers, cargoes, destinations, senders
owners then you can register invoices. you can filter registered invoicces and export them to excel file. I used phpspreadsheet. In below link you can see 
how to use it.
https://www.studentstutorial.com/php-spreadsheet/phpspreadsheet-tutorial

you can create invoice for each registered invoice and download odf file. I used mPDF. you can read about it in below link.
https://mpdf.github.io/

I used a custom MVC PHP framework and used mysql for database. in app/config/config.php you should define database params, base url, assets url, and 
website name.

//DB params
define('DB_HOST', '');
define('DB_USER','');
define('DB_PASSWORD', '');
define('DB_NAME', '');

//App root
define('APPROOT', dirname(dirname(__FILE__)));
// Asset root
define('ASSETROOT', dirname(dirname(dirname(__FILE__))));
//Url root
define('URLROOT','');

//Site name
define('SITENAME','');
//App version
define('APPVERSION','');

In path public/htaccess you sould change RewriteBase for your website     

RewriteBase /nafispanel/public

