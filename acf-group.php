<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_codeblocks',
		'title' => 'Codeblocks',
		'fields' => array (
			array (
				'key' => 'field_535d5219d3939',
				'label' => 'Code Blocks',
				'name' => 'code_blocks',
				'type' => 'codeblocks',
				'instructions' => 'Add all of your code blocks here, and access them by using <code>[codeblocks name=\'MY_BLOCK_NAME\']</code> in the content of your post. <em>Note that we use different code highlighters for the editors below and for displaying code on your website&mdash;it will look different on your website and in the editors here</em>.',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>