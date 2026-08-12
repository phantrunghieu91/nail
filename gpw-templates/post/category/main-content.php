<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Post category - Main content
 */
global $wp_query;

$currentObj = get_queried_object();
$blogPageID = get_option( 'page_for_posts' );
$title      = is_home() ? get_the_title( $blogPageID ) : $currentObj->name;
$maxPages   = $wp_query->max_num_pages ?: 1;
$paged      = get_query_var( 'paged', 1 );
?>
<section class="archive-post">
  <div class="section__inner">
    <h1 class="archive-post__title"><?= esc_html( $title ) ?></h1>
    <div class="archive-post__post-grid">
      <?php if( have_posts() ) : ?>

        <?php while( have_posts() ) {
          the_post();
          get_template_part( 'gpw-templates/post/post-card' );
        } ?>

        <?php wp_reset_postdata(); ?>

      <?php else : ?>
        <p class="not-found"><?= __('No posts found!', 'gpw') ?></p>
      <?php endif ?>
    </div>
    <?php if( $maxPages > 1 ) {
      echo '<div class="jins-page-pagination archive-post__pagination">';
      echo paginate_links( [
        'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
        'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
        'format'    => '?paged=%#%',
        'current'   => max( $paged, 1 ),
        'total'     => $maxPages,
        'end_size'  => 2,
      ] );
      echo '</div>';
    } ?>
  </div>
</section>