# nafispanel
This is a ... web application. I has an admin user that defines in database and it has access all parts if application. 
This user can create other user and give custom access ti them. I this application you can add, edit and delete drivers, cargoes, destinations, senders
owners then you can register invoices. you can filter registered invoicces and export them to excel file. I used phpspreadsheet. In below link you can see 
how to use it.
https://www.studentstutorial.com/php-spreadsheet/phpspreadsheet-tutorial

you can create invoice for each registered invoice and download odf file. I used mPDF. you can read about it in below link.
https://mpdf.github.io/

I used a custom MVC PHP framework and used mysql for database. in app/config/config.php you should define database params, base url, assets url, and 
website name.

//DB params
define('DB_HOST', 'localhost');
define('DB_USER','dev_bot');
define('DB_PASSWORD', 'dev%bot');
define('DB_NAME', 'nafispanel');

//App root
define('APPROOT', dirname(dirname(__FILE__)));
// Asset root
define('ASSETROOT', dirname(dirname(dirname(__FILE__))));
//Url root
define('URLROOT','http://localhost/nafispanel');

//Site name
define('SITENAME','NafisPanel');
//App version
define('APPVERSION','1.0.0');

In path public/htaccess you sould change RewriteBase for your website     

RewriteBase /nafispanel/public

