@include('layouts.header')

<header class="header clearfix">
    <div class="header-inner">
        @include('layouts.menu')
        <div class="overlay"></div>
    </div>
</header>


<div class="wrapper pt-0">
    <div class="breadcrumb-pt breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">checkout</li>
                            </ol>
                        </nav>
                        <h1 class="title_text">Secure Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="refund-main-wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-12">
                    <div class="cart-content">
                        <div class="full-width">
                            <div class="cart_headtte14m item-setting-top">
                                <span class="color_bb"><i class="feather-info"></i></span>
                                <h4>Billing Details</h4>
                            </div>
                            <div class="checkout-billing-dt">
                                <div class="main-form">
                                    <div class="its_your item-setting-top">
                                        <i class="fas fa-flag mr-3"></i>
                                        <span class="bagde-text">If you'd like to update your billing details,
                                            please re-submit your <a>tax
                                                information</a>.</span>
                                    </div>
                                    <div class="billing-details">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="t-body mb-0">
                                                    Joginder Singh <br>
                                                    #0000 Street No. 00, Ward No. 0, Phase 0, Shahid Karnail Singh
                                                    Nagar, Near Pakhowal Road <br>
                                                    Ludhiana, Punjab, 141013 <br>
                                                    India <br>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="gst-number-dt rrmt-30">
                                                    <h4 class="gst-title">GSTIN:</h4>
                                                    <div class="gst-number">
                                                        <span>Not provided</span>
                                                        <button class="add-gst-btn btn-hover" data-bs-toggle="modal"
                                                            data-bs-target="#GSTINModal">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="full-width mt-30">
                            <div class="cart_headtte14m item-setting-top">
                                <span class="color_bb"><i class="feather-credit-card"></i></span>
                                <h4>Select Payment Method</h4>
                            </div>
                            <div class="item-cart-list">
                                <div class="main-form">
                                    <div class="payment-details">
                                        <div class="payment-checkout-tabs">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="pill"
                                                        href="#credit-debit" role="tab" aria-selected="true"><i
                                                            class="fas fa-credit-card d-block mb-2"></i>Credit /
                                                        Debit Cards</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="pill" href="#paypal" role="tab"
                                                        aria-selected="false"><i
                                                            class="fab fa-cc-paypal d-block mb-2"></i>Paypal</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="pill" href="#micko-credits"
                                                        role="tab" aria-selected="false"><i
                                                            class="fas fa-money-check-alt d-block mb-2"></i>Micko
                                                        Credit</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active show" id="credit-debit"
                                                    role="tabpanel">
                                                    <div class="payment-method-content">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form_group mt-30">
                                                                    <label class="label25">Card Number*</label>
                                                                    <input class="form_input_1" type="text"
                                                                        placeholder="" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form_group mt-30">
                                                                    <label class="label25">Holder Number*</label>
                                                                    <input class="form_input_1" type="text"
                                                                        placeholder="" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form_group mt-30">
                                                                    <label class="label25">Month*</label>
                                                                    <select class="selectpicker" title="Year"
                                                                        data-size="12">
                                                                        <option value="january">January</option>
                                                                        <option value="february">February</option>
                                                                        <option value="march">March</option>
                                                                        <option value="april">April</option>
                                                                        <option value="may">May</option>
                                                                        <option value="june">June</option>
                                                                        <option value="july">July</option>
                                                                        <option value="august">August</option>
                                                                        <option value="september">September</option>
                                                                        <option value="october">October</option>
                                                                        <option value="november">November</option>
                                                                        <option value="december">December</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form_group mt-30">
                                                                    <label class="label25">Year*</label>
                                                                    <select class="selectpicker" title="Month"
                                                                        data-size="12">
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <option value="2026">2026</option>
                                                                        <option value="2027">2027</option>
                                                                        <option value="2028">2028</option>
                                                                        <option value="2029">2029</option>
                                                                        <option value="2030">2030</option>
                                                                        <option value="2031">2031</option>
                                                                        <option value="2032">2032</option>
                                                                        <option value="2033">2033</option>
                                                                        <option value="2034">2034</option>
                                                                        <option value="2035">2035</option>
                                                                        <option value="2036">2036</option>
                                                                        <option value="2037">2037</option>
                                                                        <option value="2038">2038</option>
                                                                        <option value="2039">2039</option>
                                                                        <option value="2040">2040</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form_group mt-30">
                                                                    <label class="label25">Cvv*</label>
                                                                    <input class="form_input_1" type="text"
                                                                        placeholder="" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="agree_checkbox">
                                                            <input type="checkbox" id="save_check">
                                                            <label for="save_check">Save card for next time</label>
                                                        </div>
                                                    </div>
                                                    <div class="order-summary-left-dt">
                                                        <div class="order-accordion-list">
                                                            <div class="order-accordion-card">
                                                                <div class="order-accordion-header">
                                                                    <button class="order-collapse-btn collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#CollapseOrder1">Your
                                                                        Orders</button>
                                                                    <div class="total-price font-weight-bold">৳40.56
                                                                    </div>
                                                                </div>
                                                                <div class="collapse" id="CollapseOrder1">
                                                                    <div class="order-accordion-card-body">
                                                                        <div class="summary-list">
                                                                            <div class="summary-quote-entry">
                                                                                <div
                                                                                    class="summary-quote-entry__description">
                                                                                    <span>Cursus - LMS & Online
                                                                                        Courses Marketplace HTML
                                                                                        Template</span>
                                                                                    <span
                                                                                        class="text-label-badge">Regular
                                                                                        License</span>
                                                                                </div>
                                                                                <div class="summary-quote-entry__price">
                                                                                    <span>৳18.00</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="summary-quote-entry">
                                                                                <div
                                                                                    class="summary-quote-entry__description">
                                                                                    <span>Complete Python Bootcamp:
                                                                                        Go from zero to hero in
                                                                                        Python 3</span>
                                                                                </div>
                                                                                <div class="summary-quote-entry__price">
                                                                                    <span>৳18.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="summery-taxes-left-dt">
                                                            <div class="summery-taxes-list-dt">
                                                                <div class="summary-quote-entry">
                                                                    <div class="summary-quote-entry__description">
                                                                        <span>Handling Fee :</span>
                                                                    </div>
                                                                    <div class="summary-quote-entry__price">
                                                                        <span>৳0.00</span>
                                                                    </div>
                                                                </div>
                                                                <div class="summary-quote-entry">
                                                                    <div class="summary-quote-entry__description">
                                                                        <span>GST :</span>
                                                                    </div>
                                                                    <div class="summary-quote-entry__price">
                                                                        <span>৳4.56</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="summary-quote__total">
                                                                <div class="summary-quote__total-title">
                                                                    <h4 class="total-heading mb-0 font-weight-bold">
                                                                        Total:
                                                                    </h4>
                                                                </div>
                                                                <div class="summary-quote__total-price">
                                                                    <h4 class="total-heading mb-0">
                                                                        <b class="total-currency">৳40.56</b>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-btns">
                                                        <button class="main-save-btn ms-auto color btn-hover">Make
                                                            Payment</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="paypal" role="tabpanel">
                                                    <div class="payment-method-content">
                                                        <div class="e-fieldset__body mt-30">
                                                            <p class="t-body">
                                                                After payment via PayPal's secure checkout, we will
                                                                send you a link to download your files.
                                                            </p>
                                                            <div class="media">
                                                                <div class="media__item">
                                                                    <p class="t-body mr-3 mb-0">PayPal accepts</p>
                                                                </div>
                                                                <div class="media__body">
                                                                    <ul class="financial-institutes">
                                                                        <li class="financial-card__logo">
                                                                            <img alt="Visa" title="Visa"
                                                                                src="images/pyicon-1.svg">
                                                                        </li>
                                                                        <li class="financial-card__logo">
                                                                            <img alt="MasterCard" title="MasterCard"
                                                                                src="images/pyicon-2.svg">
                                                                        </li>
                                                                        <li class="financial-card__logo">
                                                                            <img alt="American Express"
                                                                                title="American Express"
                                                                                src="images/pyicon-3.svg">
                                                                        </li>
                                                                        <li class="financial-card__logo">
                                                                            <img alt="Discover" title="Discover"
                                                                                src="images/pyicon-4.svg">
                                                                        </li>
                                                                        <li class="financial-card__logo">
                                                                            <img alt="China UnionPay"
                                                                                title="China UnionPay"
                                                                                src="images/pyicon-5.svg">
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="order-summary-left-dt">
                                                        <div class="order-accordion-list">
                                                            <div class="order-accordion-card">
                                                                <div class="order-accordion-header">
                                                                    <button class="order-collapse-btn collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#CollapseOrder2">Your
                                                                        Orders</button>
                                                                    <div class="total-price font-weight-bold">৳40.56
                                                                    </div>
                                                                </div>
                                                                <div class="collapse" id="CollapseOrder2">
                                                                    <div class="order-accordion-card-body">
                                                                        <div class="summary-list">
                                                                            <div class="summary-quote-entry">
                                                                                <div
                                                                                    class="summary-quote-entry__description">
                                                                                    <span>Cursus - LMS & Online
                                                                                        Courses Marketplace HTML
                                                                                        Template</span>
                                                                                    <span
                                                                                        class="text-label-badge">Regular
                                                                                        License</span>
                                                                                </div>
                                                                                <div class="summary-quote-entry__price">
                                                                                    <span>৳18.00</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="summary-quote-entry">
                                                                                <div
                                                                                    class="summary-quote-entry__description">
                                                                                    <span>Complete Python Bootcamp:
                                                                                        Go from zero to hero in
                                                                                        Python 3</span>
                                                                                </div>
                                                                                <div class="summary-quote-entry__price">
                                                                                    <span>৳18.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="summery-taxes-left-dt">
                                                            <div class="summery-taxes-list-dt">
                                                                <div class="summary-quote-entry">
                                                                    <div class="summary-quote-entry__description">
                                                                        <span>Handling Fee :</span>
                                                                    </div>
                                                                    <div class="summary-quote-entry__price">
                                                                        <span>৳0.00</span>
                                                                    </div>
                                                                </div>
                                                                <div class="summary-quote-entry">
                                                                    <div class="summary-quote-entry__description">
                                                                        <span>GST :</span>
                                                                    </div>
                                                                    <div class="summary-quote-entry__price">
                                                                        <span>৳4.56</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="summary-quote__total">
                                                                <div class="summary-quote__total-title">
                                                                    <h4 class="total-heading mb-0 font-weight-bold">
                                                                        Total:
                                                                    </h4>
                                                                </div>
                                                                <div class="summary-quote__total-price">
                                                                    <h4 class="total-heading mb-0">
                                                                        <b class="total-currency">৳40.56</b>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-btns">
                                                        <button class="main-save-btn ms-auto color btn-hover">Checkout
                                                            with PayPal</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="micko-credits" role="tabpanel">
                                                    <div class="payment-method-content">
                                                        <div class="e-fieldset__body mt-30">
                                                            <p class="t-body">
                                                                You currently have $1146.78 in earnings.
                                                            </p>
                                                            <div class="agree_checkbox mt-2">
                                                                <input type="checkbox" id="credit_use_check">
                                                                <label for="credit_use_check">Use $40.56 from my
                                                                    earnings for this purchase.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="order-summary-left-dt">
                                                        <div class="order-accordion-list">
                                                            <div class="order-accordion-card">
                                                                <div class="order-accordion-header">
                                                                    <button class="order-collapse-btn collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#CollapseOrder3">Your
                                                                        Orders</button>
                                                                    <div class="total-price font-weight-bold">$40.56
                                                                    </div>
                                                                </div>
                                                                <div class="collapse" id="CollapseOrder3">
                                                                    <div class="order-accordion-card-body">
                                                                        <div class="summary-list">
                                                                            <div class="summary-quote-entry">
                                                                                <div
                                                                                    class="summary-quote-entry__description">
                                                                                    <span>Cursus - LMS & Online
                                                                                        Courses Marketplace HTML
                                                                                        Template</span>
                                                                                    <span
                                                                                        class="text-label-badge">Regular
                                                                                        License</span>
                                                                                </div>
                                                                                <div class="summary-quote-entry__price">
                                                                                    <span>$18.00</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="summary-quote-entry">
                                                                                <div
                                                                                    class="summary-quote-entry__description">
                                                                                    <span>Complete Python Bootcamp:
                                                                                        Go from zero to hero in
                                                                                        Python 3</span>
                                                                                </div>
                                                                                <div class="summary-quote-entry__price">
                                                                                    <span>৳18.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="summery-taxes-left-dt">
                                                            <div class="summery-taxes-list-dt">
                                                                <div class="summary-quote-entry">
                                                                    <div class="summary-quote-entry__description">
                                                                        <span>Handling Fee :</span>
                                                                    </div>
                                                                    <div class="summary-quote-entry__price">
                                                                        <span>৳0.00</span>
                                                                    </div>
                                                                </div>
                                                                <div class="summary-quote-entry">
                                                                    <div class="summary-quote-entry__description">
                                                                        <span>GST :</span>
                                                                    </div>
                                                                    <div class="summary-quote-entry__price">
                                                                        <span>৳4.56</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="summary-quote__total">
                                                                <div class="summary-quote__total-title">
                                                                    <h4 class="total-heading mb-0 font-weight-bold">
                                                                        Total:
                                                                    </h4>
                                                                </div>
                                                                <div class="summary-quote__total-price">
                                                                    <h4 class="total-heading mb-0">
                                                                        <b class="total-currency">৳40.56</b>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-btns">
                                                        <button class="main-save-btn ms-auto color btn-hover">Add
                                                            Credit and Checkout</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="event-card rrmt-30">
                        <div class="order-summary-title">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="order-summary-right-list">
                            <div class="order-summary__entry">
                                <div class="order-summary__description text-hidden">
                                    Cursus - LMS & Online Courses Marketplace HTML Template
                                </div>
                                <div class="order-summary-entry__price">
                                    <span>৳ 18.00</span>
                                </div>
                            </div>
                            <div class="order-summary__entry">
                                <div class="order-summary__description text-hidden">
                                    Complete Python Bootcamp: Go from zero to hero in Python 3
                                </div>
                                <div class="order-summary__price">
                                    <span>৳ 18.00</span>
                                </div>
                            </div>
                            <div class="order-summary__list">
                                <div class="order-summary__entry">
                                    <div class="order-summary__description text-hidden">Handling Fee:</div>
                                    <div class="order-summary__price">৳ 0.00</div>
                                </div>
                                <div class="order-summary__entry">
                                    <div class="order-summary__description text-hidden">
                                        GST:
                                        <a href="#">Learn more</a>
                                    </div>
                                    <div class="order-summary__price">৳ 4.56</div>
                                </div>
                            </div>
                            <div class="order-summary-list__total">
                                <div class="order-summary__entry">
                                    <div class="order-summary__description text-hidden">
                                        <h4 class="total-heading font-weight-bold mb-0">Grand Total:</h4>
                                    </div>
                                    <div class="order-summary__price">
                                        <h4 class="total-heading mb-0">
                                            <b class="total-currency">৳ 40.56</b>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="secure-text mt-30">
                        <p><i class="fas fa-lock me-2"></i>Secure checkout</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')