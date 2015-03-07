
    <!-- Title mustn't exceed 60 characters and it must not be too short too for seo optimization -->
    <title>
        BnW - A Complete CMS (make content editing easy)
    </title>
    <!-- this meta tag is used for defining view port so use it too-->
    <meta name="viewport" content="width-device-width" initial-scale="1.0">
<!-- description meta name shows contents within it in serach engines with the heading of your site-->
<meta name="description" content="BnW is a complete CMS that enables you to add, edit, delete and update your website contents in easy manner. It is the quality product from Salyani Technologies, Chitwan.">
<!-- keywords meta name is used to show the site url in search engines if the contents here matches the key word used in search -->
<meta name="keywords" content="bnw, BnW, BNW, CMS, Cms, cms, content management system, manage web page, page management, a complete page manager, web, webpage, webpage manager, website, website editor, update website, easy website update, website upload, easy update" >
    

<!--use following lines in .htaccess file for GZIP compression in web site-->
<IfModule mod_deflate.c>
  # Compress HTML, CSS, JavaScript, Text, XML and fonts
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/rss+xml
  AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
  AddOutputFilterByType DEFLATE application/x-font
  AddOutputFilterByType DEFLATE application/x-font-opentype
  AddOutputFilterByType DEFLATE application/x-font-otf
  AddOutputFilterByType DEFLATE application/x-font-truetype
  AddOutputFilterByType DEFLATE application/x-font-ttf
  AddOutputFilterByType DEFLATE application/x-javascript
  AddOutputFilterByType DEFLATE application/xhtml+xml
  AddOutputFilterByType DEFLATE application/xml
  AddOutputFilterByType DEFLATE font/opentype
  AddOutputFilterByType DEFLATE font/otf
  AddOutputFilterByType DEFLATE font/ttf
  AddOutputFilterByType DEFLATE image/svg+xml
  AddOutputFilterByType DEFLATE image/x-icon
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE text/plain
  AddOutputFilterByType DEFLATE text/xml

  # Remove browser bugs (only needed for really old browsers)
  BrowserMatch ^Mozilla/4 gzip-only-text/html
  BrowserMatch ^Mozilla/4\.0[678] no-gzip
  BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
  Header append Vary User-Agent
</IfModule>

<!-- use the following code in .htaccess file for enabling browser cache -->
<IfModule mod_expires.c>

# Enable expirations
ExpiresActive On

# Default directive
ExpiresDefault "access plus 1 month"

# My favicon
ExpiresByType image/x-icon "access plus 1 year"

# Images
ExpiresByType image/gif "access plus 1 month"
ExpiresByType image/png "access plus 1 month"
ExpiresByType image/jpg "access plus 1 month"
ExpiresByType image/jpeg "access plus 1 month"

# CSS
ExpiresByType text/css "access 1 month"

# Javascript
ExpiresByType application/javascript "access plus 1 year"

</IfModule>

<!-- for open graph replace your html code by-->
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
    <!-- and then use this-->
    <meta property="og:title" content="Central College - A Vocational Training Center."/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="http://www.centralcollege.com.np"/>
<meta property="og:image" content="http://www.centralcollege.com.np/content/uploads/images/Central_College_color.png"/>
<meta property="og:site_name" content="Central college Of Vocational Training Pvt. Ltd."/>
<meta property="fb:app_id" content="798589833503780"/>
<meta property="og:description" content="Central College Of Vocational Training Pvt. Ltd. provides educational facilities like IELTS, TOEFL, GRE, GMAT, SAT, trainings and student visa services to different countries."/>

<!-- toremove index.php from url add these lines to .htaccess file-->


   # Step 1 => Place your .htaccess file in root folder where application and system folders exist.

   # Step 2 => If your web path using sub-folder like - yourdomain.com/project/ - then use following code in htaccess file

<IfModule mod_rewrite.c>

RewriteEngine on
RewriteCond $1 !^(index\.php|images|robots\.txt)
RewriteRule ^(.*)$ /project/index.php/$1 [L]  
</IfModule>

<IfModule !mod_rewrite.c>
 	ErrorDocument 404 /index.php
</IfModule>

   # If your web path using root-folder like - yourdomain.com - then use following code in htaccess file
   
   <IfModule mod_rewrite.c>

RewriteEngine on
RewriteCond $1 !^(index\.php|images|robots\.txt)
RewriteRule ^(.*)$ /index.php/$1 [L]  
</IfModule>

<IfModule !mod_rewrite.c>
 	ErrorDocument 404 /index.php
</IfModule>


# in config.php 
 #in line $config['uri_protocol']	= 'AUTO';
 #Replace it with $config['uri_protocol']	= 'PATH_INFO';
 # in Apache enable rewrite module
 
 <!-- the CORS for all in .htaccess -->
 SetEnvIf Origin ^(.*)$ ORIGIN_DOMAIN=$0
<files "*"="">
Header set Access-Control-Allow-Origin "*"
Header add Access-Control-Allow-Methods "GET, OPTIONS"
Header add Access-Control-Allow-Headers "Authorization, X-Requested-With, Content-Type, Origin, Accept"
Header add Access-Control-Allow-Credentials "true"
</files>