<?php

require 'vendor/autoload.php';
error_reporting(-1);
ini_set('display_errors', 1);

use Fabiang\Fortschritt\ParseCsv;
use Fabiang\Fortschritt\Revenue;
use Fabiang\Fortschritt\Table;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/template');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__ . '/cache',
    'debug' => true
));

$csvPath = 'https://raw.githubusercontent.com/fabiang/pkb-oamtmd/master/umsaetze.csv';

$parser = new ParseCsv($csvPath, 1, 'ISO-8859-1');
$csv = array_reverse($parser->parse(new Revenue()));

$table = new Table($csv);

$template = $twig->loadTemplate('fortschritt.html.twig');
file_put_contents(__DIR__ . '/index.html', $template->render(array(
    'ranges' => $table->generate(500, 6450),
    'days'   => $table->days(),
)));
