/**
 * This source file is subject to the selise.ch for short period of time
 *
 * @category  Core Function
 * @package   Selise_Core
 * @copyright Copyright (c) Selise (https://selise.ch) for short period of time
 * @author    Suvankar Paul <shuvoenr@gmail.com>
 *
 */
define(
    [
        'underscore',
        'Magento_Ui/js/grid/columns/column'
    ],
    function (_, Column) {
        'use strict';

        return Column.extend(
            {
                defaults: {
                    bodyTmpl: 'Selise_Core/grid/cells/status',
                    fieldClass: {
                        'data-grid-thumbnail-cell': true
                    }
                },

                getIsActive: function (record) {
                    return (record[this.index] === 1 || record[this.index] === '1');
                },

                /**
                 * Retrieves label associated with a provided value.
                 *
                 * @returns {String}
                 */
                getLabel: function () {

                    let options = this.options || [],
                        values = this._super(),
                        label = [];

                    if (!Array.isArray(values)) {
                        values = [values];
                    }

                    values = values.map(
                        function (value) {
                            return value + '';
                        }
                    );

                    options.forEach(
                        function (item) {
                            if (_.contains(values, item.value + '')) {
                                label.push(item.label);
                            }
                        }
                    );

                    return label.join(', ');
                }
            }
        );
    }
);
