jQuery(document).ready(function() {
	
	if(jQuery('#pss_textarea').length >= 1) {
	
		var CM = CodeMirror.fromTextArea(document.getElementById("pss_textarea"), {
			lineNumbers: true,
			mode: "css",
			extraKeys: {"Ctrl-Space": "autocomplete"},
			matchBrackets: true,
			styleActiveLine: true
		});
		
		CodeMirror.commands.autocomplete = function(CM) {
			CodeMirror.showHint(CM, CodeMirror.hint.css);
		};
	}
});