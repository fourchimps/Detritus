/*
 */

(function ($) {
    $.widget("ui.tagfield", {

        // default options
        options:{
            //Maps directly to the jQuery-ui Autocomplete option
            tagSource:[],
            //What keys should trigger the completion of a tag
            triggerKeys:['enter', 'space', 'comma', 'tab'],
            //array method for setting initial tags
            initialTags:[],
            //minimum length of tags
            minimumLength:1,
            //if false only tags from `tagSource` are able to be entered
            allowNewTags:true,
            //should tag and Tag be treated as identical
            caseSensitive:false,
            //should tags be drag-and-drop sortable?
            sortable:false,
            //color to highlight text when a duplicate tag is entered
            highlightOnExistColor:'#0F0',
            //empty search on focus
            emptySearch:true,
            //callback function for when tags are changed
            //tagValue: value of tag that was changed
            //action e.g. removed, added, sorted
            tagsChanged:function (tagValue, action, element) {
                ;
            },
            maxTags:undefined,
            //should 'paste' event trigger 'blur', thus potentially adding a new tag
            // (true for backwards compatibility)
            blurOnPaste:true,
            // Attributes of a hidden input field that should be rendered to help form submission
            inputBridge:false,
        },

        _splitAt:/\ |,/g,
        _existingAtIndex:0,
        _keys:{
            backspace:[8],
            enter:[13],
            space:[32],
            comma:[44, 188],
            tab:[9]
        },

        _sortable:{
            sorting:-1
        },

        //initialization function
        _create:function () {

            var self = this;
            this.tagsArray = [];
            this.timer = null;

            //add class "tagfield" for theming
            this.element.addClass("tagfield");

            //add any initial tags added through html to the array
            this.element.children('li').each(function () {
                var tag = $(this);
                var tagValue = tag.attr('tagValue') || tag.data('value');
                self.options.initialTags.push({label:tag.text(), value:(tagValue ? tagValue : tag.text())});
            });

            //setup split according to the trigger keys
            self._splitAt = null;
            if ($.inArray('space', self.options.triggerKeys) > 0 && $.inArray('comma', self.options.triggerKeys) > 0)
                self._splitAt = /\ |,/g;
            else if ($.inArray('space', self.options.triggerKeys) > 0)
                self._splitAt = /\ /g;
            else if ($.inArray('comma', self.options.triggerKeys) > 0)
                self._splitAt = /,/g;

            //add the html input
            this.element.html('<li class="tagfield-new"><input class="tagfield-input" type="text" /></li>');

            this.input = this.element.find(".tagfield-input");

            //setup click handler
            $(this.element).click(function (e) {
                if ($(e.target).hasClass('tagfield-close')) {
                    // Removes a tag when the little 'x' is clicked.
                    var parent = $(e.target).parent();

                    var tag = self.tagsArray[parent.index()];

                    tag.element.remove();
                    self._popTag(tag);
                }
                else {
                    self.input.focus();
                    if (self.options.emptySearch && $(e.target).hasClass('tagfield-input') && self.input.val() == '' && self.input.autocomplete != undefined) {
                        self.input.autocomplete('search');
                    }
                }
            });

            //setup autocomplete handler
            this.options.appendTo = this.element;
            this.options.source = this.options.tagSource;
            this.options.select = function (event, ui) {
                self.input.data('autoCompleteTag', true);
                clearTimeout(self.timer);
                if (self.options.maxTags !== undefined && self.tagsArray.length == self.options.maxTags) {
                    self.input.val("");
                }
                else {
                    if (ui.item.label === undefined)
                        self._addTag(ui.item.value);
                    else
                        self._addTag(ui.item.label, ui.item.value);
                }

                return false;
            },
            this.options.focus = function (event, ui) {
                if (ui.item.label !== undefined && /^key/.test(event.originalEvent.originalEvent.type)) {
                    self.input.val(ui.item.label);
                    self.input.data('value', ui.item.value);
                    return false;
                }
            };
            this.options.autoFocus = !this.options.allowNewTags;
            this.input.autocomplete(this.options);

            this.input.keyup(function(){
                self._lengthCheck(this);
            });

            //setup keydown handler
            this.input.keydown(function (e) {

                var lastLi = self.element.children(".tagfield-choice:last");
                if (e.which == self._keys.backspace)
                    return self._backspace(lastLi);

                if (self._isInitKey(e.which) && !(self._isTabKey(e.which) && this.value == '' && !self.input.data('autoCompleteTag'))) {
                    e.preventDefault();

                    self.input.data('autoCompleteTag', false);

                    if (!self.options.allowNewTags || (self.options.maxTags !== undefined && self.tagsArray.length == self.options.maxTags)) {
                        self.input.val("");
                    }
                    else if (self.options.allowNewTags && $(this).val().length >= self.options.minimumLength) {
                        self._addTag($(this).val());
                    }
                }

                if (self.options.maxLength !== undefined && self.input.val().length == self.options.maxLength) {
                    e.preventDefault();
                }

                if (lastLi.hasClass('selected'))
                    lastLi.removeClass('selected');

                self.lastKey = e.which;
            });

            this.input.focus(function() {
                self._lengthCheck(this);
            });

            this.input.bind("paste", function (e) {
                if (self.options.blurOnPaste) {
                    var input = $(this);
                    self.timer = setTimeout(function () { input.blur(); }, 0);
                }
            });

            //setup blur handler
            this.input.blur(function (e) {
                self.currentLabel = $(this).val();
                self.currentValue = $(this).data('value');
                if (self.currentLabel.trim().length >= self.options.minimumLength) {
                    if (self.options.allowNewTags) {
                        self.timer = setTimeout(function () {
                            self._addTag(self.currentLabel, self.currentValue);
                            self.currentValue = '';
                            self.currentLabel = '';
                        }, 400);
                    }
                }
                $(this).val('').removeData('value');

                self.element.removeClass("uierror");
                self.element.removeClass("uiactive");

                return false;
            });

            //define missing trim function for strings
            if (!String.prototype.trim) {
                String.prototype.trim = function () {
                    return this.replace(/^\s+|\s+$/g, '');
                };
            }

            if (this.options.inputBridge) {
                this.inputBridge = $('<input ' + this.options.inputBridge +'/>');
                this.element.after(this.inputBridge);
            }

            this._initialTags();

            //setup sortable handler
            if (self.options.sortable !== false) {

                var soptions = {
                    items:'.tagfield-choice',
                    containment:'parent',
                    opacity: 0.6,
                    tolerance: 'pointer',
                    start:function (event, ui) {
                        self._sortable.tag = $(ui.item);
                        self._sortable.origIndex = self._sortable.tag.index();
                    },
                    update:function (event, ui) {
                        self._sortable.newIndex = self._sortable.tag.index();
                        self._moveTag(self._sortable.origIndex, self._sortable.newIndex);
                        if(self.options.tagsChanged){
                            var tag = self.tagsArray[self._sortable.newIndex];
                            self.options.tagsChanged(tag.value, 'moved', tag.element);
                        }
                    }
                };

                self.element.sortable(soptions);
            }

        },

        _lengthCheck: function(input) {
            if ($(input).val().trim().length < this.options.minimumLength) {
                this.element.addClass("uierror");
                this.element.removeClass("uiactive");
            } else {
                this.element.removeClass("uierror");
                this.element.addClass("uiactive");
            }
        },

        _popTag:function (tag) {

            //are we removing the last tag or a specific tag?
            if (tag === undefined)
                tag = this.tagsArray.pop();
            else
                this.tagsArray.splice(tag.index, 1);


            //maintain the indexes
            for (var ind in this.tagsArray)
                this.tagsArray[ind].index = ind;

            if (this.options.tagsChanged)
                this.options.tagsChanged(tag.value || tag.label, 'popped', tag);
            this._updateInputBridge();
            return;
        },

        _addTag:function (label, value) {
            this.input.autocomplete('close').val("");

            //are we trying to add a tag that should be split?
            if (this._splitAt && label.search(this._splitAt) > 0) {
                var result = label.split(this._splitAt);
                for (var i = 0; i < result.length; i++)
                    this._addTag(result[i], value);
                return;
            }

            label = label.replace(/,+$/, "").trim();

            if (label == "")
                return false;

            var tagExists = this._exists(label, value);
            if (tagExists !== false) {
                this._highlightExisting(tagExists);
                return false;
            }

            var tag = this.tag(label, value);
            tag.element = $('<li class="tagfield-choice"'
                + (value !== undefined ? ' tagValue="' + value + '"' : '') + '>'
                + label + '<a class="tagfield-close">x</a></li>');
            tag.element.insertBefore(this.input.parent());
            this.tagsArray.push(tag);

            this.input.val("");

            if (this.options.tagsChanged)
                this.options.tagsChanged(tag.label, 'added', tag.element);

            this._updateInputBridge();
            return true;
        },

        _updateInputBridge: function() {
            if (this.options.inputBridge) {
                var nakedTags = new Array();
                for(i in this.tagsArray) {
                    nakedTags.push(this.tagsArray[i].value);
                }
                this.inputBridge.val(JSON.stringify(nakedTags));
            }
        },

        _exists:function (label, value) {
            if (this.tagsArray.length == 0)
                return false;

            label = this._lowerIfCaseInsensitive(label);
            value = this._lowerIfCaseInsensitive(value);

            for (var ind in this.tagsArray) {
                if (this._lowerIfCaseInsensitive(this.tagsArray[ind].label) == label) {
                    if (value !== undefined) {
                        if (this._lowerIfCaseInsensitive(this.tagsArray[ind].value) == value)
                            return ind;
                    } else {
                        return ind;
                    }
                }
            }

            return false;
        },

        _highlightExisting:function (index) {
            if (this.options.highlightOnExistColor === undefined)
                return;
            var tag = this.tagsArray[index];
            tag.element.stop();

            var initialColor = tag.element.css('color');
            tag.element.animate({color:this.options.highlightOnExistColor}, 100).animate({'color':initialColor}, 800);
        },

        _isInitKey:function (keyCode) {
            var keyName = "";
            for (var key in this._keys)
                if ($.inArray(keyCode, this._keys[key]) != -1)
                    keyName = key;

            if ($.inArray(keyName, this.options.triggerKeys) != -1)
                return true;
            return false;
        },

        _isTabKey:function (keyCode) {
            var tabKeys = this._keys['tab'];
            return $.inArray(keyCode, tabKeys) > -1;
        },

        _removeTag:function () {
            this._popTag();
            this.element.children(".tagfield-choice:last").remove();
        },

        _backspace:function (li) {
            if (this.input.val() == "") {
                // When backspace is pressed, the last tag is deleted.
                if (this.lastKey == this._keys.backspace) {
                    this._popTag();
                    li.remove();
                    this.lastKey = null;
                } else {
                    li.addClass('selected');
                    this.lastKey = this._keys.backspace;
                }
            }
            return true;
        },

        _initialTags:function () {
            var input = this;
            var _temp;
            if (this.options.tagsChanged)
                _temp = this.options.tagsChanged;
            this.options.tagsChanged = null;

            if (this.options.initialTags.length != 0) {
                $(this.options.initialTags).each(function (i, element) {
                    if (typeof (element) == "object")
                        input._addTag(element.label, element.value);
                    else
                        input._addTag(element);
                });
            }
            this.options.tagsChanged = _temp;
        },

        _lowerIfCaseInsensitive:function (inp) {

            if (inp === undefined || typeof(inp) != typeof("a"))
                return inp;

            if (this.options.caseSensitive)
                return inp;

            return inp.toLowerCase();

        },

        _moveTag: function (old_index, new_index) {
            this.tagsArray.splice(new_index, 0, this.tagsArray.splice(old_index, 1)[0]);
            for (var ind in this.tagsArray)
                this.tagsArray[ind].index = ind;
        },

        tags:function () {
            return this.tagsArray;
        },

        destroy:function () {
            $.Widget.prototype.destroy.apply(this, arguments); // default destroy
            this.tagsArray = [];
        },

        reset:function () {
            this.element.find(".tagfield-choice").remove();
            this.tagsArray = [];
            this._initialTags();
            if (this.options.tagsChanged)
                this.options.tagsChanged(null, 'reset', null);
        },

        fill:function (tags) {

            if (tags !== undefined)
                this.options.initialTags = tags;
            this.reset();
        },

        add:function (label, value) {
            if(typeof(label) == "object")
                return this._addTag(label.label, label.value);
            else
                return this._addTag(label, value);
        },

        autocomplete: function(){
            return this.input.data("autocomplete");
        },

        tag:function (label, value, element) {
            var self = this;
            return {
                label:label,
                value:(value === undefined ? label : value),
                element:element,
                index:self.tagsArray.length
            };
        },

        remove:function (label, value) {
            if (this.tagsArray.length == 0)
                return false;

            label = this._lowerIfCaseInsensitive(label);
            value = this._lowerIfCaseInsensitive(value);

            for (var i = 0; i < this.tagsArray.length; i++) {
                if (this._lowerIfCaseInsensitive(this.tagsArray[i].value) == value || this._lowerIfCaseInsensitive(this.tagsArray[i].label) == label) {
                    break;
                }
            }

            if (i >= 0 && i < this.tagsArray.length) {
                var tag = this.tagsArray[i];
                tag.element.remove();
                this._popTag(tag);
                return true;
            }
            return false;
        }


    });
})(jQuery);