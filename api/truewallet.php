<?php
// API TrueWallet Voucher Redeem by TinnerKun
// Endpoint: https://codex.servwire.cloud/api/truewallet.php
// Method: POST
// Content-Type: application/json or application/x-www-form-urlencoded
// For application/json => data: { "mobile": "xxxxxxxxxx", "voucher_code": "xxxxxxxxxxxxxxxxxx" }
// For application/x-www-form-urlencoded => data: mobile=xxxxxxxxxx&voucher_code=xxxxxxxxxxxxxxxxxx

// Config
// $mobile = "xxxxxxxxxx";
// $voucher_code = "xxxxxxxxxxxxxxxxxx";

// https://gift.truemoney.com/campaign/?v=xxxxxxxxxxxxxxxxxx to xxxxxxxxxxxxxxxxxx
// 
// Example: Regex
// $url_true_wallet = 'https://gift.truemoney.com/campaign/?v=xxxxxxxxxxxxxxxxxx';
// if(!preg_match('/https:\/\/gift.truemoney.com\/campaign\/\?v\=/', $url_true_wallet)) return;
// $url_true_wallet = explode('?', $url_true_wallet);
// $url_true_wallet = explode('=', $url_true_wallet[1]);
// $url_true_wallet = $url_true_wallet[1];

// Example: cURL (POST) 
// $url_true_wallet = 'https://gift.truemoney.com/campaign/?v=xxxxxxxxxxxxxxxxxx';
// Endpoint API : https://codex.servwire.cloud/api/truewallet.php
// $data = array(
//     'mobile' => $mobile,
//     'voucher_code' => $voucher_code
// );
// $data = json_encode($data);
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url_true_wallet);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen($data))
// );
// $result = curl_exec($ch);
// curl_close($ch);
// echo $result;

// Output JSON

// {
//     "status": {
//         "message": "success",
//         "code": "SUCCESS"
//     },
//     "data": {
//         "voucher": {
//             "voucher_id": xxxxxxxxx,
//             "amount_baht": "10.00",
//             "redeemed_amount_baht": "10.00",
//             "member": 1,
//             "status": "active",
//             "link": "xxxxxxxxxxxxxxxxxx",
//             "detail": "",
//             "expire_date": xxxxxxxxxxxxx,
//             "redeemed": 1,
//             "available": 0
//         },
//         "owner_profile": {
//             "full_name": "*** ***"
//         },
//         "redeemer_profile": {
//             "mobile_number": "093xxxxxxx"
//         },
//         "my_ticket": {
//             "mobile": "093xxxxxxx",
//             "update_date": xxxxxxxxxxxxx,
//             "amount_baht": "10.00",
//             "full_name": "*** ***"
//         },
//         "tickets": [
//             {
//                 "mobile": "093-xxx-xxxx",
//                 "update_date": xxxxxxxxxxxxx,
//                 "amount_baht": "10.00",
//                 "full_name": "*** ***"
//             }
//         ]
//     }
// }

// Use GET Data Check Money in [data->my_ticket->amount_baht]

// STATUS CODE ALL
// SUCCESS = Money Added to Wallet (Success)
// CANNOT_GET_OWN_VOUCHER = Cannot Get Own Voucher (You can't redeem your own voucher)
// TARGET_USER_NOT_FOUND = Mobile Number Not Found (Mobile number not found) or Out of Data in TrueWallet
// INTERNAL_ERROR = Internal Error (Internal error)
// VOUCHER_NOT_FOUND = Voucher Not Found (Voucher not found)
// VOUCHER_OUT_OF_STOCK = Voucher Out of Stock (Voucher out of stock)
// VOUCHER_EXPIRED = Voucher Expired (Voucher expired)

// LIST ["SUCCESS", "CANNOT_GET_OWN_VOUCHER", "TARGET_USER_NOT_FOUND", "INTERNAL_ERROR", "VOUCHER_NOT_FOUND", "VOUCHER_OUT_OF_STOCK", "VOUCHER_EXPIRED"]
?>