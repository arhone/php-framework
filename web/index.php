<?php
include __DIR__ . '/../vendor/autoload.php';

$Builder = new arhone\builder\Builder();
//$Builder->instruction(include __DIR__ . '/../config/builder.php');

$Trigger = $Builder->make('Trigger');