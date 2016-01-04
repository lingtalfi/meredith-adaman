

window.meredithRegistry.onModalOpenAfter = function (jForm, data) {
    jForm.find("[name=repeat_password]").val(data.pass);
};