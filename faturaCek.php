<?php
include "all.php";
?>


<?php

$faturalar=$trendyol->settlements->settlementsList(
	array(
		// Belirli bir tarihten sonraki siparişleri getirir. Timestamp olarak gönderilmelidir.	
		'startDate'          => strtotime('1st January 2021'),
		// Belirtilen tarihe kadar olan siparişleri getirir. Timestamp olarak gönderilmelidir ve startDate ve endDate aralığı en fazla 2 hafta olmalıdır
		'endDate'            => strtotime('15st January 2021'),
		// Sadece belirtilen sayfadaki bilgileri döndürür	
		'page'               => 0,
		// Bir sayfada listelenecek maksimum adeti belirtir. (Max 200)
		'size'               => 500,
		// Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir	
		
		// Siparişlerin statülerine göre bilgileri getirir.	(Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnSupplied)
		'transactionType'     => 'Sale',
		//'transactionType'             => array('required' => array('Sale', 'Return', ' Discount', 'Coupon', 'DiscountCancel', 'CouponCancel', 'ProvisionPositive', 'ProvisionNegative')),
		// Siparişler neye göre sıralanacak? (PackageLastModifiedDate, CreatedDate)
		

	)
);
 $k=0;
$otherFinancalTransactionType=array('CashAdvance','WireTransfer',
'IncomingTransfer','ReturnInvoice',
'CommissionAgreementInvoice','PaymentOrder','DeductionInvoices');
foreach($otherFinancalTransactionType as $oth){
	for($m=strtotime('01.01.2021');$m<strtotime(date("d.m.y"));$m=$m+60*60*24*15){
		$k++;
        $odemeler=$trendyol->otherfinancal->otherFinancalList(
	       array(
		// Belirli bir tarihten sonraki siparişleri getirir. Timestamp olarak gönderilmelidir.	
		'startDate'          => $m,
		// Belirtilen tarihe kadar olan siparişleri getirir. Timestamp olarak gönderilmelidir ve startDate ve endDate aralığı en fazla 2 hafta olmalıdır
		'endDate'            => $m+60*60*24*15,
		// Sadece belirtilen sayfadaki bilgileri döndürür	
		'page'               => 0,
		// Bir sayfada listelenecek maksimum adeti belirtir. (Max 200)
		'size'               => 500,
		// Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir	
		
		
		'transactionType'     => $oth,
		//'transactionType'             => array('required' => array('Sale', 'Return', ' Discount', 'Coupon', 'DiscountCancel', 'CouponCancel', 'ProvisionPositive', 'ProvisionNegative')),
		// Siparişler neye göre sıralanacak? (PackageLastModifiedDate, CreatedDate)
		

	)
);

echo "<pre>";
echo $oth.' '.date("d/m/Y",$m).' ile'.date("d/m/Y",$m+60*60*24*15).' arasındaki faturalar <br/>';

print_r($odemeler);

echo "</pre>";
}
if($oth==" "){echo "boş değer";}


}



echo "<pre>";
print_r($faturalar);
echo "</pre>";