<?
      $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => NEW_WIDTH, "height" => NEW_HEIGHT), BX_RESIZE_IMAGE_EXACT, false);
      echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'" />';
?>
