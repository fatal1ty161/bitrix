<?php
$arUrlRewrite=array (
  3 => 
  array (
    'CONDITION' => '#^/resheniya/(.*)/.*#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => 'bitrix:news',
    'PATH' => '/resheniya/detail.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/uslugi/(.*)/.*#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => 'bitrix:news',
    'PATH' => '/uslugi/detail.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/resheniya/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/resheniya/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/uslugi/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/uslugi/index.php',
    'SORT' => 100,
  ),
);
