const axios = require('axios');
const numberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).ready(function () {
  const auto = true;
  const intervalTime = 5000;
  let slideInterval;

  $("#next").click(function () {
    nextSlide();
    clearInterval(slideInterval);
    //Run next slide at interval
    slideInterval = setInterval(nextSlide, intervalTime);
  });

  $("#prev").click(function () {
    prevSlide();
    clearInterval(slideInterval);
    //Run next slide at interval
    slideInterval = setInterval(nextSlide, intervalTime);
  });

  const nextSlide = () => {
    const current = $(".active-slide");
    current.removeClass("active-slide");

    if (current.next().length != 0) {
      current.next().addClass("active-slide");
    } else {
      $(".slide:first-child").addClass("active-slide");
    }

    setTimeout(() => current.removeClass("active-slide"));
  };

  const prevSlide = () => {
    const current = $(".active-slide");
    //Remove current class
    current.removeClass("active-slide");
    //Check for previous slide
    if (current.prev().length != 0) {
      //Add active-slide to previous slide
      current.prev().addClass("active-slide");
    } else {
      //Add current to last slide
      $(".slide:last-child").addClass("active-slide");
    }

    setTimeout(() => current.removeClass("active-slide"));
  };

  //Auto slide
  if (auto) {
    //Run next slide at interval
    slideInterval = setInterval(nextSlide, intervalTime);
  }

const containerForCart = (value, ex) => {
  let contain;
  switch (ex) {
    case 1:
    contain = `
    <div class="cart-item-text-name">
      ${value.inm}
    </div>
    <div class="cart-item-text-price">
      &#8358; <span id="ctotal${value.iid}">${numberWithCommas(value.p)}</span>
    </div>
    <div class="quantity-control">
      <button
        class="minus getval"
        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
        iid="${value.iid}" p="${value.p}"
      >
        &#x2212;
      </button>
      <input class="catnumber${value.iid}" min="1" max="2000" value="${value.unit}" type="number" />
      <button
        class="plus getval"
        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
        iid="${value.iid}" p="${value.p}"
      >
        &#x2b;
      </button>
    </div>
    `;
      break;
    default:
    contain = `
    <div class="cart-item-text">
      <div class="cart-item-text-name">
        ${value.inm}
      </div>
      <div class="cart-item-text-price">
        &#8358; <span id="ctotal${value.iid}">${numberWithCommas(value.p)}</span>
      </div>
      <div class="quantity-control">
        <button
          class="minus getval"
          onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
          iid="${value.iid}" p="${value.p}"
        >
          &#x2212;
        </button>
        <input class="catnumber${value.iid}" min="1" max="2000" value="${value.unit}" type="number" />
        <button
          class="plus getval"
          onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
          iid="${value.iid}" p="${value.p}"
        >
          &#x2b;
        </button>
      </div>
    </div>
    `;
  }
    return contain;
}

  const popCart = (cartValue, exp) => {
    let cartItem = '';
    let subTotal = 0;
    $.each(cartValue, function(key, value) {
        cartItem += `
        <div id="cart${value.iid}" class="cart-items-single">
          <div class="cart-item-img">
            <a href="/item/${value.sl}">
              <img src="/storage/${value.img}" alt="" />
            </a>
          </div>
          ${containerForCart(value,exp)}
          <span class="cart-item-remove" iid="${value.iid}">&#215;</span>
        </div>
        `;
        subTotal += Number(value.p);
      });

      const delivery = parseInt($("#dlvry").html().replace(",", ""));

      let sumtotal = delivery + subTotal;
      $('#gcart').html(cartItem);
      $("#sub-total").html(numberWithCommas(subTotal));

      $("#dlvry").html(numberWithCommas(delivery));

      $("#total-sum").html(numberWithCommas(sumtotal));
  }

  const storedValue = JSON.parse(localStorage.getItem("mart-cart"));
  if($("#slide-cart").length){
    if(typeof storedValue !== typeof undefined && storedValue instanceof Array){
      if (storedValue.length !== 0) {

        if (typeof $("#slide-cart").attr('gt') !== typeof undefined && $("#slide-cart").attr('gt') !== false) {

         popCart(storedValue, 0);
        }else{
          //alert('user');
          axios.post('/loadcart', {
            storedValue: storedValue
          })
          .then(function (cart) {
            // TODO: return a message to the user
            //console.log(cart);
            popCart(cart.data, 0);
            const cartCount = parseInt(cart.data.length);
            $("#cart-count").html(cartCount);
            localStorage.removeItem("mart-cart");
          })
          .catch(function (error) {
            // TODO: return a message to the user
            console.log(error);
          });
        }
      }else{
        localStorage.removeItem("mart-cart");
      }
    }
  }

  if($(".gcart-sec").length){
    if(typeof storedValue !== typeof undefined && storedValue instanceof Array){
      if (storedValue.length !== 0) {
        if (typeof $(".gcart-sec").attr('gt') !== typeof undefined && $(".gcart-sec").attr('gt') !== false) {

         popCart(storedValue, 1);
        }else{
          //alert('user');
          axios.post('/loadcart', {
            storedValue: storedValue
          })
          .then(function (cart) {
            // TODO: return a message to the user
            //console.log(cart);
            popCart(cart.data, 1);
            const cartCount = parseInt(cart.data.length);
            $("#cart-count").html(cartCount);
            localStorage.removeItem("mart-cart");
          })
          .catch(function (error) {
            // TODO: return a message to the user
            console.log(error);
          });
        }
      }
    }
  }

  if(typeof storedValue !== typeof undefined && storedValue instanceof Array){
    if (typeof $("#cart-count").attr('gt') !== typeof undefined && $("#cart-count").attr('gt') !== false){
      const cartCount = parseInt(storedValue.length);
      $("#cart-count").html(cartCount);
    }
  }


  $(".btn-add-to-cart").click(function () {
    // const iid = $(this).attr("iid");
    // axios.post('/cart', {
    //   iid: iid
    //
    // })
    // .then(function (cart) {
    //   let cartItem = '';
    //   $.each(cart.data, function(key, value) {
    //     cartItem += `
    //     <div class="cart-items-single">
    //       <div class="cart-item-img">
    //         <a href="">
    //           <img src="/storage/${value.image}" alt="" />
    //         </a>
    //       </div>
    //
    //       <div class="cart-item-text">
    //         <div class="cart-item-text-name">
    //           ${value.name}
    //         </div>
    //         <div class="cart-item-text-price">
    //           &#8358;${value.price}
    //         </div>
    //         <div class="quantity-control">
    //           <button
    //             class="minus"
    //             onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
    //           >
    //             &#x2212;
    //           </button>
    //           <input min="1" max="100" value="1" type="number" />
    //           <button
    //             class="plus"
    //             onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
    //           >
    //             &#x2b;
    //           </button>
    //         </div>
    //       </div>
    //       <span class="cart-item-remove">&#215;</span>
    //     </div>
    //     `;
    //
    //   });
    //     $('.cart-items-wrap').html(cartItem);
    // })
    // .catch(function (error) {
    //   console.log(error);
    // });
    // $("#slide-cart").addClass("show-cart");
    //$(".cart-items-wrap").prepend(cartItem);
    //$(this).off("click");
    const iid = $(this).attr("iid");
    const sl = $(this).attr("sl");
    const img = $(this).attr("img");
    const p = $(this).attr("p");
    const inm = $(this).attr("inm");
    const gt = $(this).attr('gt');
    let cartList;

    const cartSingle = $(".cart-items-wrap").find(`#cart${iid}`).length;
    console.log(cartSingle);

    if(cartSingle == 0){
        let cartItem = `
        <div id="cart${iid}" class="cart-items-single">
          <div class="cart-item-img">
            <a href="/item/${sl}">
              <img src="/storage/${img}" alt="" />
            </a>
          </div>

          <div class="cart-item-text">
            <div class="cart-item-text-name">
              ${inm}
            </div>
            <div class="cart-item-text-price">
              &#8358;<span id="ctotal${iid}">${numberWithCommas(p)}</span>
            </div>
            <div class="quantity-control">
              <button
                class="minus getval"
                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                iid="${iid}" p="${p}"
              >
                &#x2212;
              </button>
              <input class="catnumber${iid}" min="1" max="2000" value="1" type="number" />
              <button
                class="plus getval"
                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                iid="${iid}" p="${p}"
              >
                &#x2b;
              </button>
            </div>
          </div>
          <span class="cart-item-remove" iid="${iid}">&#215;</span>
        </div>
        `;

        $(".cart-items-wrap").prepend(cartItem);
        const cartCount = parseInt($("#cart-count").html()) + 1;
        $("#cart-count").html(cartCount);

        const q = $(".catnumber"+iid).val();
        caltotalct(p,iid,q);

        if (typeof gt !== typeof undefined && gt !== false) {
            //alert('has it');
            if (localStorage.getItem("mart-cart") === null) {
                cartList = [];

              }else{
                cartList = JSON.parse(localStorage.getItem("mart-cart"));
              }

              cartList.unshift({iid, sl, img, p, inm, unit: 1});
              localStorage.setItem("mart-cart", JSON.stringify(cartList));

        }else{
          //alert('no');
        $("#loader-ring").addClass("lds-ring");
        axios.post('/cart', {
          iid: iid
        })
        .then(function (cart) {
          // TODO: return a message to the user

          console.log(cart);
          $('#loader-ring').removeClass("lds-ring");
        })
        .catch(function (error) {
          // TODO: return a message to the user
          console.log(error);
          $('#loader-ring').removeClass("lds-ring");
        });
        }
      }
      $("#slide-cart").addClass("show-cart");

  });

  $(document).on('click','.getval',function(e){
    e.preventDefault();
      const iid = $(this).attr("iid");
      const p = $(this).attr("p");
      const q = $(".catnumber"+iid).val();
      caltotalct(p,iid,q);
  });

  $(document).on('click','.cart-item-remove',function(e){
    e.preventDefault();
    const iid = $(this).attr("iid");
    const cartCount = parseInt($("#cart-count").html()) - 1;
    $(".ctwrapper").children(`#cart${iid}`).remove();
    $("#cart-count").html(cartCount);
    calAmount();
    const cartArray = JSON.parse(localStorage.getItem("mart-cart"));
    if(typeof cartArray !== typeof undefined && cartArray instanceof Array){
      if (cartArray.length !== 0) {
        const item = $.grep(cartArray, function(obj){return obj.iid === iid;})[0];
        if(item){
          const itemIndex = cartArray.indexOf(item);
          cartArray.splice(itemIndex, 1);
          localStorage.setItem("mart-cart", JSON.stringify(cartArray));
        }else{
          console.log('not found');
        }
      }
    }else{
      $("#loader-ring").addClass("lds-ring");
      axios.post('/removecart', {
        iid: iid
      })
      .then(function (cart) {
        // TODO: return a message to the user

        console.log(cart);
        $('#loader-ring').removeClass("lds-ring");
      })
      .catch(function (error) {
        // TODO: return a message to the user
        console.log(error);
        $('#loader-ring').removeClass("lds-ring");
      });
    }
  });

  const caltotalct = (p,iid,q) => {
    const sum = p * Number(q);
    $("#ctotal"+iid).html(numberWithCommas(sum));
    calAmount();

  }

  const calAmount = () => {
    const ctotalid = $('*[id^="ctotal"]');
    let subTotal = 0;

    for(let i = 0 ; i < ctotalid.length; i++){
      const rComm = $(ctotalid[i]).html().replace(",", "");
      subTotal += parseInt(rComm);
    }

    //const delivery = 1000;
    const delivery = parseInt($("#dlvry").html().replace(",", ""));

    let sumtotal = delivery + subTotal;

    $("#sub-total").html(numberWithCommas(subTotal));

    $("#dlvry").html(numberWithCommas(delivery));

    $("#total-sum").html(numberWithCommas(sumtotal));
  }

  $("#cart-close").click(function () {
    $("#slide-cart").removeClass("show-cart");
  });

  $("#show-cat").click(function () {
    $(".nav-sub-menu").toggleClass("show-cat");
  });

  $("#myBtn").click(function () {
    $("#myModal").css("display", "block");
  });

  $("#closeModal").click(function () {
    $("#myModal").css("display", "none");
  });

  $(window).click(function (e) {
    if ($(e.target).is("#myModal")) {
      $("#myModal").css("display", "none");
    }
  });

  $(".all-imgs img").click(function () {
    let imgSrc = $(this).attr("src");
    $(this).addClass("active-img").siblings().removeClass("active-img");
    $("#main-img").css("background-image", `url('${imgSrc}')`);
  });

  $("#main-img").mousemove(function (e) {
    let width = $(this).width();
    let height = $(this).height();

    let mouseX = e.offsetX;
    let mouseY = e.offsetY;

    let posX = (mouseX / width) * 100;
    let posY = (mouseY / height) * 100;

    $(this).css("background-position", `${posX}% ${posY}%`);
  });

  $("#main-img").mouseout(function (e) {
    $(this).css("background-position", "center");

    //console.log(e);
  });

  // const animatethis = (targetElement, speed) => {
  //   const scrollWidth = $(targetElement).get(0).scrollWidth;
  //   const clientWidth = $(targetElement).get(0).clientWidth;
  //   $(targetElement).animate(
  //     { scrollLeft: scrollWidth - clientWidth },
  //     {
  //       duration: speed,
  //       complete: () => {
  //         targetElement.animate(
  //           { scrollLeft: 0 },
  //           {
  //             duration: speed,
  //             complete: () => {
  //               animatethis(targetElement, speed);
  //             },
  //           }
  //         );
  //       },
  //     }
  //   );
  // };
  // animatethis($(".more-items"), 10000);
  // work in progress - needs some refactoring and will drop JQuery i promise :)
  var instance = $(".hs__wrapper");
  $.each(instance, function (key, value) {
    var arrows = $(instance[key]).find(".arrow"),
      prevArrow = arrows.filter(".arrow-prev"),
      nextArrow = arrows.filter(".arrow-next"),
      box = $(instance[key]).find(".hs"),
      x = 0,
      mx = 0,
      maxScrollWidth =
        box[0].scrollWidth - box[0].clientWidth / 2 - box.width() / 2;

    $(arrows).on("click", function () {
      if ($(this).hasClass("arrow-next")) {
        x = box.width() / 2 + box.scrollLeft() - 10;
        box.animate({
          scrollLeft: x,
        });
      } else {
        x = box.width() / 2 - box.scrollLeft() - 10;
        box.animate({
          scrollLeft: -x,
        });
      }
    });

    $(box).on({
      mousemove: (e) => {
        const mx2 = e.pageX - this.offsetLeft;
        if (mx) this.scrollLeft = this.sx + mx - mx2;
      },
      mousedown: (e) => {
        this.sx = this.scrollLeft;
        mx = e.pageX - this.offsetLeft;
      },
      scroll: () => {
        toggleArrows();
      },
    });

    $(document).on("mouseup", function () {
      mx = 0;
    });

    const toggleArrows = () => {
      if (box.scrollLeft() > maxScrollWidth - 10) {
        // disable next button when right end has reached
        nextArrow.addClass("disabled");
      } else if (box.scrollLeft() < 10) {
        // disable prev button when left end has reached
        prevArrow.addClass("disabled");
      } else {
        // both are enabled
        nextArrow.removeClass("disabled");
        prevArrow.removeClass("disabled");
      }
    };
  });
});
