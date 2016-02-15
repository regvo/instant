$(document).ready(function(){
    
    $('.shredirect-form-add select').change(function(){
        var hdr = $('.shredirect-form-add select').val();
        if(hdr === '410'){
            $('.shredirect-form-add .link_to').prop('disabled', true).css({borderColor: "", opacity: "0.4"});
        }
        if(hdr === '301'){
            $('.shredirect-form-add .link_to').prop('disabled', false).css({opacity: "1"});
        }
    });
    
    $('.shredirect-form-add .send').click(function(){
        var msg   = $('.shredirect-form-add').serialize();
        $.post('shredirect/add', msg, function(response){
            var res = $.parseJSON(response);
            if(res.error){
                $('.shredirect-mess').css({color: "#f33"});
                if(res.error.incorrect_link_from){
                    $('.shredirect-form-add .link_from').css({borderColor: "#f33"});
                }else{
                    $('.shredirect-form-add .link_from').css({borderColor: ""});
                }
                if(res.error.incorrect_link_to){
                    $('.shredirect-form-add .link_to').css({borderColor: "#f33"});
                }else{
                    $('.shredirect-form-add .link_to').css({borderColor: ""});
                }
                if(res.error.bd){
                    $('.shredirect-mess').text(res.error.bd);
                }
            }else{
                $('.shredirect-form-add input').val('').css({borderColor: "", opacity: "1"}).prop('disabled', false);
                $('.shredirect-mess').text(res.reply).css({color: "#070"});
                icms.datagrid.init();
                setTimeout(function () {
                    var ms = $('.shredirect-mess').attr('data-mess');
                    $('.shredirect-mess').text(ms).css({color: ""});
                }, 3000);
            }
            
        });
    });
});

