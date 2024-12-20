const slider = document.getElementById("slider");
const sliderItems = document.getElementById("slides");
const prev = document.getElementById("prev");
const next = document.getElementById("next");
const paginationContainer = document.getElementById("pagination");
const slides = sliderItems.querySelectorAll(".slide");
const slidesLength = slides.length;

let index = 0;
let isDragging = false;
let startPos = 0;
let currentTranslate = 0;
let prevTranslate = 0;
let animationID;
let currentIndex = 0;

// Clone first and last slide for infinite loop effect
const firstSlideClone = slides[0].cloneNode(true);
const lastSlideClone = slides[slidesLength - 1].cloneNode(true);
sliderItems.appendChild(firstSlideClone);
sliderItems.insertBefore(lastSlideClone, slides[0]);

// Pagination setup
function createPagination() {
  for (let i = 0; i < slidesLength; i++) {
    const btn = document.createElement("button");
    btn.setAttribute('aria-label', 'Pagination button');
    btn.classList.add("pagination-btn");
    btn.dataset.index = i;
    btn.addEventListener("click", () => {
      goToSlide(i);
    });
    paginationContainer.appendChild(btn);
  }
  updatePagination();
}

function updatePagination() {
  const paginationBtns = document.querySelectorAll(".pagination-btn");
  paginationBtns.forEach((btn, i) => {
    btn.classList.toggle("active-slide", i === index);
  });
}

function goToSlide(i) {
  index = i;
  currentTranslate = -index * slider.offsetWidth;
  prevTranslate = currentTranslate;
  setSliderPosition();
  updatePagination();
}

// Drag functionality
function touchStart(index) {
  return function (event) {
    currentIndex = index;
    startPos = getPositionX(event);
    isDragging = true;
    animationID = requestAnimationFrame(animation);
    sliderItems.classList.add("grabbing");
  };
}

function touchEnd() {
  isDragging = false;
  cancelAnimationFrame(animationID);
  const movedBy = currentTranslate - prevTranslate;

  if (movedBy < -100 && index < slidesLength - 1) index++;
  if (movedBy > 100 && index > 0) index--;

  setPositionByIndex();
  sliderItems.classList.remove("grabbing");
}

function touchMove(event) {
  if (isDragging) {
    const currentPosition = getPositionX(event);
    currentTranslate = prevTranslate + currentPosition - startPos;
  }
}

function getPositionX(event) {
  return event.type.includes("mouse") ? event.pageX : event.touches[0].clientX;
}

function animation() {
  setSliderPosition();
  if (isDragging) requestAnimationFrame(animation);
}

function setSliderPosition() {
  sliderItems.style.transform = `translateX(${currentTranslate}px)`;
}

function setPositionByIndex() {
  currentTranslate = index * -slider.offsetWidth;
  prevTranslate = currentTranslate;
  setSliderPosition();
  updatePagination();
}

// Infinite loop handling
function checkIndex() {
  if (index <= -1) {
    sliderItems.classList.add("notransition");
    index = slidesLength - 1;
    currentTranslate = -index * slider.offsetWidth;
    prevTranslate = currentTranslate;
    setSliderPosition();
    requestAnimationFrame(() => sliderItems.classList.remove("notransition"));
  } else if (index >= slidesLength) {
    sliderItems.classList.add("notransition");
    index = 0;
    currentTranslate = -index * slider.offsetWidth;
    prevTranslate = currentTranslate;
    setSliderPosition();
    requestAnimationFrame(() => sliderItems.classList.remove("notransition"));
  }
}

// Button functionality
prev.addEventListener("click", () => {
  if (index > 0) {
    index--;
    setPositionByIndex();
  }
});

next.addEventListener("click", () => {
  if (index < slidesLength - 1) {
    index++;
    setPositionByIndex();
  }
});

// Touch events
sliderItems.addEventListener("touchstart", touchStart(index));
sliderItems.addEventListener("touchend", touchEnd);
sliderItems.addEventListener("touchmove", touchMove);

// Mouse events
sliderItems.addEventListener("mousedown", touchStart(index));
sliderItems.addEventListener("mouseup", touchEnd);
sliderItems.addEventListener("mouseleave", touchEnd);
sliderItems.addEventListener("mousemove", touchMove);

// Initialize
createPagination();
goToSlide(0);




//booking dates




const order_processing_time = document.querySelector(
  "#order_processing_time_input"
).value;
let disbaled_days = 0;
disbaled_days = order_processing_time / 24;
if (disbaled_days < 1) {
  disbaled_days = 0;
}

const dateSelect = document.querySelector("#booking-dates");

const messageElement = document.querySelector(".currentDateMessage");
messageElement.style.display = "none";
document.querySelector(".inputController").appendChild(messageElement);

const today = new Date();

for (let i = 0; i < 60; i++) {
  const date = new Date(today);
  date.setDate(date.getDate() + i);

  const formattedDate = formatDate(date);

  const option = document.createElement("option");
  option.value = formattedDate;
  option.textContent = formattedDate;
  if (i < disbaled_days) {
    option.disabled = true; // Add disabled attribute
  } else {
    option.disabled = false; // Add disabled attribute
  }
  dateSelect.appendChild(option);
}

dateSelect.addEventListener("change", function () {
  const selectedDate = new Date(dateSelect.value);
  if (isSameDate(selectedDate, today)) {
    messageElement.style.display = "block";
  } else {
    messageElement.style.display = "none";
  }
});


function formatDate(date) {
  const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  const year = date.getFullYear();
  const month = months[date.getMonth()];
  const day = padZero(date.getDate());

  return `${day} ${month} ${year}`;
}

function padZero(num) {
  return num < 10 ? "0" + num : num;
}

function isSameDate(date1, date2) {
  return (
    date1.getFullYear() === date2.getFullYear() &&
    date1.getMonth() === date2.getMonth() &&
    date1.getDate() === date2.getDate()
  );
}

document.querySelector(".reviews").addEventListener("click", function () {
  document
    .querySelector(".rating-header")
    .scrollIntoView({ behaviour: "smooth" });
});

document.querySelector("#go-inclusion").addEventListener("click", function () {
  document
    .querySelector(".inclusion-exclusion-holder")
    .scrollIntoView({ behavior: "smooth" });
});

function selectCityBlocker() {
  document
    .querySelector(".inputController")
    .scrollIntoView({ behavior: "smooth" });
}

function moveNext() {
  const slider = document.querySelector(".similar-products-slider");
  slider.scrollLeft += slider.offsetWidth;
}
function movePrev() {
  const slider = document.querySelector(".similar-products-slider");
  slider.scrollLeft -= slider.offsetWidth;
}

const reviewSlider = document.querySelector(".reviews-slider");

function reviewRightClick(){
    reviewSlider.scrollLeft += reviewSlider.offsetWidth;
}

function reviewLeftClick(){
    reviewSlider.scrollLeft -= reviewSlider.offsetWidth;
}

function activeInclusion(e) {
  if (e === `inclusion`) {
    document.querySelector(".inclusion").classList.add("active");
    document.querySelector(".exclusion").classList.remove("active");
    document.querySelector(".inclusion-content").style.display = "block";
    document.querySelector(".exclusion-content").style.display = "none";
  } else {
    document.querySelector(".inclusion").classList.remove("active");
    document.querySelector(".exclusion").classList.add("active");
    document.querySelector(".inclusion-content").style.display = "none";
    document.querySelector(".exclusion-content").style.display = "block";
  }
}

function policiesHandler(e) {
  const faq = document.querySelector(".faq-btn");
  const info = document.querySelector(".info-btn");
  const cancellation = document.querySelector(".cancellation-policy-btn");
  const faqContainer = document.querySelector(".faq-container");
  const infoContainer = document.querySelector(".info-container");
  const cancellationContainer = document.querySelector(
    ".cancellation-container"
  );
  if (e === "faq") {
    faq.classList.add("active-policy");
    info.classList.remove("active-policy");
    cancellation.classList.remove("active-policy");
    faqContainer.classList.add("block");
    infoContainer.classList.remove("block");
    cancellationContainer.classList.remove("block");
  } else if (e === "info") {
    faq.classList.remove("active-policy");
    info.classList.add("active-policy");
    cancellation.classList.remove("active-policy");
    faqContainer.style.display = "none";
    faqContainer.classList.remove("block");
    infoContainer.classList.add("block");
    cancellationContainer.classList.remove("block");
  } else {
    faq.classList.remove("active-policy");
    info.classList.remove("active-policy");
    cancellation.classList.add("active-policy");
    faqContainer.style.display = "none";
    faqContainer.classList.remove("block");
    infoContainer.classList.remove("block");
    cancellationContainer.classList.add("block");
  }
}



 const targetSection = document.querySelector(".stick-bottom");
 const fixedController = document.querySelector(".fixed-bottom");
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) {
        performTask();
      }else{
          resetTask();
      }
    });
  }, { threshold: 0 });

  observer.observe(targetSection);

  function performTask() {
    fixedController.style.display = "flex";
  }
  
  function resetTask(){
     fixedController.style.display = "none";
  }
  
  
  
  const targetPrice = document.querySelector(".priceContain");
  const mobilePrice = document.querySelector(".floating-price");
  
  const observer2 =  new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) {
        viewMobilePrice();
      }else{
          viewMobileReset();
      }
    });
  }, { threshold: 0 });
  
  observer2.observe(targetPrice);
  
  function viewMobilePrice(){
      mobilePrice.classList.add("view-mobilePrice");
  }

  function viewMobileReset(){
      mobilePrice.classList.remove("view-mobilePrice");
  }

try {
  $("#change").click(function () {
    var changenumber = $("#changenumber").val();

    $.ajax({
      type: "POST",
      url: "https://www.7eventzz.com/ajax/ajax.php",
      data: { changenumber: changenumber, action: "changenumber" },
      success: function (response) {
        if (response == "CHAGNENUMBER") {
          $(".mobileno_correct").html("Number Changed Sucessfully.");
        }
      },
    });
  });
} catch (err) {}

$("#booking-dates").change(function () {
  var selectedValue = $(this).val();
  var secondOptionValue = $(this).find("option:nth-child(2)").val();
  if (selectedValue === secondOptionValue) {
    $("#time-slots2").css("display", "none");
    $("#time-slots2").prop("selectedIndex", 0);
    $("#time-slots1").css("display", "block");
  } else {
    $("#time-slots2").css("display", "block");
    $("#time-slots1").css("display", "none");
    $("#time-slots1").prop("selectedIndex", 0);
  }
});

$("#general-btn").click(function () {
  $("#popular-btn").removeClass("active-addon");
  $(this).addClass("active-addon");
  $(".populardiv").css("display", "none");
  $(".generaldiv").css("display", "block");
});

$("#popular-btn").click(function () {
  $("#general-btn").removeClass("active-addon");
  $(this).addClass("active-addon");
  $(".generaldiv").css("display", "none");
  $(".populardiv").css("display", "block");
});

// $(".booknow-btn").click(function () {
//   let bookingDates = $("#booking-dates").val();
//   let timeSlots2 = "";
//   if ($("#time-slots2").val() != null) {
//     timeSlots2 = $("#time-slots2").val();
//   } else if ($("#time-slots1").val() != null) {
//     timeSlots2 = $("#time-slots1").val();
//   } else {
//     timeSlots2 = "";
//   }

//   let product_id = $("#product_id").val();
//   let city_id = $("#city_id").val();

//   if (!bookingDates && !timeSlots2 && !city_id) {
//     selectCityBlocker();
//     $("#validation-text").html("Please select city, date and time.");
//     $(".btn").addClass("wrong-input");
//   } else if (!bookingDates && !timeSlots2) {
//     selectCityBlocker();
//     $("#validation-text").html("Please select date and time.");
//     $("select[name='booking-dates']").addClass("wrong-input");
//     $("select[name='time-slots']").addClass("wrong-input");
//   } else if (!bookingDates) {
//     selectCityBlocker();
//     $("#validation-text").html("Please select date.");
//     $("select[name='time-slots']").removeClass("wrong-input");
//     $("select[name='booking-dates']").addClass("wrong-input");
//   } else if (!timeSlots2) {
//     selectCityBlocker();
//     $("#validation-text").html("Please select time.");
//     $("select[name='booking-dates']").removeClass("wrong-input");
//     $("select[name='time-slots']").addClass("wrong-input");
//   } else if (!city_id) {
//     selectCityBlocker();
//     $("#validation-text").html("Please select city.");
//     $("button.btn").addClass("wrong-input");
//   } else {
//     $("#validation-text").html("");
//     $(".btn").removeClass("wrong-input");
//   }

//   if (bookingDates && timeSlots2 && product_id && city_id) {
//     $.post(
//       "https://www.7eventzz.com/ajaxcart/ajaxcart.php",
//       {
//         key1: timeSlots2,
//         key2: bookingDates,
//         key3: product_id,
//         key4: city_id,
//         key5: 1,
//         action: "product",
//       },
//       function (data) {}
//     );
//     viewAddon();
//   }
// });

$(".add-addon-btn").click(function () {
  let addon_count_with_price = 0;
  var countitem = $(this).closest("div").find("span.addon-count").text();
  $(this)
    .closest("div")
    .find("span.addon-count")
    .text(parseInt(countitem) + 1);
  $(this).addClass("add-addon-added");
  $(this).data("custom-value2", parseInt(countitem) + 1);

  $(".add-addon-added").map(function (item) {
    addon_count_with_price +=
      parseInt($(this).data("custom-value")) *
      parseInt($(this).data("custom-value2"));
    console.log(addon_count_with_price);
    $("#total_addon_price").html(
      "<b>Addon Price:</b> â‚¹" + addon_count_with_price
    );
    var total_price = parseInt($("#base_price").val()) + addon_count_with_price;
    $("#total_price").html("<b>Total Price:</b> â‚¹" + total_price);
    var total_items = parseInt(item) + parseInt(1);
    $("#total_addon_number").html("<b>Total Addons:</b> " + total_items);
  });
});

$(".plus").click(function () {
  let addon_count_with_price = 0;
  var countitem = $(this).closest("div").find("span.addon-count").text();
  $(this)
    .closest("div")
    .find("span.addon-count")
    .text(parseInt(countitem) + 1);
  $(this).closest("div").next("button").addClass("add-addon-added");
  $(this)
    .closest("div")
    .next("button")
    .data("custom-value2", parseInt(countitem) + 1);

  $(".add-addon-added").map(function (item) {
    addon_count_with_price +=
      parseInt($(this).data("custom-value")) *
      parseInt($(this).data("custom-value2"));
    console.log(addon_count_with_price);
    $("#total_addon_price").html(
      "<b>Addon Price:</b> â‚¹" + addon_count_with_price
    );
    var total_price = parseInt($("#base_price").val()) + addon_count_with_price;
    $("#total_price").html("<b>Total Price:</b> â‚¹" + total_price);
    var total_items = parseInt(item) + parseInt(1);
    $("#total_addon_number").html("<b>Total Addons:</b> " + total_items);
  });
});

$(".minus").click(function () {
  let addon_count_with_price = 0;
  var countitem = $(this).closest("div").find("span.addon-count").text();

  if (parseInt(countitem) == 0) {
    $(this).closest("div").next("button").removeClass("add-addon-added");
    $(this).closest("div").next("button").data("custom-value2", parseInt(0));
  }

  if (parseInt(countitem) > 0) {
    $(this)
      .closest("div")
      .find("span.addon-count")
      .text(parseInt(countitem) - 1);
    $(this)
      .closest("div")
      .next("button")
      .data("custom-value2", parseInt(countitem) - 1);
    if (parseInt($(this).closest("div").find("span.addon-count").text()) == 0) {
      $(this).closest("div").next("button").removeClass("add-addon-added");
      $(this).closest("div").next("button").data("custom-value2", parseInt(0));
      $("#total_addon_price").html("<b>Addon Price:</b> â‚¹0");
      var total_price = parseInt($("#base_price").val());
      $("#total_price").html("<b>Total Price:</b> â‚¹" + total_price);
    }
  }

  $(".add-addon-added").map(function (item) {
    addon_count_with_price +=
      parseInt($(this).data("custom-value")) *
      parseInt($(this).data("custom-value2"));
    console.log(addon_count_with_price);
    $("#total_addon_price").html(
      "<b>Addon Price:</b> â‚¹" + addon_count_with_price
    );
    var total_price = parseInt($("#base_price").val()) + addon_count_with_price;
    $("#total_price").html("<b>Total Price:</b> â‚¹" + total_price);
    var total_items = parseInt(item) + parseInt(1);
    $("#total_addon_number").html("<b>Total Addons:</b> " + total_items);
  });
});

$(".proceed-btn").click(function () {
  let addon_ids = "";
  let addon_quantity = "";
  $(".add-addon-added").map(function () {
    addon_ids += $(this).data("custom-value3") + ", ";
    addon_quantity += $(this).data("custom-value2") + ", ";
  });
  console.log(addon_ids);
  console.log(addon_quantity);
  $.post(
    "https://www.7eventzz.com/ajaxcart/ajaxcart.php",
    { key6: addon_ids, key7: addon_quantity, action: "cart" },
    function (data) {
      if (data == "ADDONADDED") {
        window.location = "https://www.7eventzz.com/cart";
      }
    }
  );
});

$(".skip-btn").click(function () {
  $.post(
    "https://www.7eventzz.com/ajax/ajax.php",
    { action: "deleteaddon" },
    function (data) {
      //header("Location = ".SITE_URL."cart");
      console.log(data);
      if (data == "DELETEDADDON") {
        window.location = "https://www.7eventzz.com/cart";
      }
    }
  );
});