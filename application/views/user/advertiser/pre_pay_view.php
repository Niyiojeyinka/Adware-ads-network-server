<div class="w3-center"><br>


<form>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script> 

   <!--test <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>-->
    <button class="w3-btn w3-blue" type="button" onClick="payWithRave()">Pay Now</button>
</form>

<script>
    const API_publicKey = "FLWPUBK-0ec90bc8beb0120dadaac132ec3884f7-X";//live
    
    //const API_publicKey = "FLWPUBK-d4bc12d79e9a779c85e8825f87451df9-X";//test

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "<?= $user['email'] ?>",
            amount: <?= $amount ?>,
            customer_phone: "<?= $user['phone'] ?>",
            currency: "<?= strtoupper($currency_code) ?>",
            txref: "<?php 
//GENERATE REFRENCE CODE
   $array_char = array('A','B','C','D');
    $i = mt_rand(0,3);
    $ref = 'cth'.uniqid().$array_char[$i];
    $_SESSION['hold'] = array('ref' => $ref,'amount'=>$amount,'currency_code'=>$currency_code);
    echo $ref;
     ?>",
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect txRef returned and pass to a          server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    // redirect to a success page
                  window.location.assign('<?=site_url('advertiser_dashboard/confirm_pay_payment') ?>')
                } else {
                    // redirect to a failure page.
                  window.location.assign('<?=site_url('advertiser_dashboard/payment') ?>')

                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>