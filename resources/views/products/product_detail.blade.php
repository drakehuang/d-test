<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Cat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

        /*****************globals*************/
        body {
          font-family: 'open sans';
          overflow-x: hidden; }

        img {
          max-width: 100%; }

        .preview {
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-orient: vertical;
          -webkit-box-direction: normal;
          -webkit-flex-direction: column;
              -ms-flex-direction: column;
                  flex-direction: column; }
          @media screen and (max-width: 996px) {
            .preview {
              margin-bottom: 20px; } }

        .preview-pic {
          -webkit-box-flex: 1;
          -webkit-flex-grow: 1;
              -ms-flex-positive: 1;
                  flex-grow: 1; }

        .preview-thumbnail.nav-tabs {
          border: none;
          margin-top: 15px; }
          .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%; }
            .preview-thumbnail.nav-tabs li img {
              max-width: 100%;
              display: block; }
            .preview-thumbnail.nav-tabs li a {
              padding: 0;
              margin: 0; }
            .preview-thumbnail.nav-tabs li:last-of-type {
              margin-right: 0; }

        .tab-content {
          overflow: hidden; }
          .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
                    animation-name: opacity;
            -webkit-animation-duration: .3s;
                    animation-duration: .3s; }

        .card {
          margin-top: 50px;
          background: #eee;
          padding: 3em;
          line-height: 1.5em; }

        @media screen and (min-width: 997px) {
          .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex; } }

        .details {
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-orient: vertical;
          -webkit-box-direction: normal;
          -webkit-flex-direction: column;
              -ms-flex-direction: column;
                  flex-direction: column; }

        .colors {
          -webkit-box-flex: 1;
          -webkit-flex-grow: 1;
              -ms-flex-positive: 1;
                  flex-grow: 1; }

        .product-title, .price, .sizes, .colors {
          text-transform: UPPERCASE;
          font-weight: bold; }

        .checked, .price span {
          color: #ff9f1a; }

        .product-title, .rating, .product-description, .price, .vote, .sizes {
          margin-bottom: 15px; }

        .product-title {
          margin-top: 0; }

        .size {
          margin-right: 10px; }
          .size:first-of-type {
            margin-left: 40px; }

        .color {
          display: inline-block;
          vertical-align: middle;
          margin-right: 10px;
          height: 2em;
          width: 2em;
          border-radius: 2px; }
          .color:first-of-type {
            margin-left: 20px; }

        .add-to-cart, .like {
          background: #ff9f1a;
          padding: 1.2em 1.5em;
          border: none;
          text-transform: UPPERCASE;
          font-weight: bold;
          color: #fff;
          -webkit-transition: background .3s ease;
                  transition: background .3s ease; }
          .add-to-cart:hover, .like:hover {
            background: #b36800;
            color: #fff; }

        .not-available {
          text-align: center;
          line-height: 2em; }
          .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff; }

        .orange {
          background: #ff9f1a; }

        .green {
          background: #85ad00; }

        .blue {
          background: #0076ad; }

        .tooltip-inner {
          padding: 1.3em; }

        @-webkit-keyframes opacity {
          0% {
            opacity: 0;
            -webkit-transform: scale(3);
                    transform: scale(3); }
          100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1); } }

        @keyframes opacity {
          0% {
            opacity: 0;
            -webkit-transform: scale(3);
                    transform: scale(3); }
          100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1); } }

        /*# sourceMappingURL=style.css.map */

        /**
         * The CSS shown here will not be introduced in the Quickstart guide, but shows
         * how you can use CSS to style your Element's container.
         */
        .StripeElement {
          background-color: white;
          padding: 8px 12px;
          border-radius: 4px;
          border: 1px solid transparent;
          box-shadow: 0 1px 3px 0 #e6ebf1;
          -webkit-transition: box-shadow 150ms ease;
          transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
          box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
          border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
          background-color: #fefde5 !important;
        }

    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eCommerce Product Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  </head>

  <body>

    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                          <div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/400/252" /></div>
                          <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                          <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                          <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                          <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                          <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                          <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                          <li><a data-target="#pic-3" data-toggle="tab"><img src="http://servicetest01.pipimy.com.tw/product/41/image/2O559507c325c05.jpeg" /></a></li>
                          <li><a data-target="#pic-4" data-toggle="tab"><img src="http://servicetest01.pipimy.com.tw/product/70/image/JV559cf98fab194.jpeg" /></a></li>
                          <li><a data-target="#pic-5" data-toggle="tab"><img src="http://servicetest01.pipimy.com.tw/product/72/image/Ln559cfbbfd4e89.jpeg" /></a></li>
                        </ul>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">men's shoes fashion</h3>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">41 reviews</span>
                        </div>
                        <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
                        <h4 class="price">current price: <span>$180</span></h4>
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                        <h5 class="sizes">sizes:
                            <span class="size" data-toggle="tooltip" title="small">s</span>
                            <span class="size" data-toggle="tooltip" title="medium">m</span>
                            <span class="size" data-toggle="tooltip" title="large">l</span>
                            <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                        </h5>
                        <h5 class="colors">colors:
                            <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                            <span class="color green"></span>
                            <span class="color blue"></span>
                        </h5>
                        <div class="action">
                            <!-- <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                            <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> -->
                            <script src="https://js.stripe.com/v3/"></script>
                            <form action="/api/v1/order/checkout" method="post" id="payment-form">
                                <div class="form-row">

                                <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                                </div>

                                <button class="add-to-cart btn btn-default" type="submit">Submit Payment</button>
                            </form>
                            <!-- <form action="/api/v1/order/checkout" method="POST">
                              <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_w594dol6XoTYblnkp3XpjKGy"
                                data-amount="999"
                                data-name="Latticespace Limited"
                                data-description="Widget"
                                data-image="https://s3.amazonaws.com/stripe-uploads/acct_184SHKLYHNLj1ugsmerchant-icon-1463298316099-profile-picture.png"
                                data-locale="auto"
                                data-currency="hkd">
                              </script>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>

<script type="text/javascript">
    // Create a Stripe client
    var stripe = Stripe('pk_test_w594dol6XoTYblnkp3XpjKGy');

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    // Create an instance of the card Element
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

</body>
</html>
