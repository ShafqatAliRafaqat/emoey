<style type="text/css">
.carousel-inner {
  position: relative;
  width: 100%;
  min-height: 100px;
  }
 
 .carousel-control.right {
  right: 0;
  left: auto;
  background-image: none !important;
  background-repeat: repeat-x;
}
 .carousel-control.left {
  left: 0;
  right: auto;
  background-image: none !important;
  background-repeat: repeat-x;
}
#carousel-example-generic {
    margin: 20px auto;
    width: 100%;
}

#carousel-custom {
    margin: 20px auto;
    width: 360px;
}
#carousel-custom .carousel-indicators {
    margin: 10px 0 0;
    overflow: auto;
    position: static;
    text-align: left;
    white-space: nowrap;
    width: 100%;
    overflow:hidden;
}
#carousel-custom .carousel-indicators li {
    background-color: transparent;
    -webkit-border-radius: 0;
    border-radius: 0;
    display: inline-block;
    height: auto;
    margin: 0 !important;
    width: auto;
}
#carousel-custom .carousel-indicators li img {
    display: block;
    opacity: 0.5;
}
#carousel-custom .carousel-indicators li.active img {
    opacity: 1;
}
#carousel-custom .carousel-indicators li:hover img {
    opacity: 0.75;
}
#carousel-custom .carousel-outer {
    position: relative;
}
.carousel-indicators li img {
  height: 66px;
  width: 52px;}
</style>
<link href="<?php echo base_url();?>assets/css/jquery.mCustomScrollbar.css?v1.1" rel="stylesheet">

<div class="row booking-form">
    <!-- <?php print_r($deal) ; ?> -->
    <div class="row row_margin-0">
<div class="col-md-4 padding-0">
<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
    <div class='carousel-outer'>
        <!-- me art lab slider -->
        <div class='carousel-inner '>

            <?php $active = 'active'; $id = '';  for($i=0;$i<count($dealpictures);$i++)  { ?>
             <div class='tile item <?php echo $active; ?> adjust' data-scale="2.4" data-image="<?php echo $dealpictures[$i]; ?>">
                <img class="photo" src='<?php echo $dealpictures[$i]; ?>' width="360" height="360" alt='emoey_hot_deal' id="<?php echo $id; ?>"/>
            </div>
            <?php $active = ''; $id=''; }?>
          
        </div>
            
        <!-- sag sol -->
        <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
            <span class='glyphicon glyphicon-chevron-left'></span>
        </a>
        <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
            <span class='glyphicon glyphicon-chevron-right'></span>
        </a>
    </div>
    
    <!-- thumb -->
    <ol class='carousel-indicators mCustomScrollbar meartlab'>
        <?php $active = 'active'; for($i=0;$i<count($dealpictures);$i++)  { ?>
        <li data-target='#carousel-custom' data-slide-to='<?php echo $i; ?>' class='<?php echo $active; ?>'><img src='<?php echo $dealpictures[$i]; ?>' alt='' width="66" height="66" /></li>
         <?php $active = ''; }?>
    </ol>
</div>
</div>
<div class="col-md-7">
    <h1 class="hotdealtitle yopadding"><?php echo $deal['name'];?></h1>
    <p class="yopadding"> <?php echo $deal['description'];?></p>
    <h2 class="hotdealprice yopadding">Rs <?php echo $deal['price'];?></h2>

    <div class="yopadding">
    <textarea class="form-control" id="greetings" rows="5" id="comment" placeholder="Enter message for your loved one.."></textarea>
    <input type="hidden" id="hotdealsid" value="<?php echo $deal['baskets_store_id'];?>"></input>
        <a id="goingtocheckout" class="btn btn-emoey add-voice-btn done-btn" href="<?php echo base_url();?>SendBasket/checkout">Buy Now</a>
    </div>

</div>

</div>

</div>

<?php echo asset_js("basket_store.js"); ?>
<?php echo asset_js("productdetailcarousel.js"); ?>
<script type="text/javascript">

$(document).ready(function() {
    $('.tile')
    // tile mouse actions
    .on('mouseover', function(){
      $(this).children('.photo').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
    })
    .on('mouseout', function(){
      $(this).children('.photo').css({'transform': 'scale(1)'});
    })
    .on('mousemove', function(e){
      $(this).children('.photo').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
    })
    // tiles set up
});
</script>




