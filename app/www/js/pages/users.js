$(function () {


    // Form components
    // ------------------------------

    // Switchery toggles
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });


    // Setup validation
    // ------------------------------


    // Initialize
    $.validator.setDefaults({
        ignore: 'input[type=hidden], .select2-input', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        validClass: "validation-valid-label",
        success: function (label) {
            label.addClass("validation-valid-label").text("Ok.")
        }
    });


    $.validator.addMethod("rib_fr_simple", function (value, element) {
            return this.optional(element) || /^[0-9]{5} - [0-9]{5} - [0-9a-zA-Z]{11} - [0-9]{2}$/i.test(value);
        }, "Please enter a valid rib"   
    );


});
