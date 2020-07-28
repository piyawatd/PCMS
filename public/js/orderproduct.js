function bindaction(){
    //delect event
    $( ".plusamount").unbind( "click" );
    $( ".minusamount").unbind( "click" );
    $( ".deleteline").unbind( "click" );
    //bind event
    $('.plusamount').click(function () {
        var rowItem = $(this).parent().parent().parent().parent().parent();
        var amount = parseInt(rowItem.find('input[class=pquantity]').val());
        var price = parseInt(rowItem.find('input[class=pprice]').val());
        var newamount = amount+1;
        var newlinetotal = newamount*price;
        rowItem.find('input[class=pquantity]').val(newamount);
        rowItem.find('input[class=ptotalline]').val(newlinetotal);
        rowItem.find('.show-amount').html(newamount);
        rowItem.find('.show-linetotal').html(numberf(newlinetotal));
    });
    $('.minusamount').click(function () {
        var rowItem = $(this).parent().parent().parent().parent().parent();
        var amount = parseInt(rowItem.find('input[class=pquantity]').val());
        var price = parseInt(rowItem.find('input[class=pprice]').val());
        var newamount = amount-1;
        if(newamount > 0)
        {
            var newlinetotal = newamount*price;
            rowItem.find('input[class=pquantity]').val(newamount);
            rowItem.find('input[class=ptotalline]').val(newlinetotal);
            rowItem.find('.show-amount').html(newamount);
            rowItem.find('.show-linetotal').html(numberf(newlinetotal));
        }else{
            $.confirm({
                title: 'Confirm!',
                content: 'ต้องการลบสินค้าออกจากรายการสั่งสินค้า',
                buttons: {
                    confirm: function () {
                        rowItem.remove();
                    },
                    cancel:{

                    }
                }
            });
        }
    });
    $('.deleteline').click(function () {
        var rowItem = $(this).parent().parent();
        $.confirm({
            title: 'Confirm!',
            content: 'ต้องการลบสินค้าออกจากรายการสั่งสินค้า',
            buttons: {
                confirm: function () {
                    rowItem.remove();
                },
                cancel:{

                }
            }
        });
    });
}
