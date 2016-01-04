// Product key
$('[name="rib"]').formatter({
    pattern: '{{99999}} - {{99999}} - {{***********}} - {{99}}'
});


validatorRules = {
    email: {
        email: true
    },
    password: {
        minlength: 5
    },
    repeat_password: {
        equalTo: "#pass"
    },
    rib: {
        rib_fr_simple: true
    }
};