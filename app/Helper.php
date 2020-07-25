<?php
use App\Models\Amphure;
use App\Models\District;

if (! function_exists('getAmphureByProvinceId')) {
    function getAmphureByProvinceId($id,$local)
    {
        return Amphure::where('province_id',$id)
            ->orderBy($local)
            ->get();
    }
}
if (! function_exists('getAmphureByProvinceName')) {
    function getAmphureByProvinceName($provinces,$name,$field)
    {
        $amphure = [];
        foreach($provinces as $province )
        {
            if($province[$field] == $name){
                $amphure = Amphure::where('province_id',$province->id)
                    ->orderBy($field)
                    ->get();
                break;
            }
        }
        return $amphure;
    }
}
if (! function_exists('getDistrictByAmphureId')) {
    function getDistrictByAmphureId($id,$local)
    {
        return District::where('amphure_id',$id)
            ->orderBy($local)
            ->get();
    }
}
if (! function_exists('getDistrictByAmphureName')) {
    function getDistrictByAmphureName($amphures,$name,$field)
    {
        $district = [];
        foreach($amphures as $amphure )
        {
            if($amphure[$field] == $name){
                $district = District::where('amphure_id',$amphure->id)
                    ->orderBy($field)
                    ->get();
                break;
            }
        }
        return $district;
    }
}
