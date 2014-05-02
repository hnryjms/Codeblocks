jQuery(function($){
	var editors = [];
	
	CodeMirror.modeURL = codemirror_url + "/%N.js";
	
	var ConfigureBlock = function(element) {
		var text = $("textarea", element)[0];
		var editor = CodeMirror.fromTextArea(text, {
			mode: 'text/plain',
			lineNumbers: true,
			indentWithTabs: true,
			indentUnit: 4
		});
		var index = editors.length;
		editors.push(editor);
		$("select", element).change(function(){
			var language = $(this).val();
			if (language == 'c' || language == 'csharp') {
				language = 'clike';
			} else if (language == 'html') {
				language = 'htmlmixed';
			}
			
			if (language == 'none') {
				editor.setOption('mode', 'text/plain');
			} else {
				editor.setOption('mode', language);
				CodeMirror.autoLoadMode(editor, language);
			}
		});
		$(".remove_block", element).click(function(){
			var canDelete = confirm('Are you sure you want to remove this block of code?');
			
			if (canDelete) {
				editors.splice(index, 1);
				$(this).parent().remove();
				var field = $(".codeblocks .code_block.add_block").attr("data-field");
				$(".codeblocks .code_block").each(function(i, e){
					$("input", e).attr('placeholder', 'codeblock_' + i);
					$("input", e).attr('name', field + '[' + i + '][title]');
				
					$("select", e).attr('name', field + '[' + i + '][language]');
				
					$(".codeblock_value", e).attr('name', field + '[' + i + '][code]');
				});
			}
			
			return false;
		});
		$.each(codemirror_languages, function(key, value) {   
		     $('select', element).append($("<option></option>").attr("value", key).text(value)); 
		});
		var language = $(element).attr("data-language");
		if (language) {
			console.log('Lang::', language);
			$("select", element).val(language).trigger('change');
		}
	}
	
	$(".codeblocks .code_block:not(.add_block)").each(function(i, e) {
		ConfigureBlock(e);
	});
	$(".codeblocks .code_block.add_block").click(function(){
		var field = $(this).attr("data-field");
		var block = $('<div class="code_block"><a href="#" class="remove_block">Remove Block</a><label for="codeblock_' + editors.length + '_title">Code Block Name</label><input type="text" name="' + field + '[' + editors.length + '][title]" placeholder="codeblock_' + editors.length + '" id="codeblock_' + editors.length + '_title"><label for="codeblock_' + editors.length + '_lang">Language</label><select name="' + field + '[' + editors.length + '][language]" id="codeblock_' + editors.length + '_language"></select><label for="codeblock_' + editors.length + '_code">Code</label><textarea name="' + field + '[' + editors.length + '][code]" id="codeblock_' + editors.length + '_code"></textarea></div>');
		$(this).before(block);
		ConfigureBlock(block);
		$("input", block).focus();
	});
});