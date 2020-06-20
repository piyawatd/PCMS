$(document).tooltip({
items:'.tooltip',
tooltipClass:'preview-tip',
position: { my: "left+15 top", at: "right center" },
content:function(callback) {
$.get('preview.php', {
id:id
}, function(data) {
callback(data); //**call the callback function to return the value**
});
},
});
