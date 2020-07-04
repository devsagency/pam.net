<?php

// FOR VIEWS

define("TWIG_TEMPLATES", "../src/View");

define("TWIG_CACHE", false);

// FOR DATABASE

define("DB_DSN", "mysql:host=localhost;dbname=database_name"); // replace "database_name"

define("DB_USER", "database_username"); // replace "database_username"

define("DB_PASS", "database_user_password"); // replace "database_user_password"

define("DB_OPTIONS", array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// FOR MAILS

define("MAIL_HOST", "mail.host.com"); // replace "mail.host.com"

define("MAIL_PORT", 000); // replace "000"

define("MAIL_FROM", "mail@host.com"); // replace "mail@host.com"

define("MAIL_PASSWORD", "mail-user-password"); // replace "mail-user-password"

define("MAIL_TO", "mail@host.com"); // replace "mail@host.com"

define("MAIL_USERNAME", "mail-username"); // replace "mail-username"

// FOR RECAPTCHA

define("RECAPTCHA_TOKEN", "website-token"); // replace "website-token"
