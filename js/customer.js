
let allocatedQuater=0; //allocated based on the vehicle type
let totConsumed=0; //for the current month
let leftAmount=0;
let unitPrice=0;

$(document).ready(function(){
  createTokenHistoryTable();
  datePickerVal();
  getCustomerVehicles();
});

function generateTokenBarcode(para)
{
  let link='"https://www.cognex.com/api/Sitecore/Barcode/Get?data='+para+'&code=BCL_CODE128&width=300&imageType=JPG&foreColor=%23000000&backColor=%23FFFFFF&rotation=RotateNoneFlipNone" alt="Barcode generated by Cognex Corporation" width="300"';
  let tag= '<div style="display:inline;">'+
  '<a href="'+link+'" download><img src= '+link+' /></a></div>'
  document.getElementById('barcodeContainer').innerHTML=tag
  $('#barcodeModal').modal('show');
}

function reToken() {
    let vehicleNo = document.getElementById('vehicleNo').value;
    let fuelCategory = document.getElementById('fuelCategory').value;
    let fuelType = document.getElementById('fuelType').value;
    let reqDate = document.getElementById('reqDate').value;
    let reqTime = document.getElementById('reqTime').value;
    let reqAmount = document.getElementById('reqAmount').value;
    let email = document.getElementById('uemail').value;
    let price = document.getElementById('totalPrice').value;

	if (fuelType == '' ) {
		alert("Please Select Vehicle");
		return false;
	}
  if (fuelCategory == '' ) {
		alert("Please Select Category");
		return false;
	}
    if (reqDate == '' ) {
		alert("Select Date");
		return false;
	}
    if (reqTime == '' ) {
		alert("Select Time");
		return false;
	}
    if (reqAmount == '' ) {
		alert("Select Amount");
		return false;
	}
  if(reqAmount < 1) {
		alert("Enter correct amount");
		return false;
	}
	if((allocatedQuater-totConsumed) < reqAmount) {
		alert("Required amount is higer than eligible amount");
		return false;
	}
	//else {
	// AJAX code to submit form.
	$.ajax({
		 url: "include/functions_customer.php", //call storeemdata.php to store form data
         type: "POST",
         dataType: 'json',
         data: {reqToken:"Yes",vehicleNo:vehicleNo,fuelType:fuelType,reqDate:reqDate,reqTime:reqTime,reqTime:reqTime,reqAmount:reqAmount,email:email,price:price,fuelCategory:fuelCategory},
		 success: function(result) {
		  alert(result.success);
          document.getElementById('vehicleNo').value="";
          document.getElementById('fuelType').value="";
          document.getElementById('reqDate').value="";
          document.getElementById('reqTime').value="";
          document.getElementById('reqAmount').value="";
          //document.getElementById('totalPrices').value="0.00";
          document.getElementById('showA').innerHTML="";
          document.getElementById('showUP').innerHTML="";
          document.getElementById("fuelCategory").innerHTML=" <option value=''>Select Category</option>";    
          createTokenHistoryTable();
		 }
	});
	//}
	//return false;
}

  //populate customer vehicles
  function getCustomerVehicles()
  {

      let mail =document.getElementById('uemail').value;
      $.ajax({
        url:"include/functions_customer.php", 
        type: "post",    
        dataType: 'text',
        data: {getVehicles: "getVehicles", mail: mail},
        success:function(result){
          //alert(result)
          document.getElementById("vehicleNo").innerHTML+=result;
        }
    });
   
  }

  //Get fuel type based on the vehicle
    function showFuelType(regNo) {
    if(regNo!="")
    {
        $.ajax({
          url:"include/functions_customer.php", 
          type: "post",    
          dataType: 'json',
          data: {vehicleSelect: "success", regNo: regNo},
          success:function(result){

              getAllocation(result.vehicleType);
              getLeftAmount(regNo);
             
              document.getElementById("fuelType").value=result.Fueltype;
              document.getElementById("CardFueltype1").innerHTML=result.Fueltype;
              document.getElementById("CardFueltype").innerHTML=result.Fueltype;
              document.getElementById("CardFueltype2").innerHTML=result.Fueltype;

              document.getElementById("fuelCategory").innerHTML=" <option value=''>Select Category</option>";
              getCategories(result.Fueltype);
              calculateTotal();
              document.getElementById('showUP').innerHTML="";
              //document.getElementById('totalPrices').value="0.00";

          }
      });
    }
    else
    {
      $('#progressAllo').css('width', '0%').attr('aria-valuenow', '0%');
      $('#progressCons').css('width', '0%').attr('aria-valuenow', '0%');
      $('#progressLeft').css('width', '0%').attr('aria-valuenow', '0%');
      // $('#progressLeft1').css('width', '0%').attr('aria-valuenow', '0%');

      document.getElementById("fuelType").value="";
      document.getElementById("CardFuelCons").innerHTML="";
      document.getElementById("CardFuelAllo").innerHTML="";
      document.getElementById("CardFuelleft").innerHTML="";
      document.getElementById('showA').innerHTML="";
      document.getElementById('showUP').innerHTML="";
      document.getElementById("fuelCategory").innerHTML=" <option value=''>Select Category</option>";
      
      return false;
    } 
}

  //Get fuel category details
  function getCategories(fuelType) {
    if(fuelType!="")
    {
      if(document.getElementById("fuelType").value=="")
      {
        alert("Please select vehicle first")
        document.getElementById('fuelCategory').value="";
        return false;
      }
        $.ajax({
          url:"include/functions_customer.php", 
          type: "post",    
          dataType: 'text',
          data: {getCategories: "price_customer", fuelType: fuelType},
          success:function(result){
            document.getElementById("fuelCategory").innerHTML+=result;
          }
      });
    }
 
}

  //Get fuel category price
  function getCategoryPrice(category) {
    if(category!="")
    {
        $.ajax({
          url:"include/functions_customer.php", 
          type: "post",    
          dataType: 'text',
          data: {getCategoryPrice: "price_customer", category: category},
          success:function(result){
            unitPrice=result;
            document.getElementById("showUP").innerHTML="Unit Price Rs."+result;
            calculateTotal();
          }
      });
    }
 
}

function getAllocation(Vtype)
{
  //allocatedQuater=0;
    $.ajax({
        url:"include/functions_customer.php", 
        type: "post",    
        dataType: 'json',
        data: {allocation: "success", Vtype: Vtype},
        success:function(result){

            allocatedQuater=result.amount;
            console.log(allocatedQuater);
            
            document.getElementById("CardFuelAllo").innerHTML=allocatedQuater;
            $('#progressAllo').css('width', allocatedQuater+'%').attr('aria-valuenow', allocatedQuater).attr('aria-valuemax',allocatedQuater);
        }
    });
}

function getLeftAmount(RegNo)
{
  //totConsumed=0;
 // leftAmount=0;
  
    $.ajax({
        url:"include/functions_customer.php", 
        type: "post",    
        dataType: 'json',
        data: {totalConsumed: "success", RegNo: RegNo},
        success:function(result){
           
            totConsumed=result.Consume;
            
            leftAmount=allocatedQuater-totConsumed;
            console.log(totConsumed);
            console.log(leftAmount);
            console.log(allocatedQuater);

            document.getElementById("CardFuelCons").innerHTML=totConsumed;
            document.getElementById("CardFuelleft").innerHTML=leftAmount;
            document.getElementById('showA').innerHTML="Available Liters: "+leftAmount;

            $('#progressCons').css('width', getPercent(totConsumed,allocatedQuater)+'%').attr('aria-valuenow', totConsumed).attr('aria-valuemax', allocatedQuater);
            $('#progressLeft').css('width', getPercent(leftAmount,allocatedQuater)+'%').attr('aria-valuenow', leftAmount).attr('aria-valuemax', allocatedQuater);
            // $('#progressLeft1').css('width', leftAmount+'%').attr('aria-valuenow', leftAmount).attr('aria-valuemax', leftAmount);
               
        }
    });
}

//render token history table
function createTokenHistoryTable() {
  var email = document.getElementById('uemail').value;
  $.ajax({
    type: "POST",
    url: "include/functions_customer.php",
    data: { email: email, getToken:"success" },
    dataType: "text",
    success: function(data) {
      //console.log(data);
      document.getElementById("tokenTBody").innerHTML=data;
    }
  });
}

function getPercent(x, y) {
  return Math.round((x / y) * 100);
 }

 $('#reqAmount').change(function() {
  calculateTotal();
});

function calculateTotal()
{
  var reqAmount= document.getElementById("reqAmount").value;
  var price=reqAmount*unitPrice
  document.getElementById("totalPrice").value=price;
}


function datePickerVal()
{
    var datepicker = document.getElementById("reqDate");
    var timepicker = document.getElementById("reqTime");

    var now = new Date();
    var today = new Date();
    datepicker.min = today.toISOString().split("T")[0];
    now.setMonth(now.getMonth() + 1);
    now.setDate(0);
    datepicker.max = now.toISOString().split("T")[0];

}

