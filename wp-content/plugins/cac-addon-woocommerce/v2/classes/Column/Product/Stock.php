<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @since 1.1
 */
class ACA_WC_Column_Product_Stock extends AC_Column
	implements ACP_Column_EditingInterface {

	public function __construct() {
		$this->set_type( 'is_in_stock' );
		$this->set_original( true );
	}

	// Pro

	public function editing() {
		return new ACA_WC_Editing_Product_Stock( $this );
	}

}
