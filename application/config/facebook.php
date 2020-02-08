<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string   Your facebook app ID.
|  facebook_app_secret           string   Your facebook app secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string   URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array    The permissions you need.
|  facebook_graph_version        string   Set Facebook Graph version to be used. Eg v2.6
|  facebook_auth_on_load         boolean  Set to TRUE to have the library to check for valid access token on every page load.
*/
if(ENV=='development')
{

$config['facebook_app_id']              = '209946089451029';
$config['facebook_app_secret']          = '543ac39f624d79b859d35ee30f86ab20';
}
else if(ENV=='testing')
{

$config['facebook_app_id']              = '206556646456640';
$config['facebook_app_secret']          = 'c353b4376eec3b3c10c1ffe3527b023b';
}
else if(ENV == 'production')
{

$config['facebook_app_id']              = '206556646456640';
$config['facebook_app_secret']          = 'c353b4376eec3b3c10c1ffe3527b023b';
}

$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'UserController/loginfacebook';
$config['facebook_connect_redirect_url']  = 'UserController/connectwithfacebook';
$config['facebook_logout_redirect_url'] = 'UserController/logout';
$config['facebook_permissions']         = array('public_profile', 'user_friends', 'email');
$config['facebook_graph_version']       = 'v2.6';
$config['facebook_auth_on_load']        = TRUE;
