async function getAmphure(id,local) {
    let result;
    try{
        result = await $.ajax({
            url:'/api/amphure',
            method:"GET",
            data : {"id":id,"local":local},
            contentType : "JSON"
        })
        return result;
    } catch (error) {
        console.log(error)
    }

}

async function getDistrict(id,local) {
    let result;
    try{
        result = await $.ajax({
            url:'/api/district',
            method:"GET",
            data : {"id":id,"local":local},
            contentType : "JSON"
        })
        return result;
    } catch (error) {
        console.log(error)
    }

}
