<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
<main id="main">
    <!-- hero -->
    <section id="hero" class="hero d-flex align-items-start pt-lg-0 align-items-lg-center">
        <div class="hero__inner container-xl text-center">
            <div class="h1">Our experts at <span>Afiniti</span></div>
        </div>
    </section>
    <?php
$anim = 'our-people';
include get_stylesheet_directory() . '/page-templates/anim/' . $anim . '.php';
?>
    <div class="container-xl">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="single-person-photo"
                    style="background-image:url(<?=wp_get_attachment_image_url(get_field('photo'), 'medium')?>)">
                </div>
                <h1 class="fs-4 fw-bold text--green mt-4">
                    <?=strtoupper(get_the_title())?>
                </h1>
                <div class="fs-5 text--green pb-2">
                    <?=get_field('job_title')?>
                </div>
                <div class="person-links pb-2">
                    <a class="linkedin-circle"
                        href="<?=get_field('linkedin_url')?>"
                        target="_blank" itemprop="url"><span class="fa-stack fa-2x"><i
                                class="fa fa-circle fa-stack-2x"></i><i
                                class="fa-brands fa-linkedin-in fa-stack-1x fa-inverse"></i></span></a>
                </div>
            </div>
            <div class="col-lg-8">
                <?php
            the_content();
?>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-1 offset-lg-7 border-dash-bottom-right h-30px"></div>
        <div class="d-none d-lg-block col-lg-1 offset-lg-6 border-dash-top-left mt-minus-2 h-30px"></div>
        <h2 class="text-center mb-4"><span>Insights</span></h2>
        <div class="row g-4">
            <?php
$counter = 0;

if (get_field('author') ?? null) {
    $authorID = get_field('author')[0];
    // var_dump($authorID);
    $args = array(
        'post_type'      => 'post', // Or your custom post type
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $peeps = get_field('person', get_the_ID()) ?? null;
            if (is_array($peeps) && isset($peeps[0])) {
                $postAuthor = $peeps[0]->ID;
                if ($postAuthor == $authorID) {
                    $counter++;
                    $img = get_the_post_thumbnail_url($query->ID, 'large');
                    ?>
            <div class="insight insight--short col-12 col-lg-4 mb-4">
                <a href="<?=get_the_permalink()?>">
                    <div class="post-image-container">
                        <div class="post-image mb-2"
                            style="background-image:url('<?=$img?>')">
                            <div class="img-overlay">
                                <div class="middle"><span class="arrow arrow-block arrow-white"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="article-title mt-2">
                        <?=get_the_title()?>
                    </div>
                    <div class="fw-bold py-2 arrow-link">
                        <div class="anim-arrow--slide">Read more <span class="arrow arrow-green"></span></div>
                    </div>
                </a>
            </div>
            <?php
                    // echo '<pre>' . $authorID . ' : ' . $postAuthor . '</pre>';
                }
            }
        }
    }

}
if ($counter == 0 ) {
    $i = new WP_Query(array(
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'rand'
    ));
    while ($i->have_posts()) {
        $i->the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        ?>
            <div class="insight insight--short col-12 col-lg-4 mb-4">
                <a href="<?=get_the_permalink()?>">
                    <div class="post-image-container">
                        <div class="post-image mb-2"
                            style="background-image:url('<?=$img?>')">
                            <div class="img-overlay">
                                <div class="middle"><span class="arrow arrow-block arrow-white"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="article-title mt-2">
                        <?=get_the_title()?>
                    </div>
                    <div class="fw-bold py-2 arrow-link">
                        <div class="anim-arrow--slide">Read more <span class="arrow arrow-green"></span></div>
                    </div>
                </a>
            </div>
            <?php
    }
}
?>
        </div>
    </div>
</main>
<?php
get_footer();
?>