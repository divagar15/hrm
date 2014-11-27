$(document).ready(function(){

	$('#customer').change(function(){
      var value = this.value;
      if(value==1) {
      	$("#customer_name_show").hide();
      	$("#customer_id_show").show();
        //$("#invoice_to").val("");
      	$('#invoice_to').attr('readonly','readonly');
      } else if(value==2) {
      	$("#customer_id_show").hide();
      	$("#customer_name_show").show();
        $("#invoice_to").val("");
      	$('#invoice_to').removeAttr('readonly');
      } else {
      	$("#customer_name_show").hide();
      	$("#customer_id_show").show();
        $("#invoice_to").val("");
      	$('#invoice_to').attr('readonly','readonly');
      }
    });


    $('#customer_id').change(function(){
      var name = $("#customer_id option:selected").text();
      $("#invoice_to").val(name);
    });
    var invoice_raise  = $("#invoice_raise").val();
    if(invoice_raise == 1){
        $("#customer").select2("enable", true);  
    } else if(invoice_raise == 2){
        $("#customer").select2("enable", false);
    }
    $('#invoice_raise').change(function() {
      var value = this.value;
      if(value==1) {
        $("#customer").select2("enable", true);  
        //$("#customer").removeAttr('disabled');
        $("#invoice_no").removeAttr('disabled');
        $("#income_account").attr('disabled','disabled');
        $("#tax_code").attr('disabled','disabled');
        $('#received_from').attr('readonly','readonly');
      } else if(value==2) {
        $("#customer").select2("enable", false);    
        //$("#customer").attr('disabled','disabled');
        $("#invoice_no").attr('disabled','disabled');
        $("#income_account").removeAttr('disabled');
        $("#tax_code").removeAttr('disabled');
        $("#invoice_no").val("");
        $("#received_from").val("");
        $('#received_from').removeAttr('readonly');
      } else {
        //$("#customer").attr('disabled','disabled');
        $("#invoice_no").attr('disabled','disabled');
        $("#income_account").removeAttr('disabled');
        $("#tax_code").removeAttr('disabled');
        $("#invoice_no").val("");
        $("#received_from").val("");
        $('#received_from').attr('readonly','readonly');
      }
    });
    
    $('#vendor').change(function(){
      var value = this.value;
      if(value==1) {
      	$("#vendor_name_show").hide();
      	$("#vendor_id_show").show();
      } else if(value==2) {
      	$("#vendor_id_show").hide();
      	$("#vendor_name_show").show();
      } else {
      	$("#vendor_name_show").hide();
      	$("#vendor_id_show").show();
      }
    });

    $('#vendor_select').change(function(){
      var value = this.value;
      if(value==1) {
        $("#vendor_id").select2("enable", true); 
        $("#advance").val(2);
        $("#advance").removeAttr('disabled');
        $("#income_row").attr('disabled','disabled');
        $("#paid_to").attr('readonly','readonly');
        $("#invoice_no").attr('disabled','disabled');
        $("#tax_code").attr('disabled','disabled');
        $("#payment_account_1").attr('disabled','disabled');
      } else if(value==2) {
        $("#vendor_id").select2("enable", false); 
        $("#advance").attr('disabled','disabled');
        $("#paid_to").removeAttr('readonly');
        $("#invoice_no").removeAttr('disabled');
        $("#tax_code").removeAttr('disabled');
        $("#income_row").removeAttr('disabled');
        $("#payment_account_1").removeAttr('disabled');
      } else {
        $("#vendor_id").select2("enable", false);
        $("#advance").attr('disabled','disabled');
        $("#paid_to").removeAttr('readonly');
        $("#invoice_no").removeAttr('disabled');
        $("#tax_code").removeAttr('disabled');
        $("#income_row").removeAttr('disabled');
        $("#payment_account_1").removeAttr('disabled');
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


function calculateReceiptTotal() {
    var sub_total  = 0.00;
    var sub_gst    = 0.00;
    var grand_total = 0.00;
    var tax_code = $("#tax_code").val();
    var myTax    = tax_code.split('_');
    if(myTax[0]!=0 && myTax[0]!='' && myTax[1]!=0 && myTax[1]!='') {
        sub_gst += parseFloat(myTax[1]);
    } 

    var amount   = $("#payment_amount").val();
    sub_total   += parseFloat(numberWithOutCommasInput(amount));

    var total_gst = (parseFloat(sub_total) * parseFloat(sub_gst) / 100);
    
    grand_total += parseFloat(sub_total) + parseFloat(total_gst);
    $("#sub_total").text(numberWithCommasInput(parseFloat(sub_total).toFixed(2)));
    $("#total_gst").text(numberWithCommasInput(parseFloat(total_gst).toFixed(2)));
    $("#grand_total").text(numberWithCommasInput(parseFloat(grand_total).toFixed(2)));
    $("#sub_amount").val(sub_total);
    $("#gst_amount").val(total_gst);
    $("#total_amount").val(grand_total);
}


function calculateJournalTotal() {
    var journal_count   = $("#counter").val();
    var total_debit   = 0.00;
    var total_credit  = 0.00;
    for(var i = 1; i<=journal_count;i++) {
        var debit   = $("#debit_"+i).val();
        var credit  = $("#credit_"+i).val();
        if(debit!='') {
            total_debit  += parseFloat(numberWithOutCommasInput(debit));
        }
        if(credit!='') {
            total_credit += parseFloat(numberWithOutCommasInput(credit));
        }
    }
   // total_gst_amount += (parseFloat(sub_total) * parseFloat(total_gst) / 100);
    $("#hidden_debit").val(total_debit);
    $("#hidden_credit").val(total_credit);
    $("#total_debit").text(numberWithCommasInput(parseFloat(total_debit).toFixed(2)));
    $("#total_credit").text(numberWithCommasInput(parseFloat(total_credit).toFixed(2)));
}


