<?php
// Builds the static site into dist/. Run: php build.php
$root = __DIR__; $dist = "$root/dist";
$projects = json_decode(file_get_contents("$root/src/data/projects.json"), true);
// out = output path, world = which side of the site (home, dev, creative)
$pages = [
 ['out'=>'index','world'=>'home','title'=>'Victor Ndoria'],
 ['out'=>'dev/index','world'=>'dev','title'=>'Developer and data'],
 ['out'=>'dev/software','world'=>'dev','title'=>'Software'],
 ['out'=>'dev/data','world'=>'dev','title'=>'Data science'],
 ['out'=>'dev/contact','world'=>'dev','title'=>'Contact'],
 ['out'=>'creative/index','world'=>'creative','title'=>'Videographer and photographer'],
 ['out'=>'creative/work','world'=>'creative','title'=>'Work'],
 ['out'=>'creative/contact','world'=>'creative','title'=>'Contact'],
];
$nav = [
 'dev' => ['/dev/index.html'=>'About','/dev/software.html'=>'Software','/dev/data.html'=>'Data science','/dev/contact.html'=>'Contact'],
 'creative' => ['/creative/index.html'=>'About','/creative/work.html'=>'Work','/creative/contact.html'=>'Contact'],
 'home' => [],
];
$homes = ['home'=>'/index.html','dev'=>'/dev/index.html','creative'=>'/creative/index.html'];
$descs = ['home'=>'Victor Ndoria, Nairobi: software and data work, and videography and photography.',
 'dev'=>'Victor Ndoria: Java, PHP, JavaScript and Python developer and data enthusiast in Nairobi.',
 'creative'=>'Victor Ndoria: videographer, photographer and graphic designer in Nairobi.'];
function esc($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function rmrf($p){ if(!file_exists($p)) return; if(is_file($p)) { unlink($p); return; } foreach(array_diff(scandir($p),['.','..']) as $f) rmrf("$p/$f"); rmdir($p); }
function cpr($s,$d){ if(!is_dir($d)) mkdir($d,0777,true); foreach(array_diff(scandir($s),['.','..']) as $f) is_dir("$s/$f") ? cpr("$s/$f","$d/$f") : copy("$s/$f","$d/$f"); }
function cards($projects,$cat){
  foreach($projects as $p){ if($p['category']!==$cat) continue;
    echo '<article class="card">';
    if(!empty($p['image'])) echo '<img class="shot" src="'.esc($p['image']).'" alt="'.esc($p['alt'] ?? $p['title'].' screenshot').'" loading="lazy">';
    echo '<h3>'.esc($p['title']).'</h3><p>'.esc($p['summary']).'</p><ul class="tags">';
    foreach($p['stack'] as $t) echo '<li>'.esc($t).'</li>';
    echo '</ul>';
    foreach(['repo'=>'Source code','demo'=>'Live demo','video'=>'Watch walkthrough'] as $k=>$label)
      if(!empty($p[$k])) echo '<a class="plink" href="'.esc($p[$k]).'">'.$label.'</a>';
    echo '</article>';
  }
}
rmrf($dist); cpr("$root/assets","$dist/assets");
foreach($pages as $p){
  $world=$p['world']; $pageTitle=$p['title']; $current='/'.$p['out'].'.html'; ob_start();
  include "$root/src/partials/header.php"; include "$root/src/pages/{$p['out']}.php"; include "$root/src/partials/footer.php";
  $file="$dist/{$p['out']}.html"; if(!is_dir(dirname($file))) mkdir(dirname($file),0777,true);
  file_put_contents($file, ob_get_clean());
}
echo "Built ".count($pages)." pages into dist/\n";
