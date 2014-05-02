<?php
class Codeblocks {
	public $filter_cache, $filter_data;
	
	public function __construct() {		
		add_action('loaded', array($this, 'loaded'));
		add_action('admin_notices', array($this, 'notices'));

		$this->filter_cache = array(
			'name' => '',
			'iteration' => 0
		);
	}
	public function loaded() {
		if (class_exists('acf')) {
			include 'code-field/acf-field.php';
			include 'acf-group.php';
			
			add_action('wp_enqueue_scripts', array($this, 'scripts'), 11, 1);
			add_shortcode('codeblocks', array($this, 'shortcode'));
			add_shortcode('codeblock', array($this, 'shortcode'));
		}
	}
	public function notices()
	{
		if (!class_exists('acf')) {
			?><div class="error">
	        <p><?php printf(__( 'Codeblocks requires the Advanced Custom Fields plugin. To use Codeblocks, please <a href="%s">install the ACF plugin</a> by Elliot Condon.', CODEBLOCK_LANG), admin_url('plugin-install.php?tab=search&s=advanced+custom+fields&plugin-search-input=Search+Plugins')); ?></p>
	    </div><?php
		}
	}
	function scripts() {
		global $wp_query;
		
		rewind_posts();
		
		if (have_posts()) {
			$languages = array();
			$theme = 'codeblocks';
			
			while (have_posts()) {
				the_post();
				$data = get_field('code_blocks');
				if (!empty($data)) {
					foreach ($data as $chunk) {
						if ($chunk['language'] != 'none') {
							$languages[] = $chunk['language'];
						}
					}
				}
			}
			
			if (count($languages) > 0) {
				$theme_url = plugins_url('css/rainbow/' . $theme . '.css', CODEBLOCKS);
				$theme_url = apply_filters('codeblocks/rainbow_theme', $theme_url);
				if (!is_null($theme_url)) {
					if (is_string($theme_url)) {
						wp_enqueue_style('rainbow-' . $theme, $theme_url);
					}
					wp_enqueue_script('rainbow', plugins_url('js/rainbow.js', CODEBLOCKS));
				}
			}
			
			wp_reset_query();
		}
	}
	public function shortcode($options) {
		if (is_array($options) && array_key_exists('name', $options)) {
			$this->filter_cache['name'] = $options['name'];
		} else {
			$this->filter_cache['name'] = null;
		}

		if (is_null($this->filter_cache['name'])) {
			$this->filter_cache['name'] = 'codeblock_' . $this->filter_cache['iteration'];
		}

		$this->filter_data = get_field('code_blocks');
		$field = array_reduce($this->filter_data, function($o, $e) {
			global $codeblocks;
			if (strlen($e['title']) == 0) {
				// No title, use 'codeblock_0', 'codeblock_1', ...
				$index = array_search($e, $codeblocks->filter_data);
				$e['title'] = 'codeblock_' . $index;
			}
			return $e['title'] == $codeblocks->filter_cache['name'] ? $e : $o;
		});
		
		if ($field) {

			// If they don't use the `name='MY_BLOCK'`, get code blocks in order
			$this->filter_cache['iteration']++;

			return '<pre id="codeblock_' . $field['title'] .
						'" class="codeblock codeblock_' . $field['language'] . '"><code' . (
							(is_array($options) && array_key_exists('highlight', $options) && $options['highlight'] == '0') || $field['language'] == 'none' ?
								'' :
								' data-language="'
									. (is_array($options) && array_key_exists('highlight', $options) ? $options['highlight'] : $field['language']) . '"')
								. '>'

							. htmlentities($field['code'])
					.'</code></pre>';
		}
	}
}
?>