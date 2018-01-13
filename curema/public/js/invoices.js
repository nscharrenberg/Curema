$(document).ready(function(e) {
    //Variables
    $('.selectpicker').selectpicker('render');

    // TO DO: PASS DATA FROM FORM TO JQUERY
    // $.each(data, function(index, value) {
    //    taxes += '<option value="' + value.id +'" text="' + value.name + '"/>';
    // });

    var html = "<tr class='main'>" +
        "<td></td>\n" +
        "<td>\n" +
        "<textarea rows=\"4\" id=\"name\" name=\"name\" cols=\"50\" class=\"form-control\"></textarea>\n" +
        "</td>\n" +
        "<td>\n" +
        "<textarea rows=\"4\" id=\"description\" name=\"description\" cols=\"50\" class=\"form-control\"></textarea>\n" +
        "</td>\n" +
        "<td>\n" +
        "<input id=\"quantity\" name=\"quantity\" type=\"number\" class=\"form-control\">\n" +
        "<input placeholder=\"Unit\" id=\"unit\" name=\"unit\" type=\"text\" class=\"form-control input-transparent text-right\">\n" +
        "</td>\n" +
        "<td>\n" +
        "<input id=\"rate\" name=\"rate\" type=\"number\" class=\"form-control\">\n" +
        "</td>\n" +
        "<td>\n" +
        "<select name=\"tax\" id=\"tax\" class=\"form-control selectpicker\" multiple>\n" +
        "<option value=\"0\">Nothing</option>\n" +
        "</select>" +
        "</td>\n" +
        "<td></td>" +
        "<td><button id=\"add-invoice\" type=\"button\" class=\"btn pull-right btn-info\"><i class=\"fa fa-check\"></i></button></td>" +
        "</tr>";

    // Add rows to the form
    $('#add-invoice').click(function() {
        $('#main').before(html);
    });

    $('.selectpicker').selectpicker('render');

    // remove rows from the form
});


