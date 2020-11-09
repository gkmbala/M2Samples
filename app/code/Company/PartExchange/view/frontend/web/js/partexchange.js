define([
    'jquery',
    'mage/mage',
    'Magento_Ui/js/modal/alert'
], function ($) {
    'use strict';
    return function exchangerequire()
    {
        $(document).on('click','#original-box',function() {
            if($(this).is(":checked")){
                $("input[name='original_box']").val("yes");
            }else if($(this).is(":not(:checked)")){
                $("input[name='original_box']").val("no");
            }
        });
        $(document).on('click','#original-warranty',function() {
            if($(this).is(":checked")){
                $("input[name='original_warranty']").val("yes");
            }else if($(this).is(":not(:checked)")){
                $("input[name='original_warranty']").val("no");
            }
        });
        $(document).on('click','.part-popup',function() {
            $(".error").html('');
            $(".valueError").html('');
        });
        $(document).on('click','.popup-submit',function() {
            var dataForm = $('#form-validate');
            dataForm.mage('validation', {});
            var maxLength = 7;
            var brandValue = $("input[name='brand']").val();
            var modelValue = $("input[name='model']").val();
            var box = $("input[name='original_box']").val();
            var warranty = $("input[name='original_warranty']").val();
            var accessories = $('textarea#additional-accessories').val();
            var expectedValue = $("input[name='expected_value']").val();
            var contactName = $("input[name='contact_name']").val();
            var contactPhone = $("input[name='contact_phone']").val();
            var contactEmail = $("input[name='contact_email']").val();
            var productName = $("input[name='exchange_product_name']").val();
            var exchangeForm = $("input[name='exchange_form']").val();
            if (!contactName.trim() || !contactPhone.trim() || !contactEmail.trim()){
                $('.error').html('This is a required field.'); return false;
            }
            if (expectedValue.length >= maxLength) {
                $("#expected-value").focus();
                $('.error').html('');
                $('.valueError').html("Please enter less or equal than 6 digits."); return false;
            }
            var url = "/part-exchange-a-watch/index";
            $.ajax({
                url: url,
                type: "POST",
                data: {brand:brandValue,model:modelValue,original_box:box,original_warranty:warranty,additional_accessories:accessories,expected_value:expectedValue,contact_name:contactName,contact_phone:contactPhone,contact_email:contactEmail,exchange_product_name:productName,exchange_form:exchangeForm},
                showLoader: true,
                cache: false,
                dataType:'json'
            }).done(function (data) {
                if(data){
                    $(".valueError").html('');
                    $("input[name='contact_name']").val("");
                    $("input[name='contact_phone']").val("");
                    $("input[name='contact_email']").val("");
                    $(".error").html('');
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    $('.part-exchange-product-popup').hide();
                    return true;
                }
            });
            return false;
        });
    }

});