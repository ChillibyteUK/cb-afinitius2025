<?php
$colour = strtolower(get_field('colour'));
$breakout = '';
$background = '';
if ($colour != '') {
    $background = 'bg--' . $colour;
    $parts = preg_split('/-/', $colour);
    $colourName = $parts[0];
}

$link = get_field('cta_link');

/**
 * A title counts as empty when nothing but markup or whitespace is left, so a
 * cleared field does not leave an empty heading behind. The trim list ends in
 * U+00A0 because a decoded &nbsp; is not stripped by trim()'s defaults.
 */
$has_text = function ( $value ) {
	return '' !== trim( html_entity_decode( wp_strip_all_tags( (string) $value ) ), " \t\n\r\0\x0B\xc2\xa0" );
};

$title = get_field('title');

?>
<div class="container-xl pb-4">
  <div class="row">
    <div class="col-12 col-lg-8 pb-2">
      <?php if ($has_text($title)) { ?>
      <div class="bg--<?=$colourName?>-700 p-4">
        <div class="font-large text-white">
          <h2><?=$title?></h2>
        </div>
      </div>
      <?php } ?>
      <div class="bg--<?=$colour?> text-white p-4">
        <?=get_field('content')?>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="row">
        <div class="col-12">
          <div class="bg--<?=$colour?> px-5 py-4">
            <div class="fs-5 fw-bold pb-2">
              <?=get_field('right_title')?>
            </div>
            <div>
              <?=get_field('right_content')?>
              <?php
              if (get_field('image')) {
                  ?>
              <div class="text-center py-4"><img
                  src="<?=wp_get_attachment_image_url(get_field('image'), 'large')?>"
                  class="wow fadeIn"></div>
              <?php
              }
?>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-8 text-center halfcircle-container">
              <div
                class="div-rounded ss-halfcircle halfcircle-<?=$colourName?>">
                <div class="halfcircle-content halfcircle-content-10 fw-bold">
                  <a href="<?=$link['url']?>"
                    target="<?=$link['target']?>"><?=$link['title']?>
                    <span class="arrow arrow-block arrow mt-2"></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>