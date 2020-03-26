$(document).ready(function () {

    // initializing a Date Picker
    if ($('.pick-a-date').length) {
        $('.pick-a-date').pickadate({
            format: 'mm/dd/yyyy'
        });
    }

    // datatable initalized
    if ($('#app-invoice-table').length) {
        $('#app-invoice-table').DataTable({

            // making dom structure using datatable plug-in controls
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            //seting some of the column definations options
            columnDefs: [{
                    targets: 8, //targeting 7th coulumn in the table starts from zero
                    orderable: false //making ordrable functionality disable
                },

                {
                    targets: 1, //targeting 1st coulumn (starts from 0) in the table
                    checkboxes: true, // showing checkbox
                    orderable: false // making orderable functionality hide
                },

                {
                    className: 'control', // defining a class name for column
                    orderable: false, // making orderable functionality hide
                    targets: 0  // targeting 0th column in row
                },
            ],

            responsive: { // options for responsive behaviour
                details: {
                    type: 'column',
                    target: 0
                }
            },

            order: [
                [1, 'asc']
            ], // ordering coulumns

            "lengthMenu": [12, 20, 30, 40],
            pageLength: 12 // setting rows to show at a time

        });
    }

    // initializing repeater
    if ($('.repeater-form').length) {
        $('.repeater-form').repeater({
            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        })
    }


    // preventing parent action on dropdown form
    $(document).on('click', '.stopPropgate', function (e) {
        e.stopPropagation();
    })

    $('.repeater-form').submit(function () {
        return false;
    })

    //creating discount functionality
    var discount_value, tax_one_val, tax_two_val, valArr = [];


    // changing description value when changing Select options of invoice items

    $(document).on("change", "#item-options", function () {
        var option_selected = $(this).val();
        var description_input = $(this).parent().parent().find('.description-input');

        if (option_selected === 'frest') {
            description_input.val('The most developer friendly & highly customisable HTML5 Admin');
        } else if (option_selected === 'modern') {
            description_input.val('The most complete & feature packed bootstrap 4 admin template of 2019!');
        } else if (option_selected === 'apex') {
            description_input.val('Developer friendly and highly customizable Angular 7+ jQuery Free Bootstrap 4 gradient ui admin template. ');
        } else if (option_selected === 'stack') {
            description_input.val('Ultimate Bootstrap 4 Admin Template for Next Generation Applications.');
        } else if (option_selected === 'robust') {
            description_input.val('Robust admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities')
        }
    })


    $('.print-invoice').on('click', function () {
        window.print();
    })
});