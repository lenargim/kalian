<div class="breadcrumbs">
  <div class="container">
    <a href="/">Главная</a>
    @if(is_archive() )
      <h1>{{ the_archive_title() || is_home() }}</h1>
    @elseif(is_home())
      <h1>Отзывы</h1>
    @else
      <h1>@php the_title() @endphp</h1>
    @endif
  </div>
</div>
