<?php
/*
 * Plugin Name: thilip WP List Table Example
 * Description: An example of how to use the WP_List_Table class to display data in your WordPress Admin area
 */

if ( is_admin() ) {
	new thilip_Wp_List_Table();
}

/**
 * Thilip_Wp_List_Table class will create the page to load the table
 */
class thilip_Wp_List_Table {

	/**
	 * Constructor will create the menu item
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu_example_list_table_page' ) );
	}

	/**
	 * Menu item will allow us to load the page to display the table
	 */
	public function add_menu_example_list_table_page() {
		add_menu_page( 'Custom Form List', 'Custom Form List', 'manage_options', 'example-list-table.php', array( $this, 'list_table_page' ) );
	}

	/**
	 * Display the list table page
	 *
	 * @return Void
	 */
	public function list_table_page() {
		$exampleListTable = new Example_List_Table();
		$exampleListTable->prepare_items();
		?>
			<div class="wrap">
				<div id="icon-users" class="icon32"></div>
				<h2>Custom Form List Table Page</h2>
				<?php $exampleListTable->display(); ?>
			</div>
		<?php
	}
}

// WP_List_Table is not loaded automatically so we need to load it in our application
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table {

	/**
	 * Prepare the items for the table to process
	 *
	 * @return Void
	 */
	public function prepare_items() {
		$columns  = $this->get_columns();
		$hidden   = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();

		$data = $this->table_data();
		usort( $data, array( &$this, 'sort_data' ) );

		$perPage     = 25;
		$currentPage = $this->get_pagenum();
		$totalItems  = count( $data );

		$this->set_pagination_args(
			array(
				'total_items' => $totalItems,
				'per_page'    => $perPage,
			)
		);

		$data = array_slice( $data, ( ( $currentPage - 1 ) * $perPage ), $perPage );

		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->items = $data;
	}

	/**
	 * Override the parent columns method. Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	public function get_columns() {
		$columns = array(
			'ID'    => 'ID',
			'Name'  => 'Name',
			'Email' => 'Email',
			'Phone' => 'Phone',
		);

		return $columns;
	}

	/**
	 * Define which columns are hidden
	 *
	 * @return Array
	 */
	public function get_hidden_columns() {
		return array();
	}

	/**
	 * Define the sortable columns
	 *
	 * @return Array
	 */
	public function get_sortable_columns() {
		return array(
			'ID'   => array( 'ID', false ),
			'Name' => array( 'Name', false ),
		);
	}

	/**
	 * Get the table data
	 *
	 * @return Array
	 */
	private function table_data() {
		global $wpdb;
		$wpdb_table = 'wp_custom_form';
		$orderby    = ( isset( $_GET['orderby'] ) ) ? esc_sql( $_GET['orderby'] ) : 'ID';
		$order      = ( isset( $_GET['order'] ) ) ? esc_sql( $_GET['order'] ) : 'ASC';

		$user_query = "SELECT
						*
					FROM
						$wpdb_table
					ORDER BY $orderby $order";

		// query output_type will be an associative array with ARRAY_A.
		$query_results = $wpdb->get_results( $user_query, ARRAY_A );

			// return result array to prepare_items.
		return $query_results;
	}

	/**
	 * Define what data to show on each column of the table
	 *
	 * @param  Array  $item        Data
	 * @param  String $column_name - Current column name
	 *
	 * @return Mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'ID':
			case 'Email':
			case 'Phone':
			case 'Name':
				return $item[ $column_name ];

			default:
				return print_r( $item, true );
		}
	}

	/**
	 * Allows you to sort the data by the variables set in the $_GET
	 *
	 * @return Mixed
	 */
	private function sort_data( $a, $b ) {
		// Set defaults
		$orderby = 'ID';
		$order   = 'asc';

		// If orderby is set, use this as the sort column
		if ( ! empty( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
		}

		// If order is set use this as the order
		if ( ! empty( $_GET['order'] ) ) {
			$order = $_GET['order'];
		}

		$result = strcmp( $a[ $orderby ], $b[ $orderby ] );

		if ( $order === 'asc' ) {
			return $result;
		}

		return -$result;
	}
}
?>
