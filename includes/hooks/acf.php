<?php

class ReverseRelation {
	protected $relationships = array();

	public function __construct() {
		add_action( 'acf/load_field/type=relationship', array($this, 'find_relationship_fields') );
		add_action( 'acf/save_post', array($this, 'update_reverse_relations'), 1 );
		add_action( 'acf/fields/relationship/query/key=field_55072323dc16d', array($this, 'relationship_query'), 10, 3);
	}

	public function get_field_keys($post, $post_type, $return = array()) {
		$field_groups = apply_filters('acf/location/match_field_groups', null, array( 'post_type' => $post->post_type ));

		foreach ($field_groups as $field_group):
			$fields = apply_filters('acf/field_group/get_fields', array(), $field_group);
			foreach ($fields as $field):
				if ($field['type'] === 'relationship' && in_array($post_type, $field['post_type']))
					$return[] = $field;
			endforeach;
		endforeach;

		return $return;
	}

	public function find_relationship_fields($field) {
		if (!in_array($field, $this->relationships))
			$this->relationships[] = $field;
		return $field;
	}

	public function update_reverse_relations($post_id) {
		// bail if this is a revision
		if ( $parent_id = wp_is_post_revision( $post_id ) ) {
			return;
		}

		// bail early if no ACF data
		if ( empty($_POST['fields']) ) {
			return;
		}

		// unhook this function so it doesn't loop infinitely
		remove_action( 'acf/save_post', array($this, 'update_reverse_relations') );

		$post_type = get_post_type($post_id);

		foreach($this->relationships as $relationship):
			$updated = array_map('intval', $_POST['fields'][$relationship['key']] ?: array());
			$current = get_field($relationship['name'], $post_id) ?: array();
			$added = array_diff($updated, $current);
			$removed = array_diff($current, $updated);
			$changed = array_merge( $removed, $added );

			if (!empty($changed)):
				$posts = get_posts( array(
					'post_type' => $relationship['name'],
					'post__in' => $changed
				));

				foreach ($posts as $post):
					$fields = $this->get_field_keys($post, $post_type);
					foreach ($fields as $field):
						$value = get_field($field['key'], $post->ID) ?: array();

						if (in_array($post->ID, $added)) {
							$value[] = $post_id;
						} else {
							$i = array_search( $post_id, $value );
							unset($value[$i]);
						}

						update_field( $field['key'], array_unique($value), $post->ID );
					endforeach;
				endforeach;
			endif;
		endforeach;

		// re-hook this function
		add_action( 'acf/save_post', array($this, 'update_reverse_relations'), 1 );
	}

	public function relationship_query( $args, $field, $post ) {
		$args['post__in'] = get_field('person', $post);
		return $args;
	}
}

new ReverseRelation();
