(function() {
	var a= {
		exec:function(editor){

			var fragment = editor.getSelection().getRanges()[0].extractContents()
			var container = CKEDITOR.dom.element.createFromHtml("<span class='calculator-button'/>", editor.document)
			fragment.appendTo(container)
			editor.insertElement(container)			
			
		}
	},
	b='baii';
	CKEDITOR.plugins.add(b,{
		init:function(c){
			c.addCommand(b,a);
			c.ui.addButton('BA-II',{
				label:'BA-II Button',
				icon: this.path + 'toolBarButton.png',
				command:b
			});
		}
	});
 })(); 
