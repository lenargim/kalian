<div class="breadcrumbs">
  <div class="container">
    <a href="/">Главная</a>
    @if(is_archive())
      <h1>{{ the_archive_title() }}</h1>
    @else
      <h1>@php wp_title('', true) @endphp</h1>
    @endif
  </div>
</div>
