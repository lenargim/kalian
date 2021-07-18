<div class="actions-slider">
  <div class="container">
    <h2 class="title">Акции</h2>
    <div class="actions-slider__slider">
      @php
        global $post;
        $args = [
          'numberposts' => -1,
          'post_type' => 'sale',
        ];
        $actions = get_posts( $args );
      @endphp
      @foreach( $actions as $post )
        @php setup_postdata($post) @endphp
        <div class="actions-slider__item">
          <div class="actions-slider__img"><img src="@php the_post_thumbnail_url() @endphp" alt="@php the_title() @endphp"></div>
          <div class="actions-slider__info">
            <div class="actions-slider__name">@php the_title() @endphp</div>
            <div class="actions-slider__text">@php the_field('short') @endphp
            </div>
            <a href="@php echo get_post_permalink() @endphp" class="actions-slider__link">Подробнее</a>
          </div>
        </div>
      @endforeach
      @php wp_reset_postdata() @endphp
    </div>
    <div class="actions-slider__more">
      <a href="/sale" class="button">Еще акции</a>
    </div>
  </div>
</div>
