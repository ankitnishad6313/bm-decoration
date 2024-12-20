


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>7eventzz Checkout</title>
    <link rel="stylesheet" href="assets/css/checkout1.css" />
    <link rel="canonical" href="https://www.7eventzz.com/checkout">
    <style>
        #razor_img, #payu_img{
    height:auto;
    width: 100px;
    }
    .pay_options{
        width: 100%;
        display: flex;
        flex-direction: column;
        /*justify-content: space-between;*/
        gap: 1rem;
        /*padding: 5px;*/
    }
    
    .pay_options > h2{
        font: 600 2.5rem var(--bold);
        color: #222222;
    }
    .pay_options  label{
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        gap: 10px;
        transition: all ease .5s;
    }
    
    
    .modalLayout{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 111;
        height: 100vh;
        width: 100vw;
    }
    
    .modal{
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(0,0,0,0.5);
        height: 100%;
        width: 100%;
    }
    
    .pay_options{
        position: fixed;
        /*top: 50%;*/
        left: 50%;
        transform: translate(-50%, -50%);
        height: auto ;
        max-width: 40rem;
        width: 100%;
        background: #fff;
        border-radius: 1rem;
        padding: 3rem 2rem;
        animation: fadeInBox .3s ease 0s 1 forwards ;
    }
    
    
    @keyframes fadeInBox{
        from{
            top: 150%;
        }
        to{
            top: 50%;
        }
    }
    
    .pay_options > svg{
        position: absolute;
        top: 5%;
        right: 3%;
        cursor: pointer;
    }
    
    .payment_holder{
        display: flex;
        align-items: center;
        gap: 1rem
    }
    
    .visibleOption{
        display: block !important;
    }
    
    
    .pay_options > h2 + .paymentText{
        margin-bottom: 2rem;
    }
    .paymentText{
        display: flex;
        align-items: center;
        gap: .5rem ;
        font: 500 1.4rem var(--medium);
    }
    
    #add2{
         position: relative;
    padding: 1.5rem;
    margin-top: 1rem;
    display: block;
    width: 100%;
    background-color: var(--website);
    color: var(--white);
    font: 500 1.7rem var(--medium);
    text-align: center;
    cursor: pointer;
    border: none;
    border-radius: 1rem;
    }
    
     #add2 + .paymentText{
         justify-content: center;
     }
    
    </style>
    <!-- Event snippet for Website traffic conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-428667925/Px7DCJCLj_UBEJXos8wB'});
</script>
  </head>
  <body>
    <header class="header">
      <div class="navbar">
        <a href="https://www.7eventzz.com/cart" class="checkout-text">
          <img src="assets/icons/back-icon.svg" alt="back icon" height="25" width="25" />
          Address <span>(2 / 3)</span>
        </a>
        <div>
          <p class="navbar-text">
            <img src="assets/icons/assistant.webp" alt="assistant img" height="25" width="25" />
            Need Asistance?
          </p>
          <a href="https://wa.me/7450960060" class="whatsapp-btn">
            <img src="assets/icons/whatsapp.svg" alt="whatsapp icon" height="20" width="20" />
            Whatsapp
          </a>
          <a href="tel:7450960060" class="whatsapp-btn">
            <img src="assets/icons/phone-icon.svg" alt="phone icon" height="20" width="20" />
            Call
          </a>
        </div>
      </div>
    </header>
    <main>
      <form  method="post" class="container" id="checkoutForm">
        <div class="input-fields">
          <div class="steps-container">
            <p>Steps:</p>
            <div class="steps-count">
              <div class="steps-ruler">
                <div class="filler"></div>
              </div>
              <div class="step-box">
                <span class="active-step"></span>
                <p>Cart</p>
              </div>
              <div class="step-box">
                <span class="active-step"></span>
                <p>Address</p>
              </div>
              <div class="step-box">
                <span></span>
                <p>Payment</p>
              </div>
            </div>
          </div>
          <div class="checkout-fields">
            <h2>Checkout</h2>
            <p>Note: Coupon Code Not Applicable for 50% Advance Payment</p>
                                
            <div class="input_wrapper">
              <label for="username">Name <span>*</span></label>
              <input type="text" placeholder="Enter name" required id="username" name="name" value="Ankit Kumar" />
              <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
              <p class="hidden">Invalid Name</p>
            </div>
            <div class="input_wrapper">
              <label for="email_id">Email <span>*</span></label>
              <input type="text" placeholder="Enter email" required id="email_id" name="email_id" value=""  />
              <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
              <p class="hidden">Invalid Email</p>
            </div>
            <div class="input_wrapper">
              <label for="address">Address <span>*</span></label>
              <textarea name="address" id="address" cols="30" rows="5" placeholder="Enter address" required ></textarea>
              <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
              <p class="hidden">Invalid Address</p>
            </div>
            <div class="input_wrapper">
              <label for="land_mark">Land Mark(If any)</label>
              <input type="text" placeholder="Enter landmark" id="land_mark" name="land_mark" value="" />
              <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
            </div>
            <div class="input_wrapper">
              <label for="pincode">Pincode <span>*</span></label>
              <input type="tel" placeholder="Enter pincode" required id="pincode" maxlength="6" name="pincode" value="" />
              <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
              <p class="hidden">Invalid Pincode</p>
            </div>
                        <div class="input_wrapper">
              <label for="city">City <span>*</span></label>
              <input type="text" placeholder="Enter city name" required id="city" name="city_name" value="" />
              <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
              <p class="hidden">Invalid City Name</p>
            </div>
            <div class="other-details">
              <div class="input_wrapper">
                <label for="occasion">Occasion <span>*</span></label>
                <select name="occasion" id="occasion" required>
                  <option value="">Select Decoration Type</option>
                                     <option value="1"  >Birthday</option>
                                      <option value="2"  >Anniversary</option>
                                      <option value="3"  >Baby Shower</option>
                                      <option value="4"  >Welcome</option>
                                      <option value="5"  >Bachelorette Party</option>
                                      <option value="6"  >Wedding Night</option>
                                      <option value="7"  >Others</option>
                                   </select>
              </div>
              <div class="input_wrapper">
                <label for="location">Location <span>*</span></label>
                <select name="location" id="location" required>
                  <option  value="">Select Decoration Location</option>
                                     <option value="1"  >Home</option>
                                      <option value="2"  >Building</option>
                                      <option value="3"  >Banquet Hall</option>
                                      <option value="4"  >Outdoor Garden</option>
                                      <option value="5"  >Terrace</option>
                                      <option value="6"  >Hotel Rooms</option>
                                      <option value="7"  >Other</option>
                                   </select>
              </div>
              <div class="input_wrapper">
                <label for="mobile_number">Mobile Number <span>*</span></label>
                <input type="tel" placeholder="Enter mobile number"  required id="mobile_number" maxlength="10" name="mobile_number" value="8853932392" />
                <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
                <p class="hidden">Invalid Number</p>
              </div>
              <div class="input_wrapper">
                <label for="alternative_number"
                  >Alternative Number(If Any)</label
                >
                <input type="tel" placeholder="Enter alternative number" id="alternative_number" maxlength="10" name="alternative_number" value="" />
                <img src="assets/icons/green-check-icon.svg" alt="green-check-icon" height="20" width="20" class="hidden" />
                <p class="hidden">Invalid Number</p>
              </div>
            </div>
                </div>
        </div>
        <div class="checkout-payment">
          
          <div class="order-details">
              <a href="https://www.7eventzz.com/cart" class="goto-cart"><img src="https://www.7eventzz.com/assets/icons/back-icon.svg" alt="back icon" height="25" width="25">Go To Cart</a>
            <h2>
              Order Details
              <img src="assets/icons/order-details-icon.svg" alt="Order details icon" height="25" width="25" />
            </h2>
            
                            <div class="all-details">
              <div class="img-holder">
                                <img src="https://www.7eventzz.com/productsicon/b37e3729ccb3a1b55f8b9ad638b4c28c1715159480.webp" alt="product small image" height="70" width="70" />  
                              </div>
              <div class="list-details">
                <h4>Simple Hall Decoration</h4>
                                <p>
                  <img src="assets/icons/calendar-icon.svg" alt="calendar icon" height="20" width="20" />&nbsp;12 Nov 2024                </p>
                <p>
                  <img src="assets/icons/clock-icon.svg" alt="clock icon" height="20" width="20" />&nbsp; 08:00 PM - 10:00 PM                </p>
                                <p>
                  <img src="assets/icons/credit-card.svg" alt="credit card" height="20" width="20" />&nbsp;Package Amount: ₹<span id="total_ammount1">1548</span>
                                  </p>
              </div>
            </div>
                          
            <div class="payment-controller-wrapper">
                 
                                    <div class="payment-options">
                    <p>Payment Options</p>
                    <div>
                      <input type="radio" id="half" name="payment_option" value="50" onchange="halfPrice()" />
                      <label for="half">50%</label>
                    </div>
                    <div>
                      <input type="radio" id="full" name="payment_option" value="100" checked onchange="fullPrice()" />
                      <label for="full">100%</label>
                    </div>
                  </div>
                <input type="hidden" name="base_total" id="base_total" value="1499" />
              <input type="hidden" name="addon_total" id="addon_total" value="0" />
              <input type="hidden" name="delivery_total" id="delivery_total" value="49" />
              <input type="hidden" name="selected_date" id="selected_date" value="12 Nov 2024" />
              <input type="hidden" name="selected_time_id" id="selected_time_id" value="267" />
              <input type="hidden" name="product_id" id="product_id" value="1" />
              <input type="hidden" name="product_quantity" id="product_quantity" value="1" />
              <input type="hidden" name="addon_id" id="addon_id" value="" />
              <input type="hidden" name="addon_quantity" id="addon_quantity" value="" />
            <input type="hidden" name="total_ammount4" id="total_ammount4" value="1548" />
            <input type="hidden" name="coupon_discount" id="coupon_discount" value="0" />
                                
                <div class="modalLayout">
                    <div class="modal" onclick="visiblePaymentOptions()"></div>
                    
                <div class="pay_options">
                    <svg xmlns="http://www.w3.org/2000/svg" height="26" onclick="visiblePaymentOptions()" viewBox="0 -960 960 960" width="26" fill="#5f6368"><path d="M256-227.69 227.69-256l224-224-224-224L256-732.31l224 224 224-224L732.31-704l-224 224 224 224L704-227.69l-224-224-224 224Z"/></svg>
                    <h2>Select Payment Option</h2>
                    <p class="paymentText"><img src="assets/icons/verified-payment.webp" alt="tick image" height="25" width="25" /> Trusted Payment Partners</p>
                    <div class="payment_holder">
                        
                    <label for="payment_option1">
                        <input type="radio" class="payment" name="payment_option1" id="payment_option_1" checked  value="1" >
                        <img id="razor_img" width="80" height="80" src="https://www.7eventzz.com/assets/images/razorpay.svg" alt="Razor Pay Payment" >
                    </label>
                    <label for="payment_option1" >
                        <input type="radio" class="payment" name="payment_option1" id="payment_option_2"  value="2">
                        <img id="payu_img" width="80" height="80" src="https://www.7eventzz.com/assets/images/payu.svg"  alt="PayU Payment">
                    </label>
                    </div>
                    <button  type="submit" name="submit" value="add2" id="add2">Proceed</button>
                    <p class="paymentText">If the first payment option fails, try the second</p>
                </div>
                </div>
                
                               <button type="button" name="submit"  value="add" class="prePayBtn" 
                >Proceed to Pay | ₹<span id="total_ammount">1548</span>
              </button>
                             <p>
                100% Safe & Secure Payments
                <img src="assets/icons/verified-payment.webp" alt="verified payments" height="15" width="15" />
              </p>
            </div>
          </div>
          <div class="payment-details">
            <h2>Price Details</h2>
            
            <p><span>Base Total</span> <b>₹ <span id="base_total_price">1499</span> </b></p>
            <p><span>Add On Total</span> <b>₹ <span id="addon_total_price">0</span></b></p>
            <p>
              <span>Convenience Charge</span>
              <b>₹ <span id="convenience_charge_price">49</span></b>
            </p>
            <p><span>Total Amount</span> <b>₹ <span id="total_ammount2">1548</span></b></p>
                        
             <p class="nocoupondiscount2"><b>Amount To Pay</b> <b>₹ <span id="total_ammount3">1548</span></b></p>
             <p class="amountdueclass" style="display:none;color:red;"><b>Amount Due</b> <b>₹ <span id="amountdue">1548</span></b></p>
            
                         
            
          </div>
        </div>
        </form>
    </main>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script defer src="assets/js/checkout31.js"></script>
    <script>
        
       
        
        const payModal = document.querySelector(".modalLayout");
        
         
        
        function visiblePaymentOptions(){
            payModal.classList.toggle("visibleOption");
        }
        
        const prePaymentBtn = document.querySelector(".prePayBtn") ;
        const cityInput = document.getElementById("city");
        
        prePaymentBtn.addEventListener('click', function(event){
            
            if(cityInput.value.trim() === ""){
                event.preventDefault();
                
                cityInput.focus();
            }else{
                visiblePaymentOptions();
            }
        })
        
       
        
    
        
    </script>
    

  </body>
</html>


