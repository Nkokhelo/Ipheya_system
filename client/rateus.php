<?php
session_start();
if(isset($_SESSION['Client']))
{
  include('../core/init.php');
  include('includes/head.php');
  include('../core/logic.php');
  $logic =new  Logic();
  $email ='';
  $email=$_SESSION['Client'];
    $id='';
  $id= $logic->getByEmail($email)['client_id'];

}
else
{
  header("Location:../login.php");
}
?>
<body>
  <!-- <link rel="stylesheet" href="../assets/rating/css/style.min.css"> -->
  <link rel="stylesheet" href="../assets/rating/css/rating.min.css">
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-11 b">
                <h2>Rate our service</h2><hr class="bhr"/>
                <div class="col-xs-12" id="shop"></div>
            </div>
        </div>
      </div>
      <?php include('includes/footer.php'); ?>
  </div>
</body>
<script src="../assets/rating/js/dist/rating.min.js"></script>
<script>
        (function() {

            'use strict';
            var shop = document.querySelector('#shop');
            var service = new Object();

            $.ajax({
            type : "get",
             url : "/ipheya/manager/includes/getjs.php",
            data : "service=allservice",
            success:function(data)
            {
                data = JSON.parse(data);
                service =data;
                // INITIALIZE
                (function init() {
                for (var i = 0; i < service.length; i++) {
                    addRatingWidget(buildShopItem(service[i]), service[i]);
                }
            })();
            },
            error:function (err)
            {
                console.log("Result"+err);
            }});


            // BUILD SHOP ITEM
            function buildShopItem(service) {
                var shopItem = document.createElement('div');
                var html = '<div class="c-shop-item__img"></div>' +
                    '<div class="c-shop-item__details">' +
                    '<h3 class="c-shop-item__title">' + service.service + '</h3>' +
                    '<p class="c-shop-item__description">' + service.description + '</p>' +
                    '<ul class="c-rating"></ul>' +
                    '</div>';

                shopItem.classList.add('c-shop-item');
                shopItem.innerHTML = html;
                shop.appendChild(shopItem);

                return shopItem;
            }

            // ADD RATING WIDGET
            function addRatingWidget(shopItem, service) {
                var ratingElement = shopItem.querySelector('.c-rating');
                var currentRating = service.rating;
                var maxRating = 5;
                var id = <?= $id?>;
                var callback = function(rating) {
                    $.ajax({
                    type : "get",
                    url : "/ipheya/manager/includes/getjs.php",
                    data : "service_id="+service.service_id+"&client_id="+id+"&rating="+rating,
                    success:function(data)
                    {
                        data = JSON.parse(data);
                        alert(data);
                    },
                    error:function (err)
                    {
                        console.log("Result"+err);
                    }});
                };
                var r = rating(ratingElement, currentRating, maxRating, callback);
            }

        })();
    </script>
