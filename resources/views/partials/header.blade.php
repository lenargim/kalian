<header class="header">
  <div class="container">
    <div class="header__wrap">
      @if(wp_is_mobile())
        <div class="burger">
          <span></span>
        </div>
        <div class="header__mobile">
          <div class="socials">
            <a class="socials-link" href="https://www.instagram.com/@php the_field('instagram',9) @endphp"
               target="_blank">
              @include('icon::instagram', ['class' => 'icon'])
            </a>
            <a class="socials-link" href="https://api.whatsapp.com/send?phone=@php the_field('whatsapp',9) @endphp"
               target="_blank">
              @include('icon::whatsapp', ['class' => 'icon'])
            </a>
            <a class="socials-link" href="tg://resolve?domain=@php the_field('telegram',9) @endphp" target="_blank">
              @include('icon::telegram', ['class' => 'icon'])
            </a>
          </div>
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'header__menu']) !!}
          @endif
          <div class="header__actions">
            <h3 class="header__actions-title">Акции</h3>
            @php
              global $post;
              $args = [
                'numberposts' => 1,
                'post_type' => 'sale',
                'action_type' => 'menu',
              ];
              $actions = get_posts( $args );
            @endphp
            @foreach( $actions as $post )
              @php setup_postdata($post) @endphp
            <a href="@php echo get_post_permalink() @endphp" class="header__actions-link">
              <img class="header__actions-img" src="@php the_post_thumbnail_url() @endphp" alt="@php the_title() @endphp">
              <span class="header__actions-name">@php the_title() @endphp</span>
            </a>
            @endforeach
            @php wp_reset_postdata() @endphp
          </div>
        </div>
      @endif
      <a class="logo img" href="/"><img src="@asset('images/logo.png')" alt="kalian-smr"></a>
      @if(!wp_is_mobile())
        <div class="socials">
          <a class="socials-link" href="https://www.instagram.com/@php the_field('instagram',9) @endphp"
             target="_blank">
            @include('icon::instagram', ['class' => 'icon'])
          </a>
          <a class="socials-link" href="https://api.whatsapp.com/send?phone=@php the_field('whatsapp',9) @endphp"
             target="_blank">
            @include('icon::whatsapp', ['class' => 'icon'])
          </a>
          <a class="socials-link" href="tg://resolve?domain=@php the_field('telegram',9) @endphp" target="_blank">
            @include('icon::telegram', ['class' => 'icon'])
          </a>
        </div>
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'header__menu']) !!}
        @endif
      @endif
      <div class="call">
        <a href="tel:@php the_field('phone',9) @endphp" class="call__phone">
          @include('icon::help-operator', ['class' => 'help'])
          <span href="tel:@php the_field('phone',9) @endphp">@php the_field('phone',9) @endphp</span>
        </a>
        <div class="call__callback open-callback">Заказать звонок</div>
      </div>
    </div>
  </div>
</header>
