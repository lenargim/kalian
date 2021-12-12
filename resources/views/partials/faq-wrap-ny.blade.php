<div class="faq-block__wrap">
  <div class="faq-block__questions">
    @while ( have_rows('faq') ) @php the_row() @endphp
    <div class="faq-block__questions-item">@php the_sub_field('question') @endphp</div>
    @endwhile
  </div>
  <div class="faq-block__answers">
    @while ( have_rows('faq') ) @php the_row() @endphp
    <div class="faq-block__answers-item">
      <div class="faq-block__answers-title">@php the_sub_field('question') @endphp</div>
      <div class="faq-block__answers-box">@php the_sub_field('answer') @endphp
      </div>
    </div>
    @endwhile
  </div>
</div>
