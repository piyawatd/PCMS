async function getAmphure(id) {
    let result;
    try{
        result = await $.ajax({
            url:'/api/amphure',
            method:"GET",
            data : {"id":id},
            contentType : "JSON"
        })
        return result;
    } catch (error) {
        console.log(error)
    }

}

async function getDistrict(id) {
    let result;
    try{
        result = await $.ajax({
            url:'/api/district',
            method:"GET",
            data : {"id":id},
            contentType : "JSON"
        })
        return result;
    } catch (error) {
        console.log(error)
    }

}
