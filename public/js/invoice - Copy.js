$(document).ready(function(){

	$('#customer').change(function(){
      var value = this.value;
      if(value==1) {
      	$("#customer_name_show").hide();
      	$("#customer_id_show").show();
      	$('#invoice_to').attr('disabled','disabled');
      } else if(value==2) {
      	$("#customer_id_show").hide();
      	$("#customer_name_show").show();
      	$('#invoice_to').removeAttr('disabled');
      } else {
      	$("#customer_name_show").hide();
      	$("#customer_id_show").show();
      	$('#invoice_to').attr('disabled','disabled');
      }
    });

    $('#credit_term').change(function(){
     var value = this.value;
      if(value==1) {
      	$("#trigger_payment").show();
      	$("#payment_trigger").val(1);
      } else {
      	$("#trigger_payment").hide();
      	$("#payment_trigger").val(0);
      }
    });

});


//Calculate total invoice amount

function calculateInvoiceTotal() {
    var count   = $("#counter").val();
    var sub_total  = 0.00;
    var sub_gst    = 0.00;
    var grand_total = 0.00;
    var tax_code = $("#tax_code").val();
    var myTax    = tax_code.split('_');
    if(myTax[0]!=0 && myTax[0]!='' && myTax[1]!=0 && myTax[1]!='') {
        sub_gst += parseFloat(myTax[1]);
    } 

    for(var i = 1; i<=count;i++) {
        var amount    = $("#amount_"+i).val();
        if(amount!='') {
        	sub_total += parseFloat(numberWithOutCommasInput(amount));
        }
    }

    var total_gst = (parseFloat(sub_total) * parseFloat(sub_gst) / 100);
    
    grand_total += parseFloat(sub_total) + parseFloat(total_gst);
    $("#sub_total").text(numberWithCommasInput(parseFloat(sub_total).toFixed(2)));
    $("#total_gst").text(numberWithCommasInput(parseFloat(total_gst).toFixed(2)));
    $("#grand_total").text(numberWithCommasInput(parseFloat(grand_total).toFixed(2)));
    $("#sub_amount").val(sub_total);
    $("#gst_amount").val(total_gst);
    $("#total_amount").val(grand_total);
    $("#payment_amount").val(numberWithCommasInput(parseFloat(grand_total).toFixed(2)));
}