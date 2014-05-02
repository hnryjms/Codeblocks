<?php
/**
* Code Block ACF Field Type
*/
class acf_field_Codeblocks extends acf_field
{
	var $settings, $defaults;
	function __construct() {
		$this->name = 'codeblocks';
		$this->label = __('Codeblocks', CODEBLOCK_LANG);
		$this->category = __('Content', 'acf');
		$this->defaults = array(
			
		);
		
		parent::__construct();
		
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);
	}
	function create_field($field) {
		
		$value = $field['value'];
		if (!is_array($value)) {
			$value = array();
		}
		
		?>
		
		<div class="codeblocks acf_field">
			<?php foreach ($value as $key => $value): ?>
				<div class="code_block" data-language="<?php echo $value['language'] ?>">
					<a href="#" class="remove_block">Remove Block</a>
					
					<label for="codeblock_<?php echo $key ?>_title">Code Block Name</label>
					<input type="text" name="<?php echo $field['name'] ?>[<?php echo $key ?>][title]" value="<?php echo $value['title'] ?>" placeholder="codeblock_<?php echo $key ?>" id="codeblock_<?php echo $key ?>_title">
				
					<label for="codeblock_<?php echo $key ?>_lang">Language</label>
					<select name="<?php echo $field['name'] ?>[<?php echo $key ?>][language]" id="codeblock_<?php echo $key ?>_language">
					</select>
				
					<label for="codeblock_<?php echo $key ?>_code">Code</label>
					<textarea name="<?php echo $field['name'] ?>[<?php echo $key ?>][code]" class="codeblock_value" id="codeblock_<?php echo $key ?>_code"><?php echo $value['code'] ?></textarea>
				</div>
			<?php endforeach ?>
			<div class="code_block add_block" data-field="<?php echo $field['name'] ?>">
				<h1>+ Add Code Block</h1>
			</div>
		</div>
		
		<?php
	}
	function create_options($options) {
		# code...
	}
	function input_admin_enqueue_scripts() {
		wp_enqueue_script('codeblocks_mirror', plugins_url('js/codemirror.js', CODEBLOCKS));
		wp_enqueue_script('codeblocks_mirror_autoload', plugins_url('js/codemirror.autoload.js', CODEBLOCKS));
		$languages = array(
			'none' => '-- Do not highlight code --',
			'c' => 'C',
			'coffeescript' => 'Coffeescript',
			'csharp' => 'C#',
			'css' => 'CSS',
			'd' => 'D',
			'go' => 'Go',
			'haskell' => 'Haskell',
			'html' => 'HTML',
			'java' => 'Java',
			'javascript' => 'Javascript',
			'lua' => 'Lua',
			'php' => 'PHP',
			'python' => 'Python',
			'r' => 'R',
			'ruby' => 'Ruby',
			'scheme' => 'Scheme',
			'shell' => 'Shell',
			'smalltalk' => 'SmallTalk'
		);
		wp_register_script('codeblocks_actions', plugins_url('js/codeblocks.js', CODEBLOCKS), array('jquery', 'codeblocks_mirror', 'codeblocks_mirror_autoload'));
		wp_localize_script('codeblocks_actions', 'codemirror_languages', $languages);
		wp_localize_script('codeblocks_actions', 'codemirror_url', plugins_url('js/codemirror_langs', CODEBLOCKS));
		wp_enqueue_script('codeblocks_actions');
		
		wp_enqueue_style('codeblock_mirror_style', plugins_url('css/codemirror.css', CODEBLOCKS));
		wp_enqueue_style('codeblocks_styles', plugins_url('css/codeblocks.css', CODEBLOCKS));
	}
}

new acf_field_Codeblocks();

?>