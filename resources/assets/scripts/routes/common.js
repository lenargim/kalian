export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    $('.tel').mask('+7(Z00) 000-00-00', { translation: { 'Z': { pattern: /[0-79]/ } } })
  },
};

$('.price-block__sale a').on('click', function(e){
 e.preventDefault();
})

$('.price-block__form-close').on('click', function(){
  $(this).parent('.price-block__form').removeClass('active')
})

$('.price-block__order').on('click', function(){
  $(this).parents('.price-block__box').siblings('.price-block__form').addClass('active')
})

$('.cup-qty').each(function() {
  let qty = +parseInt($(this).text(), 10);
  let parent = $(this).parents('.price-block__item');
  parent.find('.input-cups').val(qty);
  parent.find('.input-cups').attr('coef', qty)
  changeCoalQty(parent, qty);
})

/*  Калькулятор */

$('.change-price').on('input keyup change', function(){
  let parent = $(this).parents('.price-block__item');
  changeTotal(parent)
})

$('.input-keyup').on('input keyup', function(){
  let qty = $(this).val()
  let parent = $(this).parents('.price-block__item');
  if (qty < 1) {
    $(this).val(1)
  }
  if ( $(this).hasClass('input-shisha')  ) {
    changeCupsQty(parent, qty)
  } else if ( $(this).hasClass('input-cups') ) {
    changeCoalQty(parent, qty)
  }
})

$('.change-shisha').on('click', function(e){
  e.preventDefault();
  let input = $(this).siblings('.input-shisha');
  let qty = input.val()
  let parent = $(this).parents('.price-block__item');
  if ( $(this).hasClass('btn-plus') ) {
      input.val( ++qty )
    } else if (qty > 1) {
      input.val( --qty )
    }
    changeCupsQty(parent, qty);
})

$('.change-cups').on('click', function(e){
  e.preventDefault();
  let input = $(this).siblings('.input-cups');
  let qty = input.val();
  let coef = input.attr('coef');
  let parent = $(this).parents('.price-block__item');
  let shishaQty = parent.find('.input-shisha').val()
  if ( $(this).hasClass('btn-plus') ) {
      input.val( ++qty )
    } else if (qty > shishaQty * coef) {
      input.val( --qty )
    }
    changeCoalQty(parent, qty)
})

function changeCupsQty(parent, qty) {
  let coef = parent.find('.input-cups').attr('coef')
  let input = parent.find('.input-cups');
  if (  (qty * coef) > input.val() ) {
    input.val(qty*coef)
  }
  changeCoalQty(parent, input.val())
}

function changeCoalQty(parent, qty) {
  qty = +qty;
  switch (qty) {
    case 1:
      parent.find('.coal').text('4 шт');
      break;
    case 2:
        parent.find('.coal').text('12 шт');
        break;
    default:
        parent.find('.coal').text(`${qty*4 + 4 + (qty-2)*2} шт`);
    }
    changeTotal(parent)
}

function changeTotal(parent) {
  let shisha = parent.find('.input-shisha').val();
  let cups = parent.find('.input-cups').val();
  let delivery = parent.find('.input-delivery').prop('checked');
  let deliverySum = delivery == true ? 500 : 0;
  let price = parent.find('.calc-price').html();
  let extraCupsPrice = parent.find('.addition').text();
  let coef = parent.find('.input-cups').attr('coef');
  let shishaSum;
  let cupsSum;
  let extraCupsQty = cups - coef * shisha;
  let total = parent.find('.price-block__total');
  if (shisha == 1) {
    shishaSum = +price;
    cupsSum = extraCupsQty * extraCupsPrice;
  } else if (shisha == 2) {
    shishaSum = +price*(1 + 0.8);
    let half = Math.ceil(extraCupsQty/2);
    cupsSum = half * extraCupsPrice + (extraCupsQty - half) * 0.8 * extraCupsPrice
  } else if ( shisha == 3 ) {
    shishaSum = +price*(1 + 0.8 + 0.7);
    let half = Math.ceil(extraCupsQty/2);
    let quarter = Math.ceil( (extraCupsQty - half)/2 );
    cupsSum = Math.round( extraCupsPrice * (half + 0.8*quarter + 0.7*(extraCupsQty-half-quarter)) )
  }
  let totalSum = shishaSum+cupsSum+deliverySum;
  //total.html(shishaSum+cupsSum+deliverySum + '₽')
  total.html(`Итого: <span class="total">${totalSum}₽</span>`)
 if (!totalSum || totalSum == 'NaN₽' ) {
    total.html('<span class="total">Уточните заполнив форму</span>')
  }
}
/*  Конец Калькулятор */
