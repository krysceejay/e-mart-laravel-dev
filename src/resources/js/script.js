const axios = require('axios');
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

    const cartSingle = $(".cart-items-wrap").find(`#cart${iid}`).length;

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
              &#8358;${p}
            </div>
            <div class="quantity-control">
              <button
                class="minus"
                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
              >
                &#x2212;
              </button>
              <input min="1" max="100" value="1" type="number" />
              <button
                class="plus"
                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
              >
                &#x2b;
              </button>
            </div>
          </div>
          <span class="cart-item-remove">&#215;</span>
        </div>
        `;

        $(".cart-items-wrap").prepend(cartItem);
        axios.post('/cart', {
          iid: iid

        })
        .then(function (cart) {
          // TODO: return a message to the user
          console.log(cart);
        })
        .catch(function (error) {
          // TODO: return a message to the user
          console.log(error);
        });
      }
      $("#slide-cart").addClass("show-cart");

  });

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
