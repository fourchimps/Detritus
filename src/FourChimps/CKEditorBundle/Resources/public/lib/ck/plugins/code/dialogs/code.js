CKEDITOR.dialog.add('code', function(editor)
{    
    var parseHtml = function(htmlString) {
        htmlString = htmlString.replace(/<br>/g, '\n');
        htmlString = htmlString.replace(/&amp;/g, '&');
        htmlString = htmlString.replace(/&lt;/g, '<');
        htmlString = htmlString.replace(/&gt;/g, '>');
        htmlString = htmlString.replace(/&quot;/g, '"');
        return htmlString;
    }
    
    var getDefaultOptions = function(options) {
        var options = new Object();
        options.linenumsChecked = null;
        options.linenums = null;
        options.lang = null;
        options.code = '';
        return options;
    }
    
    var getOptionsForString = function(optionsString) {
        var options = getDefaultOptions();
        if (optionsString) {

            if (optionsString.indexOf("lang") > -1) {
                var match = /lang-[ ]{0,1}(\w*)/.exec(optionsString);
                if (match != null && match.length > 0) {
                    options.lang = match[1].replace(/^\s+|\s+$/g, "");
                }
            }

            if (optionsString.indexOf("linenums") > -1) {
                options.linenumsChecked = true;
                var match = /linenums:[ ]{0,1}([0-9]{1,4})/.exec(optionsString);
                if (match != null && match.length > 0 && match[1] > 1) {
                    options.linenums = match[1];
                }
            }
        }
        return options;
    }
    
    var getStringForOptions = function(optionsObject) {
        var result = 'prettyprint';

        if (optionsObject.linenumsChecked) {
            result += ' linenums';
            if (optionsObject.linenums)
                result += ':' + optionsObject.linenums + ';';
        }

        if (optionsObject.lang)
            result += ' lang-' + optionsObject.lang;
        return result;
    }
    
    return {
        title: editor.lang.code.title,
        minWidth: 500,
        minHeight: 400,
        onShow: function() {
            // Try to grab the selected pre tag if any
            var editor = this.getParentEditor();
            var selection = editor.getSelection();
            var element = selection.getStartElement();
            var preElement = element && element.getAscendant('pre', true);
            
            // Set the content for the textarea
            var text = '';
            var optionsObj = null;
            if (preElement) {
                code = parseHtml(preElement.getHtml());
                optionsObj = getOptionsForString(preElement.getAttribute('class'));
                optionsObj.code = code;
            } else {
                optionsObj = getDefaultOptions();
            }
            this.setupContent(optionsObj);
        },
        onOk: function() {
            var editor = this.getParentEditor();
            var selection = editor.getSelection();
            var element = selection.getStartElement();
            var preElement = element && element.getAscendant('pre', true);
            var data = getDefaultOptions();
            this.commitContent(data);
            var optionsString = getStringForOptions(data);
            
            if (preElement) {
                preElement.setAttribute('class', optionsString);
                preElement.setText(data.code);
            } else {
                var newElement = new CKEDITOR.dom.element('pre');
                newElement.setAttribute('class', optionsString);
                newElement.setText(data.code);
                editor.insertElement(newElement);
            }
        },
        contents : [
            {
                id : 'source',
                label : editor.lang.code.sourceTab,
                accessKey : 'S',
                elements :
                [
                    {
                        type : 'vbox',
                        children: [
                            {
                                id: 'cmbLang',
                                type: 'select',
                                labelLayout: 'horizontal',
                                label: editor.lang.code.langLbl,
                                'default': 'php',
                                widths : [ '25%','75%' ],
                                items: [
                                      ['Bash (Shell)', 'bsh'],
                                      ['C', 'c'],
                                      ['C#', 'cs'],
                                      ['C++', 'cpp'],
                                      ['Javascript', 'js'],
                                      ['Java', 'java'],
                                      ['Perl', 'perl'],
                                      ['PHP', 'php'],
                                      ['Python', 'py'],
                                      ['Ruby', 'rb'],
                                      ['XML/XHTML', 'xml']
                                ],
                                setup: function(data) {
                                  if (data.lang)
                                      this.setValue(data.lang);
                                },
                                commit: function(data) {
                                  data.lang = this.getValue();
                                }
                            }
                        ]
                    },
                    {
                        type: 'hbox',
                        widths: [ '25%', '75%' ],
                        children: [
                            {
                                type: 'checkbox',
                                id: 'lc_toggle',
                                label: editor.lang.code.lineNumbers,
                                setup: function(data) {
                                    this.setValue(data.linenumsChecked);
                                },
                                commit: function(data) {
                                    data.linenumsChecked = this.getValue();
                                }
                            },
                            {
                                type: 'text',
                                id: 'default_lc',
                                style: 'width: 15%;',
                                label: editor.lang.code.startAt,
                                setup: function(data) {
                                    if (data.linenums > 1)
                                        this.setValue(data.linenums);
                                },
                                commit: function(data) {
                                    if (this.getValue() && this.getValue() != '')
                                        data.linenums = this.getValue();
                                }
                            }
                        ]
                    },
                    {
                        type: 'textarea',
                        id: 'hl_code',
                        rows: 22,
                        style: "width: 100%",
                        setup: function(data) {
                            if (data.code)
                                this.setValue(data.code);
                        },
                        commit: function(data) {
                            data.code = this.getValue();
                        }
                    }
                ]
            }
        ]
    };
});
