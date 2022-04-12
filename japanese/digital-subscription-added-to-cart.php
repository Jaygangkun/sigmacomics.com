<?php
ob_start();
session_start();
$msg = array();

// Get our helper functions
require_once("language_redirect.php");
require_once(dirname(dirname(__FILE__))."/inc/functions.php");
require_once(dirname(dirname(__FILE__))."/inc/connections.php");

/*if(!isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id']== ''){
	header( 'Location:'.constant('SITEURL_JAPANESE').'/order-issues-2');
}*/

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
    "Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);


// Individual Digital Issue Select => 227514581157
// Digital Subscription => 228873535653
// Shop => 225130545317

// customers data
//$data = array("collection_id" => '227514581157');

$data = array();

// Run API call to submit customers
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
$products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$_GET['product'].".json", $data, 'GET');

//$data = array();
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/custom_collections.json", $data, 'GET');

// Convert customers JSON information into an array
$products = json_decode($products['response'], TRUE);


$sql = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' and `language` = 'ja_JA' ";
if ($result = $conn->query($sql)) {
    $row = $result->fetch_assoc();
    $total_quantity = (isset($row['total_quantity']))?$row['total_quantity']:'';
    $total_price = (isset($row['total_price']))?$row['total_price']:'';
}

/*$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field-spanish' and `post_status`= 'publish' ";*/

$sqlNew = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 48 ORDER BY `ID` DESC ";

if ($resultNew = $conn->query($sqlNew)) {
    $i = 0;
    while($rowNew = $resultNew->fetch_assoc()){
        $content[$i] = $rowNew['post_content'];
        $i++;
    }
}

$countryCurrency = getCountryCurrencyByIp();
$countryCurrencyRate = convertCurrency($countryCurrency);

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Sigma Comics</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo constant("SITEURL")?>/images/favicon.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link type="text/css" href="../css/owl.carousel.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link type="text/css" href="../css/style.css" rel="stylesheet">
    <link type="text/css" href="../css/responsive.css" rel="stylesheet">
    <!-- Font Link -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
<!-- Header Section Start -->
<?php
require_once(__ROOT__."/include/header.php");
?>
<!-- Header Section End -->

<?php if(isset($products['errors']) && $products['errors']){ ?>
<section class="inner-page-body-sec news-page-body">
    <div class="container">
        <div class="indi_list">
            <h3>NO PRODUCTS FOUND</h3>
        </div>
        <div class="indidetailBody">
        </div>
    </div>
    </div>
    <?php }else{ ?>
        <!-- Latest News Page Body Section Start -->
        <section class="inner-page-body-sec new-add-to-cart">
            <div class="container">
                <div class="new-add-cart-top-sec">
                    <ul>
                        <li class="selected-cart">
                            <p><img src="<?php echo constant("SITEURL");?>/images/right-tick.png" alt=""> <?php echo (isset($content[41]))?$content[41]:'';?></p>
                        </li>
                        <li class="total-cart-itm">
                            <p><?php echo (isset($content[42]))?$content[42]:'';?> (<?php echo $total_quantity; ?> <?php echo (isset($content[46]))?$content[46]:'';?>): <?php echo calculateCurrencyAmountWithNullValue($countryCurrency,$countryCurrencyRate,$total_price);?></p>
                        </li>

                        <li class="buy-more-btn"><a href="<?php echo constant("SITEURL_JAPANESE")."/cart";?>"><?php echo (isset($content[44]))?$content[44]:'';?></a></li>
                        <li class="proceed-checkout-btn"><a href="<?php echo constant("SITEURL_JAPANESE")."/checkout";?>"><?php echo (isset($content[45]))?$content[45]:'';?> (<?php echo $total_quantity; ?> <?php echo (isset($content[46]))?$content[46]:'';?>)</a></li>
                    </ul>
                </div>

                <div class="new-cart-dtl-itm-hdn">
                    <?php echo (isset($content[13]))?$content[13]:'';?>

                </div>
                <?php if(!empty($products['product'])){ ?>

                    <div class="new-cart-dtl-itm">
                        <div class="cartImgprt">
                            <figure>
                                <?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
                                    <img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
                                <?php }else{ ?>
                                    <img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
                                <?php } ?>
                            </figure>
                        </div>
                        <article>
                            <h1><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h1>
                            <h2><?php echo ( isset($products['product']['body_html']) )?$products['product']['body_html']:''; ?></h2>
                            <button class="cartbutton" onclick="addToCartIndividualJapanese(<?php echo $_GET['product'];?>,<?php echo $products['product']['variants'][0]['price'];?>,'DS');">カートに追加</button>
                        </article>
                    </div>
                <?php }else{
                    header('Location: '.$_SERVER['REQUEST_URI']);
                } ?>

            </div>
        </section>
        <!-- Latest News Page Body Section End -->
    <?php } ?>


    <?php
    require_once(__ROOT__."/include/footer.php");
    ?>

    <script>
        var SITEURL = '<?php echo constant("SITEURL")?>';
    </script>
    <!-- JS Start here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo constant("SITEURL")?>/js/jquery.min.js"><\/script>')</script>
    <!-- Bootstrap JS -->
    <script src="<?php echo constant("SITEURL")?>/js/bootstrap.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="<?php echo constant("SITEURL")?>/js/owl.carousel.min.js"></script>
    <!-- Portfolio JS -->
    <script src="<?php echo constant("SITEURL")?>/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo constant("SITEURL")?>/js/jquery.validate.js"></script>
    <!-- Custome js -->
    <script src="<?php echo constant("SITEURL")?>/js/custom.js"></script>
</body>
<script>

    let countryCurrency = "<?php echo (isset($countryCurrency->geoplugin_currencySymbol_UTF8))?$countryCurrency->geoplugin_currencySymbol_UTF8:null;?>";
    let countryInfo = <?php echo (isset($countryCurrency))?json_encode($countryCurrency):null;?>;
    console.log(countryCurrency);
    let countryCurrencyRate = "<?php echo $countryCurrencyRate;?>";
    let compareAtPrice = "<?php echo ( isset($products['product']['variants'][0]['compare_at_price']) )? $products['product']['variants'][0]['compare_at_price']:''; ?>";
    let Price = "<?php echo ( isset($products['product']['variants'][0]['price'] ))?$products['product']['variants'][0]['price']:''; ?>";
    let youSavePrice = "<?php echo ( isset($products['product']['variants'][0]['compare_at_price']) && isset( $products['product']['variants'][0]['price']))? $products['product']['variants'][0]['compare_at_price'] - $products['product']['variants'][0]['price']:''; ?>";

    var htmlPriceText  = $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > strong:nth-child(1) > span > span:nth-child(1)').text();
    $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > strong:nth-child(1) > span > span:nth-child(1)')       .text(htmlPriceText.replace("$"+Math.round(Price),calculateCurrencyAmount(countryCurrency,countryCurrencyRate,Price,countryInfo)));

    let htmlCompareAtPriceText = $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > s').text();
    $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > s').text(htmlCompareAtPriceText.replace("$"+compareAtPrice,calculateCurrencyAmount(countryCurrency,countryCurrencyRate,compareAtPrice,countryInfo)));

    let htmlYouSavePriceText =   $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > strong:nth-child(3)').text();
    $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > strong:nth-child(3)').text(htmlYouSavePriceText.replace("$"+youSavePrice,calculateCurrencyAmount(countryCurrency,countryCurrencyRate,youSavePrice,countryInfo)));

    let htmlPerIssuePriceText =   $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > span > strong').text();
    $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > span > strong').text(
        htmlPerIssuePriceText.replace(htmlPerIssuePriceText.split(' ')[1]+" "+htmlPerIssuePriceText.split(' ')[2],calculateCurrencyAmount(countryCurrency,countryCurrencyRate,htmlPerIssuePriceText.split(' ')[1],countryInfo)));
    $('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > span > strong').text($('.new-cart-dtl-itm > article > h2 > div:nth-child(1) > span > strong').text().replace('$',""))
</script>
</html>