<?php

/** This file is part of KCFinder project
  *
  *      @desc Load language labels into JavaScript
  *   @package KCFinder
  *   @version 3.0-dev
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */

namespace kcfinder;
require "core/autoload.php";

if (!isset($_GET['lng']) || ($_GET['lng'] == 'en')) {
    header("Content-Type: text/javascript");
    die;
}
$file = "lang/" . $_GET['lng'] . ".php";
$files = dir::content("lang", array(
    'types' => "file",
    'pattern' => '/^.*\.php$/'
));
if (!in_array($file, $files)) {
    header("Content-Type: text/javascript");
    die;
}
$mtime = @filemtime($file);
if ($mtime) httpCache::checkMTime($mtime);
require $file;
header("Content-Type: text/javascript; charset={$lang['_charset']}");
foreach ($lang as $english => $native)
    if (substr($english, 0, 1) != "_")
        echo "browser.labels['" . text::jsValue($english) . "']=\"" . text::jsValue($native) . "\";";

?>
