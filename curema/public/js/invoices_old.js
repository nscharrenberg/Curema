$(function() {
    // Init bootstrap selectpicker
    init_selectpicker();

    // Invoices to merge
    $('body').on('change', 'input[name="invoices_to_merge[]"]', function() {
        var checked = $(this).prop('checked');
        var _id = $(this).val();
        if (checked == true) {
            $.get(admin_url + 'invoices/get_merge_data/' + _id, function(response) {
                $.each(response.items, function(i, obj) {
                    if (obj.rel_type != '') {
                        if (obj.rel_type == 'task') {
                            $('input[name="task_id"]').val(obj.item_related_formatted_for_input);
                        } else if (obj.rel_type == 'expense') {
                            $('input[name="expense_id"]').val(obj.item_related_formatted_for_input);
                        }
                    }
                    add_item_to_table(obj, 'undefined', _id);
                });
            }, 'json');
        } else {
            // Remove the appended invoice to merge
            $('body').find('[data-merge-invoice="' + _id + '"]').remove();
        }
    });

    // Remove the disabled attribute from the currency input becuase the form dont read it
    $('body').on('submit', '._transaction_form', function() {
        // On submit re-calculate total and reorder the items for all cases
        calculate_total();
        reorder_items();
        $('select[name="currency"]').prop('disabled', false);
        $('select[name="project_id"]').prop('disabled', false);
        return true;
    });

    // Remove the disabled attribute from the currency input becuase the form dont read it
    $('body').on('submit', '._transaction_form', function() {
        // On submit re-calculate total and reorder the items for all cases
        calculate_total();
        reorder_items();
        $('select[name="currency"]').prop('disabled', false);
        $('select[name="project_id"]').prop('disabled', false);
        return true;
    });

    // Recaulciate total on these changes
    $('body').on('change', 'input[name="adjustment"],select.tax', function() {
        calculate_total();
    });

    // Discount type for estimate/invoice
    $('body').on('change', 'select[name="discount_type"]', function() {
        // if discount_type == ''
        if ($(this).val() == '') {
            $('input[name="discount_percent"]').val(0);
        }
        // Recalculate the total
        calculate_total();
    });

    // In case user enter discount percent but there is no discount type set
    $('body').on('change', 'input[name="discount_percent"]', function() {
        if ($('select[name="discount_type"]').val() == '' && $(this).val() != 0) {
            alert('You need to select discount type');
            $('html,body').animate({
                    scrollTop: 0
                },
                'slow');
            $('#wrapper').highlight($('label[for="discount_type"]').text());
            setTimeout(function() {
                $('#wrapper').unhighlight();
            }, 3000);
            return false;
        }
        if ($(this).valid() == true) {
            calculate_total();
        }
    });

});

// Append the added items to the preview to the table as items
function add_item_to_table(data, itemid) {
    // If not custom data passed get from the preview
    if (typeof(data) == 'undefined' || data == 'undefined') {
        data = get_main_values();
    }

    if (data.description === "" && data.long_description === "" && data.rate === "") {
        return;
    }

    var table_row = '';
    var unit_placeholder = '';
    var item_key = $('body').find('tbody .item').length + 1;
    table_row += '<tr class="sortable item">';
    table_row += '<td class="dragger">';
    // Check if quantity is number
    if (isNaN(data.qty)) {
        data.qty = 1;
    }
    // Check if rate is number
    if (data.rate == '' || isNaN(data.rate)) {
        data.rate = 0;
    }

    var amount = data.rate * data.qty;
    amount = accounting.formatNumber(amount);
    var tax_name = 'newitems[' + item_key + '][taxname][]';
    $('body').append('<div class="dt-loader"></div>');
    var regex = /<br[^>]*>/gi;

    get_taxes_dropdown_template(tax_name, data.taxname).done(function(tax_dropdown) {
        // order input
        table_row += '<input type="hidden" class="order" name="newitems[' + item_key + '][order]">';
        table_row += '</td>';
        table_row += '<td class="bold description"><textarea name="newitems[' + item_key + '][description]" class="form-control" rows="5">' + data.description + '</textarea></td>';
        table_row += '<td><textarea name="newitems[' + item_key + '][long_description]" class="form-control item_long_description" rows="5">' + data.long_description.replace(regex, "\n") + '</textarea></td>';
        table_row += '<td><input type="number" min="0" onblur="calculate_total();" onchange="calculate_total();" data-quantity name="newitems[' + item_key + '][qty]" value="' + data.qty + '" class="form-control">';

        unit_placeholder = '';
        if (!data.unit || typeof(data.unit) == 'undefined') {
            unit_placeholder = appLang.unit;
            data.unit = '';
        }

        table_row += '<input type="text" placeholder="' + unit_placeholder + '" name="newitems[' + item_key + '][unit]" class="form-control input-transparent text-right" value="' + data.unit + '">';

        table_row += '</td>';
        table_row += '<td class="rate"><input type="number" data-toggle="tooltip" title="' + appLang.item_field_not_formatted + '" onblur="calculate_total();" onchange="calculate_total();" name="newitems[' + item_key + '][rate]" value="' + data.rate + '" class="form-control"></td>';
        table_row += '<td class="taxrate">' + tax_dropdown + '</td>';
        table_row += '<td class="amount">' + amount + '</td>';
        table_row += '<td><a href="#" class="btn btn-danger pull-left" onclick="delete_item(this,' + itemid + '); return false;"><i class="fa fa-trash"></i></a></td>';
        table_row += '</tr>';

        $('table.items tbody').append(table_row);

        $(document).trigger({
            type: "item-added-to-table",
            data: data,
            row: table_row
        });

        setTimeout(function() {
            calculate_total();
        }, 15);

        var billed_task = $('input[name="task_id"]').val();
        var billed_expense = $('input[name="expense_id"]').val();
        if (billed_task != '' && typeof(billed_task) != 'undefined') {
            billed_tasks = billed_task.split(',');
            $.each(billed_tasks, function(i, obj) {
                $('#billed-tasks').append(hidden_input('billed_tasks[' + item_key + '][]', obj));
            });
        }

        if (billed_expense != '' && typeof(billed_expense) != 'undefined') {
            billed_expenses = billed_expense.split(',');
            $.each(billed_expenses, function(i, obj) {
                $('#billed-expenses').append(hidden_input('billed_expenses[' + item_key + '][]', obj));
            });
        }

        init_selectpicker();
        clear_main_values();
        reorder_items();

        $('body').find('.dt-loader').remove();
        $('#item_select').selectpicker('val', '');
        return true;
    });
    return false;
}

// Get the preview main values
function get_main_values() {
    var response = {};
    response.description = $('.main textarea[name="name"]').val();
    response.long_description = $('.main textarea[name="description"]').val();
    response.qty = $('.main input[name="quantity"]').val();
    response.taxname = $('.main select.tax').selectpicker('val');
    response.rate = $('.main input[name="rate"]').val();
    response.unit = $('.main input[name="unit"]').val();
    return response;
}

// Get taxes dropdown selectpicker template / Causing problems with ajax becuase is fetching from server
function get_taxes_dropdown_template(name, tax) {
    jQuery.ajaxSetup({
        async: false
    });

    var d = $.post(admin_url + 'misc/get_taxes_dropdown_template/', {
        name: name,
        tax: tax
    });

    jQuery.ajaxSetup({
        async: true
    });

    return d;
}

// Calculate invoice total - NOT RECOMENDING EDIT THIS FUNCTION BECUASE IS VERY SENSITIVE
function calculate_total() {

    var calculated_tax,
        taxrate,
        item_taxes,
        row,
        _amount,
        _tax_name,
        taxes = {},
        taxes_rows = [],
        subtotal = 0,
        total = 0,
        quantity = 1;
    total_discount_calculated = 0,
        rows = $('.table.table-main-invoice-edit tbody tr.item,.table.table-main-estimate-edit tbody tr.item'),
        adjustment = $('input[name="adjustment"]').val(),
        discount_area = $('tr#discount_percent'),
        discount_percent = $('input[name="discount_percent"]').val();
    discount_type = $('select[name="discount_type"]').val();

    $('.tax-area').remove();

    $.each(rows, function() {
        quantity = $(this).find('[data-quantity]').val();
        if (quantity == '') {
            quantity = 1;
            $(this).find('[data-quantity]').val(1);
        }

        _amount = parseFloat($(this).find('td.rate input').val()) * quantity;
        $(this).find('td.amount').html(accounting.formatNumber(_amount));
        subtotal += _amount;
        row = $(this);
        item_taxes = $(this).find('select.tax').selectpicker('val');

        if (item_taxes) {
            $.each(item_taxes, function(i, taxname) {
                taxrate = row.find('select.tax [value="' + taxname + '"]').data('taxrate');
                calculated_tax = (_amount / 100 * taxrate);
                if (!taxes.hasOwnProperty(taxname)) {
                    if (taxrate != 0) {
                        _tax_name = taxname.split('|');
                        tax_row = '<tr class="tax-area"><td>' + _tax_name[0] + '(' + taxrate + '%)</td><td id="tax_id_' + slugify(taxname) + '"></td></tr>';
                        $(discount_area).after(tax_row);
                        taxes[taxname] = calculated_tax;
                    }
                } else {
                    // Increment total from this tax
                    taxes[taxname] = taxes[taxname] += calculated_tax;
                }
            });
        }
    });

    if (discount_percent != '' && discount_type == 'before_tax') {
        // Calculate the discount total
        total_discount_calculated = (subtotal * discount_percent) / 100;
    }

    $.each(taxes, function(taxname, total_tax) {
        if (discount_percent != '' && discount_type == 'before_tax') {
            total_tax_calculated = (total_tax * discount_percent) / 100;
            total_tax = (total_tax - total_tax_calculated);
        }
        total += total_tax;
        total_tax = accounting.formatNumber(total_tax)
        $('#tax_id_' + slugify(taxname)).html(total_tax);
    });

    total = (total + subtotal);

    if (discount_percent != '' && discount_type == 'after_tax') {
        // Calculate the discount total
        total_discount_calculated = (total * discount_percent) / 100;
    }

    total = total - total_discount_calculated;
    adjustment = parseFloat(adjustment);

    // Check if adjustment not empty
    if (!isNaN(adjustment)) {
        total = total + adjustment;
    }

    // Append, format to html and display
    $('.discount_percent').html('-' + accounting.formatNumber(total_discount_calculated) + hidden_input('discount_percent', discount_percent) + hidden_input('discount_total', total_discount_calculated));
    $('.adjustment').html(accounting.formatNumber(adjustment) + hidden_input('adjustment', accounting.toFixed(adjustment, app_decimal_places)))
    $('.subtotal').html(accounting.formatNumber(subtotal) + hidden_input('subtotal', accounting.toFixed(subtotal, app_decimal_places)));
    $('.total').html(format_money(total) + hidden_input('total', accounting.toFixed(total, app_decimal_places)));
    $(document).trigger('sales-total-calculated');
}

// Init bootstrap select picker
function init_selectpicker() {
    var select_pickers = $('body').find('select.selectpicker');
    if (select_pickers.length) {
        select_pickers.selectpicker({
            showSubtext: true
        });
    }
}

// Clear the items added to preview
function clear_main_values(default_taxes) {
    // Get the last taxes applied to be available for the next item
    var last_taxes_applied = $('table.items tbody').find('tr:last-child').find('select').selectpicker('val');
    $('.main textarea[name="description"]').val('');
    $('.main textarea[name="long_description"]').val('');
    $('.main input[name="quantity"]').val(1);
    $('.main select.tax').selectpicker('val', last_taxes_applied);
    $('.main input[name="rate"]').val('');
    $('.main input[name="unit"]').val('');
    $('input[name="task_id"]').val('');
    $('input[name="expense_id"]').val('');
}

// Reoder the items in table edit for estimate and invoices
function reorder_items() {
    var rows = $('.table.table-main-invoice-edit tbody tr.item,.table.table-main-estimate-edit tbody tr.item');
    var i = 1;
    $.each(rows, function() {
        $(this).find('input.order').val(i);
        i++;
    });
}

// Deletes invoice items
function delete_item(row, itemid) {
    $(row).parents('tr').addClass('animated fadeOut', function() {
        setTimeout(function() {
            $(row).parents('tr').remove();
            calculate_total();
        }, 50)
    });

    // If is edit we need to add to input removed_items to track activity
    if ($('input[name="isedit"]').length > 0) {
        $('#removed-items').append(hidden_input('removed_items[]', itemid));
    }
}