function replacetext(replacetext)
{
    var oldtext = $.trim(replacetext);
    var newtext = oldtext.replace(/[^a-zA-Z0-9ก-๙\\-]/g,'-');
    newtext = newtext.replace(/(-)+/g, "-");
    newtext = newtext.replace(/(-)*$/g, "");
    return newtext;
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function elpath(path) {
	return btoa(path).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, '')
}