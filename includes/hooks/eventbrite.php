<?php

if (!function_exists('write_log')) {
  function write_log ( $log )  {
    if ( true === WP_DEBUG ) {
      if ( is_array( $log ) || is_object( $log ) ) {
        error_log( print_r( $log, true ) );
      } else {
        error_log( $log );
      }
    }
  }
}

if (class_exists('Keyring_SingleStore')) {
	class IDIIT_Import_Events {
		public $active_connection = false;
		public $eventbrite_field_key = 'field_54381e809fbf5';

		public function __construct() {
			remove_action( 'init', 'eventbrite_api_init' );
			add_action( 'init', array( $this, 'eventbrite_check_existing_token' ), 8, 0 );
			add_action( 'init', array( $this, 'eventbrite_api_init' ), 10, 0 );
			add_action( 'init', array( $this, 'eventbrite_check_connection' ), 9, 0 );
			add_action( 'after_switch_theme', array( $this, 'activate_cron' ), 10, 0 );
			add_action( 'switch_theme', array( $this, 'deactivate_cron' ), 10, 0 );
			add_action( 'idiit_eventbrite_sync', array( $this, 'eventbrite_sync' ), 10, 0 );
			add_action( 'views_edit-event', array( $this, 'render_sync_button' ), 10, 1 );
			add_action( 'manage_event_posts_columns', array( $this, 'register_sync_column' ), 10, 1 );
			add_action( 'manage_event_posts_custom_column', array( $this, 'render_sync_column' ), 10, 2 );
			add_action( 'manage_edit-event_sortable_columns', array( $this, 'sortable_sync_column' ), 10, 1 );
			add_action( 'admin_post_force_eventbrite_sync', array( $this, 'force_eventbrite_sync' ), 10, 0 );
		}

		function eventbrite_check_existing_token() {
			// Bail if Keyring isn't activated.
				if ( ! defined( 'EVENTBRITE__FORCE_USER' ) ) {
					return;
				}
				// Get any Eventbrite tokens we may already have.
				$tokens = Keyring_SingleStore::init()->get_tokens( array( 'service'=>'eventbrite', 'user_id' => EVENTBRITE__FORCE_USER ) );
				// If we have one, just use the first.
				if ( ! empty( $tokens[0] ) ) {
					update_option( 'eventbrite_api_token', $tokens[0]->unique_id );
				}
		}

		function eventbrite_check_connection() {
			// if ( class_exists('Eventbrite_Requirements') ) {
			// 	$this->active_connection = Eventbrite_Requirements::has_active_connection();
			// }
			
			$token = get_option( 'eventbrite_api_token' );
			if ( ! empty( $token ) ) {
				$this->active_connection = true;
			}
		}

		function eventbrite_api_init() {
			if ($this->active_connection && function_exists( 'eventbrite_api_init' ) ) {
				require_once( WP_PLUGIN_DIR . '/eventbrite-api/inc/class-eventbrite-manager.php' );
				require_once( WP_PLUGIN_DIR . '/eventbrite-api/inc/class-eventbrite-query.php' );
				require_once( WP_PLUGIN_DIR . '/eventbrite-api/inc/class-eventbrite-templates.php' );
				require_once( WP_PLUGIN_DIR . '/eventbrite-api/inc/class-eventbrite-event.php' );
				require_once( WP_PLUGIN_DIR . '/eventbrite-api/inc/functions.php' );
			}
		}

		function activate_cron() {
			if ( ! wp_next_scheduled( 'idiit_eventbrite_sync' ) ) {
				wp_schedule_event( time(), 'hourly', 'idiit_eventbrite_sync' );
			}
		}

		function deactivate_cron() {
			wp_clear_scheduled_hook( 'idiit_eventbrite_sync' );
		}

		function eventbrite_sync() {
			if ($this->active_connection) {
				$query = eventbrite_get_events( array( 'status' => 'all' ), true );

				if ( $query instanceof Keyring_Error ) {
					return false;
				}

				for ( $page = $query->pagination->page_number; $page <= $query->pagination->page_count; $page++ ) {
					$query = eventbrite_get_events( array( 'status' => 'all', 'page' => $page ), true );
					foreach ($query->events as $event) {
						$this->import($event);
					}
				}

				update_option( 'idiit_eventbrite_last_run', time() );
			}
		}

		function force_eventbrite_sync() {
			if ( current_user_can( 'edit_posts' ) ) {
				do_action( 'idiit_eventbrite_sync' );
				if ( wp_next_scheduled( 'idiit_eventbrite_sync' ) ) {
					wp_clear_scheduled_hook( 'idiit_eventbrite_sync' );
					wp_reschedule_event( time(), 'hourly', 'idiit_eventbrite_sync' );
				}
			}
			wp_redirect( admin_url( 'edit.php?post_type=event') );
		}

		function render_sync_button( $views ) {
			if ($this->active_connection) {
				get_template_part( 'templates/eventbrite-sync' );
			}
			return $views;
		}

		function register_sync_column( $columns ) {
			if ($this->active_connection) {
				$columns = array_merge( $columns, array( 'idiit_eventbrite_last_sync' => __( 'Last Synced' ) ) );
			}
			return $columns;
		}

		function render_sync_column( $column, $post_id ) {
			if ( $column == 'idiit_eventbrite_last_sync' ) {
				$timestamp = get_post_meta( $post_id, '_idiit_eventbrite_last_sync', true );
				if ( empty( $timestamp ) ) {
					echo '&mdash;';
				} else {
					printf( '<time datetime="%1$s">%2$s ago</time>', date( 'c', time( $timestamp ) ), human_time_diff( $timestamp, time() ) );
				}			
			}
		}

		function sortable_sync_column( $columns ) {
			$columns['idiit_eventbrite_last_sync'] = '_idiit_eventbrite_last_sync';
			return $columns;
		}

		protected function import( $event ) {
			if ( $this->is_imported( $event ) ) {
				$imported = $this->get_imported( $event );
				foreach($imported->posts as $post) {
					$this->update( $event, $post->ID );
				}
			} else {
				$post_id = wp_insert_post( array(
					'post_type' => 'event',
					'post_title' => $event->post_title,
					'post_content' => str_replace("\r\n", '', $event->post_content),
					'post_status' => 'publish'
				) );
				$this->update( $event, $post_id );
			}
		}

		protected function update( $event, $post_id ) {
			if ($post_id) {
				// Update post title and content
				wp_update_post( array(
					'ID' => $post_id,
					'post_title' => $event->post_title,
					'post_content' => str_replace("\r\n", '', $event->post_content)
				) );
				// ACF: rsvp
				if (isset($event->url) && !empty($event->url)) {
					update_field('field_54381e809fbf5', $event->url, $post_id);
				}
				// ACF: start_date
				if (isset($event->start) && !empty($event->start)) {
					update_field('field_5433341ef1801', date('Ymd', strtotime($event->start->local)), $post_id);
				}
				// ACF: start_time
				if (isset($event->start) && !empty($event->start)) {
					update_field('field_54333478f1803', date('g:i a', strtotime($event->start->local)), $post_id);
				}
				// ACF: end_date
				if (isset($event->end) && !empty($event->end)) {
					update_field('field_54333469f1802', date('Ymd', strtotime($event->end->local)), $post_id);
				}
				// ACF: end_time
				if (isset($event->end) && !empty($event->end)) {
					update_field('field_543334a8f1804', date('g:i a', strtotime($event->end->local)), $post_id);
				}
				// ACF: venue_name
				if (isset($event->venue) && !empty($event->venue)) {
					update_field('field_543334d1f1805', $event->venue->name, $post_id);
				}
				// ACF: location
				if (isset($event->venue) && !empty($event->venue)) {
					update_field('field_543335460dd1a', array(
						'address' => $this->parse_address($event->venue->address),
						'lat' => $event->venue->latitude,
						'lng' => $event->venue->longitude
					), $post_id);
				}

				if (isset($event->logo_url) && !empty($event->logo_url)) {
					$this->set_post_thumbnail( $post_id, $event );
				}

				update_post_meta( $post_id, '_idiit_eventbrite_id', $event->ID );
				update_post_meta( $post_id, '_idiit_eventbrite_last_sync', time() );
			}
		}

		protected function parse_address($address) {
			extract((array) $address);
			$return = "$address_1 $address_2, $city, $region, $postal_code";
			if ('US' !== $country) {
				$return .= ", $country";
			}
			return $return;
		}

		protected function get_imported( $event ) {
			return new WP_Query( array(
				'meta_key' => '_idiit_eventbrite_id',
				'meta_value' => $event->ID,
				'nopaging' => true,
				'post_type' => 'event',
				'post_status' => 'any',
			) );
		}

		protected function is_imported( $event ) {
			return $this->get_imported( $event )->have_posts();
		}

		protected function set_post_thumbnail( $post_id, $event ) {
			if ( has_post_thumbnail( $post_id ) ) {
				wp_delete_attachment( get_post_thumbnail_id( $post_id ), true );
			}

			$logo_url = rawurldecode( $event->logo_url );
			$logo_url = str_replace( 'https://img.evbuc.com/', '', $logo_url );
			$logo_url = urldecode( strtok( $logo_url, '?' ) );

			if ( filter_var($logo_url, FILTER_VALIDATE_URL) !== FALSE ) {
				$upload_dir = wp_upload_dir();
				$image_data = file_get_contents( $logo_url );
				$extension = '.' . pathinfo( $logo_url, PATHINFO_EXTENSION );
				$filename = basename( $logo_url, $extension ) . $event->ID . $extension;

				if ( wp_mkdir_p( $upload_dir['path'] ) ) {
					$path = $upload_dir['path'];
				} else {
					$path = $upload_dir['basedir'];
				}

				$filename = wp_unique_filename( $path, $filename );
				$file = $path . '/' . $filename;
				file_put_contents( $file, $image_data );
				$wp_filetype = wp_check_filetype( $filename, null );
				
				$attachment = array(
				    'post_mime_type' => $wp_filetype['type'],
				    'post_title' => $filename,
				    'post_content' => '',
				    'post_status' => 'inherit'
				);

				$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				set_post_thumbnail( $post_id, $attach_id );
			}
		}
	}

	new IDIIT_Import_Events;
}
