/*
 * Plugin for showing calculator buttons in the text - using an assumed style 
 * i.e. enter becomes <span style="calculator-button">enter</span>
 * 
 * WARNING - This file seems to be aggressively cached - if you make changes to it, clear the browser cache
 *                                    (or waste a few hours chasing ghosts)
 * 
 * Shaun Masterman
 */


	CKEDITOR.plugins.add('baii',
	{
	    requires: ['iframedialog'],
	    init: function(editor)
	    {
	        var mypath     = this.path;
	        var pluginName = 'baii';
	        CKEDITOR.dialog.addIframe( pluginName, 'BA-II', mypath+'plugin.php', 350, 650, function(){
	        		CKEDITOR.dialog.on('resize',function(b){
	        			console.log(b);
	        			
	        		});
	        }
	        , {resizable : CKEDITOR.DIALOG_RESIZE_BOTH});   
	        
	        editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
	        editor.ui.addButton('BA-II',
	        {
	            label: 'Insert Texas Instruments BA-II Buttons',
	            command: pluginName,
	            icon: this.path + 'toolBarButton.png'
	        });
	    }
	});
 
