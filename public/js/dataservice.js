function replacetext(replacetext)
{
    var oldtext = $.trim(replacetext);
    var newtext = oldtext.replace(/[^a-zA-Z0-9ก-๙\\-]/g,'-');
    newtext = newtext.replace(/(-)+/g, "-");
    newtext = newtext.replace(/(-)*$/g, "");
    return newtext;
}

function checkusername(value) {
    var regex = /^[A-Za-z\d_]{5,}$/;
    return regex.test(value);
}

function checkpassword(value) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{5,}$/;
    return regex.test(value);
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function elpath(path) {
	return btoa(path).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, '')
}
