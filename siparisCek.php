<?php
include "all.php";
?>

<?php

echo "<pre>";
//echo time();

echo "</pre>";
?>

<?php
$y=0;
	for($m=strtotime('01.01.2021');$m<strtotime(date("d.m.y"));$m=$m+60*60*24*15){




$siparisler=$trendyol->order->orderList(
	array(
		// Belirli bir tarihten sonraki siparişleri getirir. Timestamp olarak gönderilmelidir.	
		'startDate'          => $m,
		// Belirtilen tarihe kadar olan siparişleri getirir. Timestamp olarak gönderilmelidir ve startDate ve endDate aralığı en fazla 2 hafta olmalıdır
		'endDate'            => $m+60*60*24*15,
		// Sadece belirtilen sayfadaki bilgileri döndürür	
		'page'               => 0,
		// Bir sayfada listelenecek maksimum adeti belirtir. (Max 200)
		'size'               => 200,
		// Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir	
		'orderNumber'        => '',
		// Siparişlerin statülerine göre bilgileri getirir.	(Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnSupplied)
		'status'             => '',
		// Siparişler neye göre sıralanacak? (PackageLastModifiedDate, CreatedDate)
		'orderByField'       => 'CreatedDate',
		// Siparişleri sıralama türü? (ASC, DESC)
		'orderByDirection'   => 'ASC',
		// Paket numarasıyla sorgu atılır.	
		'shipmentPackagesId' => '',
	)
);
echo "<pre>";
//print_r($siparisler);
$siparisler=(array)$siparisler;
//print_r($siparisler);
$orderDetails="";
$k=0;
foreach($siparisler as $a){
	//print_r($a);
	$a=(array)$a;
	foreach($a as $b){
		//print_r($b);
		$b=(array)$b;
		foreach($b as $c){
			//print_r($c);
			if(is_string($c)){
				$orderDetails=$orderDetails.strval($c)."*";
				//echo $c."\n";
			}
			elseif(is_float($c)){
				if($c!=0){
					$orderDetails=$orderDetails.strval($c)."*";

				}
			}
			elseif(is_array($c)){
				foreach($c as $d){
					//print_r($d);
					$d=(array)$d;
					
					foreach($d as $e){
						//print_r($e);
						
						if(is_int($e)){
							//echo $e."\n";
							//159272675
							if($e==0){
								$k=1;}
							if($k==3){
	
								$orderDetails=$orderDetails.strval(date('d/m/Y H:i:s',intval(substr(strval($e),0,-3))))."*";
								$k=0;
							}
							elseif($k==2){
								$k=3;
	
							}
							elseif($k==1){
								$k=2;
	
							}
						}
						if(is_string($e)){
							//echo $e."\n";
						}
					}
				}

			}
		}
	}
}
//echo $orderDetails;
$orderDetailsList=explode("*",$orderDetails);

$x=0;
$w=0;
for($i=0;$i<count($orderDetailsList);$i++){
$shipment[$y][$x]=$orderDetailsList[$i];
$x++;
if($w==1){
	$w=2;
}
if($orderDetailsList[$i]==""){
	$w=1;
}
if($w==3){
$y++;
$x=0;
$w=0;
}
if($w==2){
	$w=3;
}
}

//print_r($orderDetailsList);



/* Sipariş detayı getirme
$siparisDetay=$trendyol->order->orderList(
	array(
		// Belirli bir tarihten sonraki siparişleri getirir. Timestamp olarak gönderilmelidir.	
		'startDate'          => strtotime('1st January 2021'),
		// Belirtilen tarihe kadar olan siparişleri getirir. Timestamp olarak gönderilmelidir ve startDate ve endDate aralığı en fazla 2 hafta olmalıdır
		'endDate'            => strtotime('15st January 2021'),
		// Sadece belirtilen sayfadaki bilgileri döndürür	
		'page'               => 0,
		// Bir sayfada listelenecek maksimum adeti belirtir. (Max 200)
		'size'               => 200,
		// Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir	
		'orderNumber'        => '470030641',
		// Siparişlerin statülerine göre bilgileri getirir.	(Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnSupplied)
		'status'             => '',
		// Siparişler neye göre sıralanacak? (PackageLastModifiedDate, CreatedDate)
		'orderByField'       => 'CreatedDate',
		// Siparişleri sıralama türü? (ASC, DESC)
		'orderByDirection'   => 'DESC',
		// Paket numarasıyla sorgu atılır.	
		'shipmentPackagesId' => '',
	)
);

//print_r($siparisDetay);*/

echo "</pre>";

}
echo "<pre>";
function unique_multi_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
  }
 
  $newShipment= unique_multi_array($shipment,'0');
print_r($newShipment);
echo "</pre>";
?>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form method="post" action="siparisCek.php" class="form-control">
	<input type="date" name="start" />
	<input type="date" name="end" />
	<button name="btn">Siparişleri Getir</button>
	
	</form>
</body>
</html>
-->
<?php
/*Tarih seçerek siparişleri getirme

if(isset($_POST['btn'])){
$startDate=strtotime($_POST["start"]);
$endDate=strtotime($_POST["end"]);

$siparisler=$trendyol->order->orderList(
	array(
		// Belirli bir tarihten sonraki siparişleri getirir. Timestamp olarak gönderilmelidir.	
		'startDate'          => $startDate,
		// Belirtilen tarihe kadar olan siparişleri getirir. Timestamp olarak gönderilmelidir ve startDate ve endDate aralığı en fazla 2 hafta olmalıdır
		'endDate'            => $endDate,
		// Sadece belirtilen sayfadaki bilgileri döndürür	
		'page'               => 0,
		// Bir sayfada listelenecek maksimum adeti belirtir. (Max 200)
		'size'               => 200,
		// Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir	
		'orderNumber'        => '',
		// Siparişlerin statülerine göre bilgileri getirir.	(Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnSupplied)
		'status'             => '',
		// Siparişler neye göre sıralanacak? (PackageLastModifiedDate, CreatedDate)
		'orderByField'       => 'CreatedDate',
		// Siparişleri sıralama türü? (ASC, DESC)
		'orderByDirection'   => 'DESC',
		// Paket numarasıyla sorgu atılır.	
		'shipmentPackagesId' => '',
	)
);
echo "<pre>";
//print_r($siparisler);
$siparisler=(array)$siparisler;
//print_r($siparisler);
$orderDetails="";
foreach($siparisler as $a){
	//print_r($a);
	$a=(array)$a;
	foreach($a as $b){
		//print_r($b);
		$b=(array)$b;
		foreach($b as $c){
			//print_r($c);
			if(is_string($c)){
				$orderDetails=$orderDetails.strval($c)."*";
				//echo $c."\n";
			}
			elseif(is_float($c)){
				if($c!=0){
					$orderDetails=$orderDetails.strval($c)."*";

				}
			}
			elseif(is_array($c)){
				foreach($c as $d){
					//print_r($d);
					$d=(array)$d;
					$k=0;
					foreach($d as $e){
						//print_r($e);
						
						if(is_int($e)){
							echo $e."\n";
							//159272675
							if($e==0){
								$k=1;}
							if($k==3){
	
								$orderDetails=$orderDetails.strval($e)."*";
								$k=0;
							}
							elseif($k==2){
								$k=3;
	
							}
							elseif($k==1){
								$k=2;
	
							}
						}
						if(is_string($e)){
							//echo $e."\n";
						}
					}
				}

			}
		}
	}
}
//echo $orderDetails;
$orderDetailsList=explode("*",$orderDetails);
$y=0;
$x=0;
$w=0;
for($i=0;$i<count($orderDetailsList);$i++){
$shipment[$y][$x]=$orderDetailsList[$i];
$x++;
if($w==1){
	$w=2;
}
if($orderDetailsList[$i]==""){
	$w=1;
}
if($w==3){
$y++;
$x=0;
$w=0;
}
if($w==2){
	$w=3;
}
}

//print_r($orderDetailsList);
print_r($shipment);


 Sipariş detayı getirme
$siparisDetay=$trendyol->order->orderList(
	array(
		// Belirli bir tarihten sonraki siparişleri getirir. Timestamp olarak gönderilmelidir.	
		'startDate'          => strtotime('1st January 2021'),
		// Belirtilen tarihe kadar olan siparişleri getirir. Timestamp olarak gönderilmelidir ve startDate ve endDate aralığı en fazla 2 hafta olmalıdır
		'endDate'            => strtotime('15st January 2021'),
		// Sadece belirtilen sayfadaki bilgileri döndürür	
		'page'               => 0,
		// Bir sayfada listelenecek maksimum adeti belirtir. (Max 200)
		'size'               => 200,
		// Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir	
		'orderNumber'        => '470030641',
		// Siparişlerin statülerine göre bilgileri getirir.	(Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnSupplied)
		'status'             => '',
		// Siparişler neye göre sıralanacak? (PackageLastModifiedDate, CreatedDate)
		'orderByField'       => 'CreatedDate',
		// Siparişleri sıralama türü? (ASC, DESC)
		'orderByDirection'   => 'DESC',
		// Paket numarasıyla sorgu atılır.	
		'shipmentPackagesId' => '',
	)
);

//print_r($siparisDetay);
echo "</pre>";



}
*/



?>


