<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'root',
	"database" => 'SS_demosite',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');

MovieListPage::add_extension('Page_Controller', 'PdfControllerExtension');