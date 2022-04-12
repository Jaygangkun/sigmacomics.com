<?php
ob_start();
session_start();
$msg = array();
$variantArr = array();
// Get our helper functions

require_once("language_redirect.php");
require_once(dirname(dirname(__FILE__))."/inc/functions.php");
require_once(dirname(dirname(__FILE__))."/inc/connections.php");
include_once(dirname(dirname(__FILE__)).'/wp-content/themes/sigma-comics/apis.php');

$countryCurrency = getCountryCurrencyByIp();
$countryCurrencyRate = convertCurrency($countryCurrency);
//print_r($_SESSION['add_to_cart_session_id']);

if(!isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id']== ''){
    header( 'Location:'.constant('SITEURL_JAPANESE').'/order-issues');
    exit();
}else{

    $sqlNew = "SELECT count(*) as total_digital FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' AND (`type`= 'IDI' OR `type`= 'DS' OR `type`= 'PRDS' OR `type`= 'PCDS') and `language` = 'ja_JA' ";
    if ($resultNew = $conn->query($sqlNew)) {
        $rowNew = $resultNew->fetch_assoc();
        if( ($rowNew['total_digital'] > 0) && ( !isset($_SESSION['user'])) ){
            header( 'Location:'.constant('SITEURL_JAPANESE').'/signup');
            exit();
        }
    }


    $sqlPro = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' and `language` = 'ja_JA' ";
    if ($resultPro = $conn->query($sqlPro)) {
        $rowPro = $resultPro->fetch_assoc();
        $total_quantity = (isset($rowPro['total_quantity']))?$rowPro['total_quantity']:'';
        $total_price = (isset($rowPro['total_price']))?$rowPro['total_price']:'';
    }


}

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

if(isset($_REQUEST['token']) && $_REQUEST['token'] != ''){
    //print_r($_REQUEST);exit();
    /* New Section Start*/

    /*$dataNew = '{
        "carrier_service": {
            "callback_url": "http://shippingrateprovider.com",
        }
      }';
    $carrier = shopify_call($token, $shop, "/admin/api/2020-10/carrier_services.json", $dataNew, 'GET',array("Content-Type: application/json"));

    $carrier = json_decode($carrier['response'], TRUE);

    echo '<pre>';print_r($carrier);exit();*/

    /* New Section End */

    require_once('stripe/init.php');

    \Stripe\Stripe::setApiKey(constant("STRIPE_SECRET_KEY"));

    $is_error = 0;
    $is_error_pro = 0;

    try{

        $customer = \Stripe\Customer::create(array(
            'email' => $_REQUEST['email'],
            'source'  => $_REQUEST['token']
        ));
    }

    catch(\Stripe\Error\Card $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    } catch (\Stripe\Error\RateLimit $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    } catch (\Stripe\Error\InvalidRequest $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    } catch (\Stripe\Error\Authentication $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    } catch (\Stripe\Error\ApiConnection $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    } catch (\Stripe\Error\Base $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    } catch (Exception $e) {

        $is_error = 1;
        $body = $e->getJsonBody();
        $err  = $body['error'];
        $msg = $err['message'];

    }

    //print_r($customer);exit();
    //echo '1#'.$is_error;exit();

    if($is_error == 0){
        try{
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => intval(calculateCurrencyAmountWithOurCountryCurrencyUnformatted($countryCurrency,$countryCurrencyRate,$_REQUEST['total_price'])*100),
                'currency' => isset($countryCurrency->geoplugin_currencyCode)?$countryCurrency->geoplugin_currencyCode:'USD'
            ));
        }

        catch(\Stripe\Error\Card $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        } catch (\Stripe\Error\RateLimit $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        } catch (\Stripe\Error\InvalidRequest $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        } catch (\Stripe\Error\Authentication $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        } catch (\Stripe\Error\ApiConnection $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        } catch (\Stripe\Error\Base $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        } catch (Exception $e) {

            $is_error_pro = 1;
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $msg = $err['message'];

        }

        if($is_error_pro == 0){
            if($charge->id != ''){

                for($i=0; $i<$_REQUEST['count']; $i++){
                    $responsArr[$i]['variant_id'] = $_REQUEST['variantId_'.$i];
                    $responsArr[$i]['quantity'] = $_REQUEST['quantity_'.$i];
                    $responsArr[$i]['price'] = $_REQUEST['price_'.$i];

                    $shopifyProductArr[] = $_REQUEST['shopify_product_'.$i];
                    $typesArr[] = $_REQUEST['type_'.$i];
                }

                //print_r($responsArr);exit();

                $data = array(
                    "order" => array(
                        "email" => $_REQUEST['email'],
                        "fulfillment_status" => "fulfilled",
                        "send_receipt" => false,
                        "send_fulfillment_receipt" => false,
                        "line_items" => $responsArr,
                        "billing_address" => array(
                            "address1" => $_REQUEST['address1'],
                            "address2" => ($_REQUEST['address2'] != '')?$_REQUEST['address2']:'',
                            "city" => $_REQUEST['city'],
                            "province" => $_REQUEST['state'],
                            "country" => $_REQUEST['country'],
                            "first_name" => $_REQUEST['first_name'],
                            "last_name" => $_REQUEST['last_name'],
                            "zip" => $_REQUEST['zip'],
                        )
                    )
                );

                //echo '<pre>';print_r($data);exit();

                $checkouts = shopify_call($token, $shop, "/admin/api/2020-10/orders.json", json_encode($data), 'POST',array("Content-Type: application/json"));

                //echo '<pre>';print_r($checkouts);exit();

                $shopifyProductList = implode(',',$shopifyProductArr);
                $typeList 			= implode(',',$typesArr);

                $sqlOrder = "INSERT INTO orders (`user_id`, `shopify_user_id`,`shopify_product_ids`, `types`,`stripe_token`,`stripe_charge`,`language`) VALUES ('".$_SESSION['user']['id']."', '".$_SESSION['user']['shopify_customer_id']."', '".$shopifyProductList."','".$typeList."','".$customer->id."','".$charge->id."','".$_SESSION['lang']."')";


                if ($conn->query($sqlOrder) === TRUE) {

                    $sqlPro = "DELETE from cart WHERE `session_id`= '".$_SESSION['add_to_cart_session_id']."' ";

                    if ($conn->query($sqlPro) === TRUE) {
                        echo $_REQUEST['type'];
                    }

                    unset($_SESSION['add_to_cart_session_id']);
                    unset($_SESSION['shopify_product_id']);

                    if( in_array('IDI',$typesArr) || in_array('DS',$typesArr) || in_array('PRDS',$typesArr) || in_array('PCDS',$typesArr) ){
                        header( 'Location:'.constant('SITEURL_JAPANESE').'/digital-dashboard-5');
                    }else if(in_array('IPR',$typesArr) || in_array('IPC',$typesArr) || in_array('PRS',$typesArr) || in_array('PCS',$typesArr ) || in_array('PRCS',$typesArr) ){
                        header( 'Location:'.constant('SITEURL_JAPANESE').'/thank-you-print-2');
                    }else{
                        header( 'Location:'.constant('SITEURL_JAPANESE').'/thank-you-for-order-2');
                    }

                    exit();

                }

                // Convert customers JSON information into an array
                //$checkoutsResp = json_decode($checkouts['response'], TRUE);
                //print_r($checkoutsResp);exit();

            }else{
                echo 'Payment Not successfull '.$msg;
            }
        }else{
            echo 'Payment Not successfull '.$msg;
        }
    }else{
        echo 'Payment Not successfull '.$msg;
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


    <div id="error-message" class="MsgBox failMsg"></div>
    <div id="error-message-individual" class="MsgBox failMsg"></div>
    <!-- Contact Us Page Body Section Start -->
    <section class="inner-page-body-sec contact-page-body">
        <div class="container">
            <h2 class="text-center checkheading"><?php echo (isset($content[19]))?$content[19]:'';?> <span>( <?php echo $total_quantity;?> <?php echo($total_quantity > 1)?'アイテム':'アイテム'; ?> )</span></h2>
            <div class="cartWrap">


                <div class="leftcheckout">
                    <div class="express-checkoutprt">
                        <b><p>PAYPALで早く支払いましょう！</p></b><br>

                        <div id="paypal-button-container"></div>
                        <div id="paypal-button" style="width: 100%"></div>
                    </div>

                    <div class="orprt">またはクレジットカードでゆっくり支払う</div><br>

                    <form action= "" method="post" id = "stripe_pay">
                        <div class="formPrt">
                            <span class="shipHeading"><b><?php echo (isset($content[20]))?$content[20]:'';?></b></span>
                            <div class="addressdetail">
                                <input name="first_name" id="first_name" type="text" placeholder="ファーストネーム">
                                <input name="last_name" id="last_name" type="text" placeholder="ファーストネーム">
                                <input name="address1" id="address1" placeholder="住所">
                                <input name="address2" id="address2" placeholder="住所 2">
                                <input name="city" id="city" placeholder="市">
                                <input name="state" id="state" placeholder="状態">
                                <input name="country" id="country" placeholder="国">
                                <input name="zip" id="zip" placeholder="zip">

                                <!--<span>
                                        Sourav Roy
                                    </span>
                                    <span>
                                        CF-13, Swapnaneel Apartment, Chandiberia, Kestopur
                                    </span>
                                    <span>
                                        Kolkata, West Bengal, 700002
                                    </span>
                                    <a href="#">Add delivery instructions</a>-->
                            </div>
                            <!--<span>
                                <a href="#">Change</a>
                            </span>-->
                        </div>

                        <div class="formPrt">
                            <span class="shipHeading"><b><?php echo (isset($content[21]))?$content[21]:'';?></b></span>
                            <div class="addressdetail">
                                <div class="field-row">
                                    <!-- <span id="card-holder-name-info"
                                        class="info"></span> -->
                                    <input type="text" id="name"
                                           name="name" class="demoInputBox" placeholder="名前">
                                </div>
                                <div class="field-row">
                                    <!-- <span id="email-info" class="info"></span> -->
                                    <input type="text" id="email" name="email" class="demoInputBox" placeholder="Eメール">
                                </div>
                                <div class="field-row full-width">
                                    <!-- <span id="card-number-info"
                                        class="info"></span> -->
                                    <input type="text" id="card-number"
                                           name="card-number" class="demoInputBox" placeholder="カード番号">
                                </div>
                                <div class="field-row full-width">
                                    <div class="contact-row column-right">
                                        <label>有効期限月/年</label>
                                        <!-- <span id="userEmail-info"
                                            class="info"></span> -->
                                        <div class="twofieldprt">
                                            <select name="month" id="month"
                                                    class="demoSelectBox">
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <select name="year" id="year"
                                                    class="demoSelectBox">

                                                <?php
                                                $current = date('Y');
                                                $future = date('Y')+10;
                                                for($i = $current; $i<= $future; $i++ ){ ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="contact-row cvv-box">
                                        <label>CVC</label>
                                        <!-- <span id="cvv-info" class="info"></span> -->
                                        <input type="text" name="cvc" id="cvc"
                                               class="demoInputBox cvv-input">
                                    </div>
                                </div>
                            </div>
                            <!--<span>
                                <a href="#">Change</a>
                            </span>-->
                        </div>

                        <div class="reviewSection">
                            <span class="shipHeading"><b><?php echo (isset($content[22]))?$content[22]:'';?></b></span>
                            <div class="delivery_box">

                                <?php
                                $paypalProducts = '';
                                $sql = "SELECT * from `cart` WHERE `session_id` = '".$_SESSION['add_to_cart_session_id']."'  and `language` = 'ja_JA' ";
                                $result = $conn->query($sql);
                                if( !empty($result) ){
                                    if(($result->num_rows > 0)){
                                        $count = 0;

                                        while($row = $result->fetch_assoc()){

                                            $productId = $row['shopify_product_id'];
                                            $type	   = $row['type'];

                                            $products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$productId.".json", $data, 'GET');

                                            $products = json_decode($products['response'], TRUE);

                                            //echo '<pre>';print_r($row);exit();

                                            if(empty($products['product'])){
                                                header('Location: '.$_SERVER['REQUEST_URI']);
                                            }

                                            if( isset($row['variant_id']) && $row['variant_id'] != ''){
                                                $variantId = $row['variant_id'];
                                            }else{
                                                $variantId = $products['product']['variants'][0]['id'];
                                            }

                                            if( isset($row['variant_id']) && $row['variant_id'] != ''){
                                                $variants_product = shopify_call($token, $shop, "/admin/api/2020-10/variants/".$variantId.".json", $data, 'GET');

                                                $variants_product = json_decode($variants_product['response'], TRUE);
                                                $variants_product_price = $variants_product['variant']['price'];

                                                if(empty($variants_product)){
                                                    header('Location: '.$_SERVER['REQUEST_URI']);
                                                }

                                            }else{
                                                $variants_product_price = $products['product']['variants'][0]['price'];
                                            }



                                            //print_r($variantArr);
                                            ?>
                                            <input type="hidden" name="variantId_<?php echo $count; ?>" value="<?php echo $variantId; ?>"  />
                                            <input type="hidden" name="quantity_<?php echo $count; ?>" value="<?php echo $row['quantity']; ?>"  />
                                            <input type="hidden" name="price_<?php echo $count; ?>" value="<?php echo $variants_product_price;?>"  />

                                            <input type="hidden" name="shopify_product_<?php echo $count; ?>" value="<?php echo $productId;?>"  />
                                            <input type="hidden" name="type_<?php echo $count; ?>" value="<?php echo $type;?>"  />

                                            <?php
                                            $paypalProducts .= "&variantId_".$count."=".$variantId."&quantity_".$count."=".$row['quantity']."&price_".$count."=".$variants_product_price."&shopify_product_".$count."=".$productId."&type_".$count."=".$type."";
                                            ?>

                                            <div class="delivarycont">
                                                <div class="leftdelivary">
                                                    <?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
                                                        <img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
                                                    <?php }else{ ?>
                                                        <img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
                                                    <?php } ?>
                                                </div>
                                                <div class="rightdelivarycont">
                                                    <h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
                                                    <!--<h4>Print reader subscription</h4>-->
                                                    <span class="price"><b><?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$row['price']);?></b></span>
                                                    <div class="delivaryquantity_prt">
                                                        <div class="leftqty">
                                                            数量:
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

                                                        <!--<a href="#" class="giftBtn">
                                                            <i class="fa fa-gift"></i>
                                                            Add gift options
                                                        </a>-->

                                                    </div>
                                                </div>
                                            </div>
                                            <?php $count++; }

                                        ?>

                                        <input type="hidden" name="count" value="<?php echo $count;?>"  />
                                        <input type="hidden" name="total_price" value="<?php echo $total_price;?>"  />
                                    <?php }else{
                                        header( 'Location:'.constant('SITEURL_JAPANESE').'/order-issues');
                                    } }

                                ?>

                            </div>
                    </form>

                    <div class="order_box">

                        <button class="redbutton" name="place_order" onClick="stripePay(event);" >
                            注文する
                        </button>
                        <div class="ordertotalprt">
                            <b><?php echo (isset($content[23]))?$content[23]:'';?>: <?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$total_price);?></b>
                            <p><?php echo (isset($content[24]))?$content[24]:'';?></p>
                        </div>
                    </div>



                    <div class="questionprt">
							<span>
							<?php echo (isset($content[25]))?$content[25]:'';?>
							</span>
                        <span>
							<?php echo (isset($content[26]))?$content[26]:'';?>

							</span>
                        <span>
							<?php echo (isset($content[27]))?$content[27]:'';?>

							</span>
                        <span>
							<?php echo (isset($content[28]))?$content[28]:'';?>

							</span>

                    </div>
                </div>
            </div>
            <div class="rightcheckout">
                <img src="images/fully-secureicon.png" alt="">

                <div class="order-summeryBox">
                    <button class="redbutton" name="place_order" onClick="stripePay(event);">
                        注文する
                    </button>
                    <p><?php echo (isset($content[24]))?$content[24]:'';?></p>
                    <div class="midboxOrder">
                        <h3><?php echo (isset($content[29]))?$content[29]:'';?></h3>
                        <div class="itemList">
								<span>
									<label><?php echo($total_quantity > 1)?'記事':'記事' ?></label>
									<?php echo $total_quantity; ?>
								</span>
                            <span>
									<label>送料および手数料</label>
									$0.00
								</span>
                            <div class="totalPrt">
									<span>
										<label>税抜き合計:</label>
                                        <?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$total_price) ?>

									</span>
                                <span>
										<label>徴収される推定税額:*</label>
                                    	<?php echo  (isset($countryCurrency->geoplugin_currencySymbol_UTF8)?$countryCurrency->geoplugin_currencySymbol_UTF8:"$")?>0.00
									</span>
                            </div>
                            <span class="totalTxt">
									<label><?php echo (isset($content[23]))?$content[23]:'';?></label>
                                <?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$total_price) ?>

								</span>
                        </div>
                    </div>
                </div>
                <div class="howcalculated">
                    <?php //echo (isset($content[30]))?$content[30]:'';?>
                </div>
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
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
        function cardValidation () {
            var valid = true;

            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var address1 = $('#address1').val();
            var city = $('#city').val();
            var country = $('#country').val();
            var zip = $('#zip').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var cardNumber = $('#card-number').val();
            var month = $('#month').val();
            var year = $('#year').val();
            var cvc = $('#cvc').val();

            $("#error-message").html("").hide();

            if (first_name.trim() == "") {
                valid = false;
            }
            if (last_name.trim() == "") {
                valid = false;
            }
            if (address1.trim() == "") {
                valid = false;
            }
            if (city.trim() == "") {
                valid = false;
            }
            if (country.trim() == "") {
                valid = false;
            }
            if (zip.trim() == "") {
                valid = false;
            }
            if (name.trim() == "") {
                valid = false;
            }
            if (email.trim() == "") {
                valid = false;
            }else{
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                if (reg.test(email.trim()) == false)
                {
                    valid = false;
                    invalidEmail = false;

                }else{
                    invalidEmail = true;
                }
            }

            if (cardNumber.trim() == "") {
                valid = false;
            }else{
                if(validateCreditCard(cardNumber.trim()) == false ){
                    valid = false;
                    invalidCard = false;
                }else{
                    invalidCard = true;
                }
            }



            if (month.trim() == "") {
                valid = false;
            }
            if (year.trim() == "") {
                valid = false;
            }
            if (cvc.trim() == "") {
                valid = false;
            }

            if(valid == false) {
                $("#error-message").html("アドレス2を除くすべてのフィールドが必要です").show();
            }

            if(invalidEmail == false) {
                $("#error-message-individual").html("無効なメール。正しい形式を使用してください").show();
            }else{
                $("#error-message-individual").html("").hide();
            }

            if(invalidCard == false) {
                $("#error-message-individual").html("カードが無効です。正しいものを使用してください").show();
            }else{
                $("#error-message-individual").html("").hide();
            }

            return valid;
        }
        //set your publishable key
        Stripe.setPublishableKey("<?php echo constant("STRIPE_PUBLISHABLE_KEY")?>");

        //callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                //enable the submit button
                $("#submit-btn").show();
                $( "#loader" ).css("display", "none");
                //display the errors on the form
                $("#error-message").html(response.error.message).show();
            } else {
                //get token id
                var token = response['id'];
                //insert the token into the form
                $("#stripe_pay").append("<input type='hidden' name='token' value='" + token + "' />");
                //submit form to the server
                $("#stripe_pay").submit();
            }
        }
        function stripePay(e) {
            e.preventDefault();
            var valid = cardValidation();

            if(valid == true) {
                $("#submit-btn").hide();
                $( "#loader" ).css("display", "inline-block");
                Stripe.createToken({
                    number: $('#card-number').val(),
                    cvc: $('#cvc').val(),
                    exp_month: $('#month').val(),
                    exp_year: $('#year').val()
                }, stripeResponseHandler);

                //submit from callback
                return false;
            }
        }

        function validateCreditCard(creditCardNum){

            // The credit card number must be 16 digits in length
            if(creditCardNum.length !== 16){
                return false;
            }

            // All of the digits must be numbers
            for(var i = 0; i < creditCardNum.length; i++){
                // store the current digit
                var currentNumber = creditCardNum[i];

                // turn the digit from a string to an integer (if the digit is in fact a digit and not anther char)
                currentNumber = Number.parseInt(currentNumber);

                // check that the digit is a number
                if(!Number.isInteger(currentNumber)){
                    return false;
                }
            }

            // The credit card number must be composed of at least two different digits (i.e. all of the digits cannot be the same)
            var obj = {};
            for(var i = 0; i < creditCardNum.length; i++){
                obj[creditCardNum[i]] = true;
            }
            if(Object.keys(obj).length < 2){
                return false;
            }

            // The final digit of the credit card number must be even
            if(creditCardNum[creditCardNum.length - 1] % 2 !== 0){
                return false;
            }

            // The sum of all the digits must be greater than 16
            var sum = 0;
            for(var i = 0; i < creditCardNum.length; i++){
                sum += Number(creditCardNum[i]);
            }
            if(sum <= 16){
                return false;
            }

            return true;
        };
    </script>

    <script>
        paypal.Button.render({
            env: '<?php echo constant("PayPalENV"); ?>',
            style: {
                size: 'responsive',
                shape: 'rect',
            },
            client: {
                <?php if(constant("ProPayPal") != 0){ ?>
                production: '<?php echo constant("PayPalClientId"); ?>'
                <?php } else { ?>
                sandbox: '<?php echo constant("PayPalClientId"); ?>'
                <?php } ?>
            },
            payment: function (data, actions) {

                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: '<?php echo $total_price;?>',
                            currency: 'USD'
                        }
                    }]
                });
            },
            onAuthorize: function (data, actions) {
                return actions.payment.execute()
                    .then(function (details) {
                        console.log(details);
                        window.location = "<?php echo constant("SITEURL_JAPANESE");?>/orderDetails.php?paymentID="+
                            data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&count="+<?php echo $count;?>+"&email="+details.payer.payer_info.email+"&first_name="+details.payer.payer_info.first_name+"&last_name="+details.payer.payer_info.last_name+"&city="+details.payer.payer_info.shipping_address.city+"&address1="+details.payer.payer_info.shipping_address.line1+"&zip="+details.payer.payer_info.shipping_address.postal_code+"&country="+details.payer.payer_info.shipping_address.country_code+"&state="+details.payer.payer_info.shipping_address.state+"<?php echo $paypalProducts;?>";
                    });
            }
        }, '#paypal-button');
    </script>
    </body>

    </html>
<?php die();?>