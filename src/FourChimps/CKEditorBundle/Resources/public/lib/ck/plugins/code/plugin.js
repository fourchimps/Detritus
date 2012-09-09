CKEDITOR.plugins.add('code',
{
	requires : [ 'dialog' ],
	lang : [ 'en' ],
	
	init : function(editor)
	{
		var pluginName = 'code';
		var command = editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName) );
		command.modes = { wysiwyg:1, source:1 };
		command.canUndo = false;

		editor.ui.addButton('Code',
		{
				label : editor.lang.code.title,
				command : pluginName,
				icon: this.path + 'images/code.gif'
		});

		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/code.js' );
	}
});

