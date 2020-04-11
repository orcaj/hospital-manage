<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'ecomTxnId','invoice_id' , 'createdDate' , 'amount', 'totalAmountDebittedFromCust','totalAmountCreditedToMerchant','clientRequestDate', 'clientConfirmationDate', 'processDate', 'tranStatus', 'walletTranStatus', 'merchantTxnRefNo', 'txnRefNo', 'merchantID', 'successUrl', 'failureUrl', 'crosscat', 'requestHashMac', 'custHashMac', 'paymentOptions', 'merchantName', 'paymentId', 'statusDescription'
    ];
}
