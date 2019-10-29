/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2016 Addeos (http://www.addeos.com)
 */

define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            initialize: function () {
                this._super();
                this.inputValue = ko.observable('my input value');
            }
        });
    }
);
