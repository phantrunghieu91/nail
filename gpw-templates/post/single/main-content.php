<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single post page - Main content
 */
$postedDate  = get_the_date( 'd M, Y' );
$blogPageUrl = get_permalink( get_option( 'page_for_posts' ) );
?>

<section class="single-post">
  <div class="section__inner" data-width="medium">
    <header class="single-post__header">
      <span class="single-post__post-date"><?= esc_html( $postedDate ) ?></span>
      <h1 class="single-post__title"><?= get_the_title() ?></h1>
      <?= get_the_post_thumbnail( null, 'large', [ 'class' => 'single-post__thumbnail', 'alt' => get_the_title() ] ) ?>
    </header>
    <main class="single-post__content">
      <?php the_content() ?>
    </main>
    <footer class="single-post__footer">
      <?php get_template_part( 'gpw-templates/global/jins-button', null, [
        'label'         => __( 'Back to blog' ),
        'href'          => $blogPageUrl,
        'icon_code'     => 'chevron_left',
        'icon_position' => 'left',
      ] ) ?>
    </footer>
  </div>
</section>

<?php
