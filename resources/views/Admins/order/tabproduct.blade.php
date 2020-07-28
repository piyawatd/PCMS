<div class="row justify-content-end">
    <div class="col-12 text-right">
        <a href="javascript:openmodalproduct()" class="btn-primary btn">Add</a>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td class="col-4 text-center">ชื่อสินค้า</td>
                    <td class="col-2 text-center">SKU</td>
                    <td class="col-2 text-center">ราคา</td>
                    <td class="col-3 text-center">จำนวน</td>
                    <td class="col-1 text-center">รวม</td>
                    <td class="col-1 text-center"></td>
                </tr>
            </thead>
            <tbody id="product-line">
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->sku}}</td>
                        <td class="text-right">{{number_format($item->price,0)}}</td>
                        <td>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-3">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger minusamount">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                    </div>
                                    <div class="col-6 text-center show-amount">{{$item->quantity}}</div>
                                    <div class="col-3">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary plusamount">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-right show-linetotal">
                            {{number_format($item->totalline,0)}}
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteline">
                                <i class="fas fa-trash"></i>
                            </a>
                            <input type="hidden" class="ptitleth" name="ptitleth[]" value="{{$item->title_th}}">
                            <input type="hidden" class="ptitleen" name="ptitleen[]" value="{{$item->title_en}}">
                            <input type="hidden" class="psku" name="psku[]" value="{{$item->sku}}">
                            <input type="hidden" class="pprice" name="pprice[]" value="{{$item->price}}">
                            <input type="hidden" class="pquantity" name="pquantity[]" value="{{$item->quantity}}">
                            <input type="hidden" class="ptotalline" name="ptotalline[]" value="{{$item->totalline}}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
