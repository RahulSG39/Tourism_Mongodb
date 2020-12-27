<?php
    require('stripe-php/init.php');

    $publishableKey = "pk_test_51HMF6TAX12QAZICLRQk9akFknaZTQOOjwp0S9aOaK6oO33t49Stv1RyluEMu5SS4bmE5vSacbjuB9Fj4RKK2mvlc00EdGuQocT";

    $secretKey = "sk_test_51HMF6TAX12QAZICL09VQ5fJcKusc5JVv2zequFghU2FFesqh1mVxVr3Yipma1lOQIid5G725n2n9toHTto3hv8Dv00osVDweJN";

    \Stripe\Stripe::setApiKey($secretKey);
?>