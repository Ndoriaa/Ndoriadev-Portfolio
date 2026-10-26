<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $world==='home' ? 'Victor Ndoria' : esc($pageTitle).' | Victor Ndoria' ?></title>
<meta name="description" content="<?= esc($descs[$world]) ?>">
<link rel="stylesheet" href="/assets/css/style.css"></head>
<body class="<?= $world ?>"><a class="skip" href="#main">Skip to content</a>
<header class="top"><a class="brand" href="<?= $homes[$world] ?>">Victor Ndoria</a>
<nav aria-label="Main"><?php foreach($nav[$world] as $u=>$t): ?><a href="<?= $u ?>"<?= $u===$current?' aria-current="page"':'' ?>><?= esc($t) ?></a><?php endforeach; ?></nav></header>
<main id="main">
