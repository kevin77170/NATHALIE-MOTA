<?php
namespace ShortPixel;

class BuildAutoLoader
{

  public static function buildJSON()
  {
    echo 'Building Plugin.JSON';
    $plugin = array(
        'name' => 'ShortPixel/Plugin',
        'description' => 'ShortPixel AutoLoader',
        'type' => 'function',
        'autoload' => array('psr-4' => array('ShortPixel' => 'class'),
            'files' => self::getFiles(),
        ),
      );

    $f = fopen('class/plugin.json', 'w');
    $result = fwrite($f, json_encode($plugin));

    if ($result === false)
      echo "!!! Error !!! Could not write Plugin.json";

    fclose($f);
  }

  public static function getFiles()
  {
    $main = array(
      // 'shortpixel_api.php',
      // 'class/wp-short-pixel.php',
       'class/wp-shortpixel-settings.php',
      // 'class/view/shortpixel_view.php',
       'class/front/img-to-picture-webp.php',
    );

    $models = array(
    );

    $externals = array(
      'class/external/cloudflare.php',
      //'class/external/gravityforms.php',
      'class/external/nextgen/nextGenController.php',
      'class/external/nextgen/nextGenViewController.php',
      'class/external/visualcomposer.php',
			'class/external/offload/Offloader.php',
      'class/external/offload/wp-offload-media.php',
			'class/external/offload/virtual-filesystem.php',
      'class/external/wp-cli/wp-cli-base.php',
			'class/external/wp-cli/wp-cli-single.php',
			'class/external/wp-cli/wp-cli-bulk.php',
      'class/external/image-galleries.php',
      'class/external/pantheon.php',
			'class/external/spai.php',
			'class/external/cache.php',
			'class/external/uncode.php',
			'class/external/query-monitor.php',
			'class/external/Woocommerce.php',
      'class/external/themes/total-theme.php',
      'class/external/MediaFileRenamer.php',
      'class/external/formidable.php',
    );

    echo "Build Plugin.JSON ";
    return array_merge($main,$models,$externals);
  }

}
