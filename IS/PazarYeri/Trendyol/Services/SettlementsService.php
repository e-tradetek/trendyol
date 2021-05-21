<?php

namespace IS\PazarYeri\Trendyol\Services;

use IS\PazarYeri\Trendyol\Helper\Request;

Class SettlementsService extends Request
{

	/**
	 *
	 * Default API Url Adresi
	 *
	 * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
	 * @var string
	 *
	 */
	public $apiUrl = 'https://api.trendyol.com/integration/finance/che/sellers/{supplierId}/settlements';

	/**
	 *
	 * Request sınıfı için gerekli ayarların yapılması
	 *
	 * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
	 *
	 */
	public function __construct($supplierId, $username, $password,$testmode)
	{
		parent::__construct($this->apiUrl, $supplierId, $username, $password, $testmode);
	}

	/**
	 *
	 * Trendyol üzerinde siparişleri arar.
	 *
	 * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
	 * @param string $degisken
	 * @return string 
	 *
	 */
	public function settlementsList($data = array())
	{
		

		$query = array(
			'startDate'          => array('format' => 'unixTime'),
			'endDate'            => array('format' => 'unixTime'),
			'page'               => '',
			'size'               => '',
		
			'transactionType'             => array('required' => array('Sale', 'Return', ' Discount', 'Coupon', 'DiscountCancel', 'CouponCancel', 'ProvisionPositive', 'ProvisionNegative')),
			
			
			'shipmentPackagesId' => '',
		);

		return $this->getResponse($query, $data);
	}
	

}
