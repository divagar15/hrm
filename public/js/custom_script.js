// JavaScript Document
var rnd=Math.random();
 if ("https:" == location.protocol)
	var protocolPath  = 'https://';
else
	var protocolPath  = 'http://';
  var  actionPath =  protocolPath + window.location.hostname + '/ilanji_crm_new/';
/*if (window.location.hostname == 'localhost') {
	var  path       = protocolPath +  'localhost/talentHarbour/';
	var actionPath	= protocolPath +  'localhost/talentHarbour/';
} else if (window.location.hostname == '192.168.1.7') {
	var  path = protocolPath +  '192.168.1.7/talentHarbour/';
	var  actionPath	= protocolPath +  '192.168.1.7/talentHarbour/';
}*/
$(document).ready(function(){
   //function selectAll() {
   $("#checkAll").click(function(){
     if($("#checkAll").is(":checked")) {
            $(".checklist").each(function(){
             if(!$(this).is(":disabled")){
                 $(this).prop('checked', true);
             }
            });
	} else {
            $('.checklist').prop('checked', false);
	}
    }); 
    $('#filter_branch').change(function(){
       $('#dash_filter_form').submit(); 
    });
    /* get text first letter start with caps */		 
    $.ucfirst = function(str) {
            var text = str;
            var parts = text.split(' '),
                len = parts.length,
                i, words = [];
            for (i = 0; i < len; i++) {
                var part = parts[i];
                var first = part[0].toUpperCase();
                var rest = part.substring(1, part.length);
                var word = first + rest;
                words.push(word);
            }
            return words.join(' ');
     };	

     $('.datepicker').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
    });


});

/**
 * Cash approval Status
 */
function changeStatus(cstatus) {
    var flag = null;
    var appId = [];
    var statusArray = [];
    statusArray[2] = 'reject';
    statusArray[1] = 'approve';
    $(".checklist").each(function(){
             if($(this).is(":checked") && $(this).val() != '-1'){
                 appId.push($(this).val());
                 flag = 1;
             }
    });
    if(flag == 1) {
        var alert_msg='Are you sure to '+statusArray[cstatus]+' this fee amount?';
        if(confirm(alert_msg)){
            $.ajax({
                    type: "POST",
                    url:  actionPath+"home/ajax-call",
                    data: 'action=CHANGE_STATUS&mode='+cstatus+'&appId='+appId,
                    success: function(response){
                            if(response == 1) {
                                    window.location.href = actionPath+"approval/contract-payment-approval";
                            } else {
                                    $("#alertbox").addClass('response-error');
                                    $('.response').html('Sorry server problem try again');
                            }
                    }
            });
        }
    } else {
            alert('Please choose atleast one row.');
    }
}


function numberWithCommas(x,id) {
  var x = x.replace(/\,/g,'');
  var amount = parseFloat(x).toFixed(2);
  var value  = amount.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
  $("#"+id).val(value);
}

function numberWithCommasInput(x) {
  var x = x.replace(/\,/g,'');
  var amount = parseFloat(x).toFixed(2);
  var value  = amount.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
  return value;
}

function numberWithCommasTotal(x) {
  var amount = parseFloat(x).toFixed(2);
  var value  = amount.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
  return value;
}

function numberWithOutCommasInput(x) {
  var x = x.replace(/\,/g,''); 
  var value = parseFloat(x).toFixed(2);
  return value;
}

function numberWithDecimal(x) {
  var value = parseFloat(x).toFixed(2);
  return value;
}
function numberWithOutCommasInputField(x,id) {
  //var x = x.replace(/\,/g,''); 
  if(x != '') {
    var value = parseFloat(x).toFixed(2);
    $("#"+id).val(value);
  } else {
      var value =  parseFloat('0.00').toFixed(2);
     $("#"+id).val(value);
  }
}

function vendorSelect(value) {
      if(value!='') {
        var split = value.split('_');
        $("#paid_to").val(split[1]);
        if(split[2]==0) {
          $("#payment_account_1").val(13);
        } else if(split[2]==1) {
          $("#payment_account_1").val(8);
        }
        $("#balance_amount").val(split[3]);
        var v_id = split[0];
        if(v_id != ''){
            $.ajax({
                    type: "POST",
                    url:  actionPath+"account/payment/ajax-call",
                    data: 'action=getPayByMaid&vendor_id='+v_id,
                    success: function(response){
                        var htmlCnt = '';
                        console.log(response);
                            if(response != 0) {
                                var obj = $.parseJSON(response);
                                 htmlCnt+= '<option value="">Select</option>';
                                 $.each(obj,function(i,val){
                                     htmlCnt+= '<option value="'+i+'">'+val.maid_name+' - ('+val.balance+')</option>';
                                 });
                                 $('#maid_id').html(htmlCnt);
                            } else {
                                htmlCnt+= '<option value="">Select</option>';
                                htmlCnt+= '<option value="">Not Maid Found</option>';
                                $('#maid_id').html(htmlCnt);
                            }
                    }
            });
        }
        console.log(split[0]);
        //$("#payment_account_1").attr('disabled','disabled');
      } else {
        $("#paid_to").val('');
        $("#payment_account_1").val("");
        $("#payment_account_1").removeAttr('disabled');
      }
}
