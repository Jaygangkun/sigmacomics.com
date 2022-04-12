<?php
ob_start();
session_start();
$msg = array();

// Get our helper functions
require_once("language_redirect.php");
require_once(dirname(dirname(__FILE__))."/inc/functions.php");
require_once(dirname(dirname(__FILE__))."/inc/connections.php");

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
    "Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);


// Individual Digital Issue Select => 227514581157
// Digital Subscription => 228873535653
// Shop => 225130545317

// product data
$data = array("collection_id" => '260803788965');

//$data = array();

// Run API call to submit collection
$collection = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
$collection = json_decode($collection['response'], TRUE);
$productId = $collection['collects'][0]['product_id'];

$products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$productId.".json", $data, 'GET');

//$data = array();
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/custom_collections.json", $data, 'GET');

// Convert customers JSON information into an array
$products = json_decode($products['response'], TRUE);

//print_r($products);

/*$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field-spanish' and `post_status`= 'publish'";*/

$sqlNew = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 69 ORDER BY `ID` DESC ";

if ($resultNew = $conn->query($sqlNew)) {
    $i = 0;
    while($rowNew = $resultNew->fetch_assoc()){
        $content[$i] = $rowNew['post_content'];
        $i++;
    }
}

$countryCurrency = getCountryCurrencyByIp();
$countryCurrencyRate = convertCurrency($countryCurrency);
$countryCurrencyJs = (isset($countryCurrency->geoplugin_currencySymbol_UTF8))?$countryCurrency->geoplugin_currencySymbol_UTF8:null;

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
            <section class="inner-page-body-sec news-page-body">
                <div class="container">
                    <div class="indi_list">
                        <h3><?php echo (isset($content[11]))?$content[11]:'';?> </h3>
                        <h4><?php echo (isset($content[12]))?$content[12]:'';?></h4>
                    </div>

                    <?php if(!empty($products['product'])){ ?>

                        <div class="indidetailBody">
                            <div class="leftImgsection">
                                <div class="innerImgprt">
                                    <?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
                                        <img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
                                    <?php }else{ ?>
                                        <img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="rightContentTxt">
                                <h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
                                <div class="priceprt">
                                    <span>Prix de la liste: <del><?php echo ( isset($products['product']['variants'][0]['compare_at_price']) )?calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$products['product']['variants'][0]['compare_at_price']):''; ?></del></span>
                                    <span>Prix: <b><?php echo ( isset($products['product']['variants'][0]['price']) )?calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$products['product']['variants'][0]['price']):''; ?> !</b></span>
                                    <?php if( isset($products['product']['variants'][0]['compare_at_price']) && isset($products['product']['variants'][0]['price']) && ( intval($products['product']['variants'][0]['compare_at_price']) > intval($products['product']['variants'][0]['price']) ) ){ ?>
                                        <span>Vous économisez: <font><?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$products['product']['variants'][0]['compare_at_price'] - $products['product']['variants'][0]['price']); ?></font></span>
                                    <?php }else{ ?>
                                        <span>Vous économisez: <font>$0</font></span>
                                    <?php } ?>

                                </div>
                                <?php echo ( isset($products['product']['body_html']) )?$products['product']['body_html']:''; ?>

                                <button class="cartbutton" onclick="addToCartIndividualFrench(<?php echo $products['product']['id'];?>,<?php echo $products['product']['variants'][0]['price'];?>,'DS');">AJOUTER AU PANIER</button>

                            </div>
                        </div>

                        <?php
                    }else{
                        header('Location: '.$_SERVER['REQUEST_URI']);
                    }
                    ?>

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
        
        let countryCurrencyRate = "<?php echo $countryCurrencyRate;?>";
        let compareAtPrice = "<?php echo ( isset($products['product']['variants'][0]['compare_at_price']) )? $products['product']['variants'][0]['compare_at_price']:''; ?>";
        let Price = "<?php echo ( isset($products['product']['variants'][0]['price'] ))?$products['product']['variants'][0]['price']:''; ?>";
        let youSavePrice = "<?php echo ( isset($products['product']['variants'][0]['compare_at_price']) && isset( $products['product']['variants'][0]['price']))? $products['product']['variants'][0]['compare_at_price'] - $products['product']['variants'][0]['price']:''; ?>";


       
        /* console.log(countryCurrency);
         console.log(countryCurrencyRate);*/
        let htmlPrice = $('body > section > div > div.indidetailBody > div.rightContentTxt > div:nth-child(3) > strong:nth-child(1) > span > span:nth-child(1)').text();

        $('body > section > div > div.indidetailBody > div.rightContentTxt > div:nth-child(3) > strong:nth-child(1) > span > span:nth-child(1)')
            .text(htmlPrice.replace(htmlPrice,calculateCurrencyAmount(countryCurrency,countryCurrencyRate,Price,countryInfo)));
        let htmlCompareAtPrice = $('body > section > div > div.indidetailBody > div.rightContentTxt > div:nth-child(3) > s').text();
        $('body > section > div > div.indidetailBody > div.rightContentTxt > div:nth-child(3) > s')
            .text(htmlCompareAtPrice.replace(htmlCompareAtPrice,calculateCurrencyAmount(countryCurrency,countryCurrencyRate,compareAtPrice,countryInfo)));

        let htmlYouSavePrice = $('body > section > div > div.indidetailBody > div.rightContentTxt > div:nth-child(3) > strong:nth-child(3)').text();
        $('body > section > div > div.indidetailBody > div.rightContentTxt > div:nth-child(3) > strong:nth-child(3)')
            .text(htmlYouSavePrice.replace("$"+youSavePrice,calculateCurrencyAmount(countryCurrency,countryCurrencyRate,youSavePrice,countryInfo)));
        //1.50
        let htmlShortHeadingArray = $('.indi_list > h4').text().split(' ');

        let htmlShortHeadingText = $('.indi_list > h4').text();

        $('.indi_list > h4')
            .text(htmlShortHeadingText.replace(htmlShortHeadingArray[0]+" "+htmlShortHeadingArray[1],calculateCurrencyAmount(countryCurrency,countryCurrencyRate,htmlShortHeadingArray[0].split(',')[0]+"."+htmlShortHeadingArray[0].split(',')[1],countryInfo)));

        let htmlShortHeadingArray2 = $('.rightContentTxt > div:nth-child(3) > span > strong').text().split(' ');
        let htmlShortHeadingText2 = $('.rightContentTxt > div:nth-child(3) > span > strong').text();

        $('.rightContentTxt > div:nth-child(3) > span > strong')
            .text(htmlShortHeadingText2.replace(htmlShortHeadingArray2[0]+" "+htmlShortHeadingArray2[1],calculateCurrencyAmount(countryCurrency,countryCurrencyRate,htmlShortHeadingArray[0].split(',')[0]+"."+htmlShortHeadingArray[0].split(',')[1],countryInfo)));
    </script>
    </html>
<?php die();?>