function getAmphure(id,local) {
    result = $.ajax({
        url:'/api/amphure',
        method:"GET",
        data : {"id":id,"local":local},
        async : false,
        contentType : "JSON"
    })
    return result.responseJSON;
}

function getDistrict(id,local) {
    result = $.ajax({
        url:'/api/district',
        method:"GET",
        data : {"id":id,"local":local},
        async : false,
        contentType : "JSON"
    })
    return result.responseJSON;
}
