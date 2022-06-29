
var apikey = "SANDBOXB4CEEAE0-BADE-4EC1-B900-9FF754400CFA-20220227125606" //ipaymu apikey
var va = "0000005234729998"
var body = {
            "name":"Buyer",
            "phone":"081999501092",
            "email":"buyer@mail.com",
            "amount":"10000",
            "notifyUrl":"https://mywebsite.com",
            "expired":"24",
            "expiredType":"hours",
            "comments":"Catatan",
            "referenceId":"1",
            "paymentMethod":"va",
            "paymentChannel":"bca",
            "product":["produk 1"],
            "qty":["1"],
            "price":["10000"],
            "weight":["1"],
            "width":["1"],
            "height":["1"],
            "length":["1"],
            "deliveryArea":"76111",
            "deliveryAddress":"Denpasar"
        };

var bodyEncrypt  = CryptoJS.SHA256(JSON.stringify(body));
var stringtosign = "POST:"+va+":"+bodyEncrypt+":"+apikey
var signature    = CryptoJS.enc.Hex.stringify(CryptoJS.HmacSHA256(stringtosign, apikey))


var settings = {
  "url": "https://sandbox.ipaymu.com/api/v2/payment/direct",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/json",
    "signature": signature,
    "va": va,
    "timestamp": "20191209155701"
  },
  "processData": false,
  "mimeType": "multipart/form-data",
  "contentType": false,
  "data": body
};

$.ajax(settings).done(function (response) {
  console.log(response);
});