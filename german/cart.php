<?php
ob_start();
session_start();
$msg = array();
$result =  array();
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

// customers data
//$data = array("collection_id" => '228873535653');

$data = array();

// Run API call to submit customers
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collections/228873535653/products.json", $data, 'GET');

//$data = array();
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/custom_collections.json", $data, 'GET');

// Convert customers JSON information into an array
//$customers = json_decode($customers['response'], TRUE);

//echo '<pre>';print_r($customers['response']);

if (isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id'] != '' ){
    $sql = "SELECT * from `cart` WHERE `session_id` = '".$_SESSION['add_to_cart_session_id']."' and `language` = 'de_DE' ";
    $result = $conn->query($sql);

    $sqlNew = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' and `language` = 'de_DE'";
    if ($resultNew = $conn->query($sqlNew)) {
        $rowNew = $resultNew->fetch_assoc();
        $total_quantity = (isset($rowNew['total_quantity']))?$rowNew['total_quantity']:'';
        $total_price = (isset($rowNew['total_price']))?$rowNew['total_price']:'';
    }

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



    <!-- Contact Us Page Body Section Start -->
    <section class="inner-page-body-sec contact-page-body">
        <div class="container">
            <div class="cartWrap">
                <div class="leftCartListing">
                    <h2><?php echo (isset($content[16]))?$content[16]:'';?></h2>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="80%">
                                &nbsp;
                            </th>
                            <th>
                                <?php echo (isset($content[17]))?$content[17]:'';?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if (isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id'] != '' ){
                            $sql = "SELECT * from `cart` WHERE `session_id` = '".$_SESSION['add_to_cart_session_id']."' and `language` = 'de_DE'";
                            $result = $conn->query($sql);
                        }
                        ?>
                        <?php

                        if( !empty($result) ){
                            if(($result->num_rows > 0)){
                                while($row = $result->fetch_assoc()){

                                    //print_r($row);

                                    $productId = $row['shopify_product_id'];
                                    $products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$productId.".json", $data, 'GET');
                                    $products = json_decode($products['response'], TRUE);

                                    if(!empty($products['product'])){
                                        ?>
                                        <tr>
                                            <td title="Product-describetion" width="80%">
                                                <div class="productSHowprt">
                                                    <div class="leftImgprt">
                                                        <div class="cartInnerImg">
                                                            <?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
                                                                <img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
                                                            <?php }else{ ?>
                                                                <img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
                                                            <?php } ?>
                                                        </div>


                                                        <h4>
                                                            <?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?>
                                                        </h4>
                                                    </div>
                                                    <div class="productCont">
                                                        <h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
                                                        <div class="quantity_prt">
                                                            <div class="leftqty">
                                                                <?php echo (isset($content[47]))?$content[47]:'';?>:
                                                                <select name="prod_qty" name="prod_qty" onchange="changeProductQuantity('<?php echo $row['id']; ?>', this.value ,'<?php echo $products['product']['variants'][0]['price']; ?>');">
                                                                    <?php
                                                                    for($i=1;$i<16;$i++){
                                                                        ?>
                                                                        <option value="<?php echo $i;?>" <?php if($row['quantity'] == $i ){?>selected="selected" <?php } ?> ><?php echo $i;?></option>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <a href="javascript:void(0);" onclick="cartProductDelete(<?php echo $productId;?>)"><?php echo (isset($content[48]))?$content[48]:'';?></a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="top" title="price" title="price">
                                                <b> <?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$row['price']);?> </b>
                                            </td>
                                        </tr>

                                    <?php }else{

                                        header('Location: '.$_SERVER['REQUEST_URI']);
                                        exit();

                                    } ?>

                                <?php } }else{ ?>

                                <tr>
                                    <td colspan="2">
                                        <div class="productSHowprt">
                                            <div class="productCont">
                                                <h3>Cart is Empty </h3>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            <?php } ?>

                        <?php }else{ ?>
                            <tr>
                                <td>
                                    <div class="productSHowprt">
                                        <div class="productCont">
                                            <h3>Cart is Empty </h3>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="rightcrtprice">
                    <h4><?php echo (isset($content[18]))?$content[18]:'';?>(<?php echo ( isset($total_quantity) && $total_quantity != '' )?$total_quantity:'0'; ?>): <b> <?php echo ( isset($total_price) && $total_price != '' )?calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$total_price):'0.00'; ?> </b></h4>
                    <a href="<?php echo constant("SITEURL_GERMAN")?>/checkout"><button class="redbutton">
                            <?php echo (isset($content[49]))?$content[49]:'';?>  ( <?php echo ( isset($total_quantity) && $total_quantity != '' )?$total_quantity:'0'; ?> )
                        </button></a>
                </div>
            </div>

        </div>
    </section>
    <!-- Contact Us Page Body Section End -->

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

    </html>
<?php die();?>