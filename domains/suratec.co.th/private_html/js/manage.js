
 var add = '';
 var pricedata = '';

 deleteAllCookies();

// function add_Cart(id,price){
//    var status = 0;
//    var check =  getCookie();
//    var check2 = getCookieprice(); 

//     if(check == undefined){

//         check = 'add_Cart='
//         check2 = 'add_Cart_price=';
        
//     }

//    var res = check.split('=')
//    var resprice = check2.split('=')
  

//    //alert(resprice[1]);

//    var res2 = res[1].split(',');

//    for(i = 0 ;i < res2.length; i++){

//     if(id === res2[i]){
       
//         status = 1;
//         break;
//     }
//    }
   
   
//    if(status === 0){

//     add = res[1]+','+id
//     pricedata = resprice[1]+','+price
//     setCookie('add_Cart',add,'10','add_Cart_price',pricedata);
    
//     Swal.fire(
//       'Course',
//       'Success',
//       'success'
//     )
//    }
//   //  alert(getCookie());
//   //  alert(res2[1]);
   
//    //alert(count_data());
//    //alert(pricesum());
//  //  alert(add);
//   //console.log(getCookie('add_Cart'));

  

 
// }








// function delete_Cart(id){
//   var add = '';
//   var pricedata = '';
//   var status = 0;
//   var check =  getCookie();
//   var check2 = getCookieprice(); 

//    if(check == undefined){

//        check = 'add_Cart='
//        check2 = 'add_Cart_price=';
       
//    }

//   var res = check.split('=')
//   var resprice = check2.split('=')
 

//   //alert(resprice[1]);

//   var res2 = res[1].split(',');
//   var resprice2 = resprice[1].split(',');

  
//   //setCookie('add_Cart',',','10','add_Cart_price',',');
//   //alert(getCookie());
//   for(i = 0 ;i < res2.length; i++){

//    if(id === res2[i]){
      
  
  

//    }else{

//       if(res2[i] != ''){

//       //  alert(res2[i]);
//         add = add+','+res2[i];
//         pricedata = pricedata +','+resprice2[i];
//         setCookie('add_Cart',add,'10','add_Cart_price',pricedata);

//       }

//       if( res2.length == 2){


//       setCookie('add_Cart','','10','add_Cart_price','');  

//       }
    

//    }




//   }



 
 

  //alert(getCookie());
  


// }



// function count_data(){

//     var check =  getCookie();
//     var res = check.split('=');
//     var count = res[1].split(',')




//     return count.length-1;
    

    

// }



// function pricesum(){

    
//     var check =  getCookieprice();
//     var res = check.split('=');
//     var count = res[1].split(',')
//     var sumdaat = 0;

//         for(i=1;i<count.length;i++){

//             var v1 = parseFloat(sumdaat)
//             var v2 = parseFloat(count[i])
//             sumdaat = v1+v2;


            
//         }


//     return  currencyFormat(sumdaat);


// }


function currencyFormat(num) {
    return '฿ ' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }


function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}



function setCookie(cname, cvalue, exdays,pname,pvalue) {
  

    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue +  ";"  + expires + ";path=/";

    document.cookie = pname + "=" + pvalue + ";"  + expires + ";path=/";
  // alert(document.cookie)

  }




  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
   // alert(document.cookie);
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        break;
      }
    }
    return ca[1];
  }




  function getCookieprice(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
   // alert(document.cookie);
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        break;
      }
    }
    return ca[2];
  }



  function setlocalstore(id,price){

    // var names = [];
    // names[0] = id;
    localStorage.setItem("names", id);
    


    // var price = []
    // price[0] =  price;
    localStorage.setItem("price", price);
   
  }




  function getlocalname(){
    var storedNames = localStorage.getItem("names")
 
      return storedNames;
  }



  function getlocalprice(){
   
    var storedPrice = localStorage.getItem("price");
    return storedPrice;
  }

  
function add_Cart(id,price){
  var status = 0;
  var check =  getlocalname();
  var check2 = getlocalprice();

//  alert(check);
//  alert(check2);

if(check == null){

   setlocalstore(id,price);
   
   Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'เพิ่มรายการลงตะกร้าเรียบร้อย',
    type: 'success',
    showConfirmButton: false,
    timer: 1500
  })

}else{

  var res2 = check.split(',');

  // for(i = 0 ;i < res2.length; i++){

  //   if(id === res2[i]){
      
  //       status = 1;
  //       break;
  //   }
  // }
     Swal.fire({
	position: 'top-end',	 
    title: 'มีรายการนี้อยู่แล้ว <br>กรุณาเลือกรายการอื่น.',
	width: 600,
	/*background: '#fff url(../../images/bg_alert.jpg)'*/
    showConfirmButton: false,
    timer: 1500,
	backdrop: `
    rgba(233,247,255,0.4)
    url("")
    left top
    no-repeat
  `
  })

    if(status === 0){

      if(getlocalname() == ''){
        add = id
        pricedata = price
        setlocalstore(add,pricedata);

      }else{
        add = getlocalname()+','+id
        pricedata = getlocalprice()+','+price
        setlocalstore(add,pricedata);

      }

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'เพิ่มรายการลงตะกร้าเรียบร้อย',
        type: 'success',
        showConfirmButton: false,
        timer: 1500
      })

    }


}

      
 //  alert(getCookie());
 //  alert(res2[1]);
  
  //alert(count_data());
  //alert(pricesum());
//  alert(add);
 //console.log(getCookie('add_Cart'));

 


}

function count_data(){

    var check =  getlocalname();
    var count = check.split(',')
    var dara = 0;

    for(i=0;i<count.length;i++){

      if(count[i] != ''){

        dara = dara+1;

      }
    }
	
    return dara;

}



function pricesum(){

    
    var check =  getlocalprice();
    
    var count = check.split(',')
    var sumdaat = 0;

        for(i=0;i<count.length;i++){

          if(count[i] != ''){

            var v1 = parseFloat(sumdaat)
            var v2 = parseFloat(count[i])
            
            sumdaat = v1+v2;
			
			

          }
      


            
        }


    return  currencyFormat(sumdaat);


}


function delete_Cart(id){
  var add = '';
  var pricedata = '';
  var status = 0;
  var check =  getlocalname();
  var check2 = getlocalprice(); 

  var res = check.split(',')
  var resprice = check2.split(',')
 
  //setCookie('add_Cart',',','10','add_Cart_price',',');
  //alert(getCookie());
  for(i = 0 ;i < res.length; i++){

   if(id === res[i]){
      
  
  

   }else{



      if(res[i] != ''){

      //  alert(res2[i]);


      
        add = add+','+res[i];
        pricedata = pricedata +','+resprice[i];
        // setCookie('add_Cart',add,'10','add_Cart_price',pricedata);
        setlocalstore(add,pricedata);
      }
   }

   if(res.length == 1 || (res[0] == '' && res.length == 2) ){


      localStorage.clear();

    }

  // alert(check);

  }
}

function delete_CartAll(){

  localStorage.clear();

  // alert(check);

}




function add_Cart_s(id,price){
  var status = 0;
  var check =  getlocalname();
  var check2 = getlocalprice();
 
//  alert(check);
//  alert(check2);

if(check == null){

   setlocalstore(id,price);

}else{

  var res2 = check.split(',');

  // for(i = 0 ;i < res2.length; i++){

  //   if(id === res2[i]){
      
  //       status = 1;
  //       break;
  //   }
  // }

    if(status === 0){

      if(getlocalname() == ''){
        add = id
        pricedata = price
        setlocalstore(add,pricedata);

      }else{
        add = getlocalname()+','+id
        pricedata = getlocalprice()+','+price
        setlocalstore(add,pricedata);

      }

    }


}

}





function delete_Cart_s(id,price){
  var status = 0;
  var check =  getlocalname().split(',') 
  var check2 = getlocalprice().split(',');
  var status = 1;
  var count = 0;
  localStorage.clear();

//   alert(id);
//  alert(check.length);
//  alert(check);
  



//   var res2 = check.split(',');

  for(i = 0 ;i < check.length; i++){

    if(getlocalname() == null){

           setlocalstore(check[i],check2[i]);
      
       }else{


            if(id === check[i]){
              
            
              count++;
          
              
              }else{

                add = getlocalname()+','+check[i];
                pricedata = getlocalprice()+','+check2[i];
                setlocalstore(add,pricedata);

            }

    // if(status = 1){
    //   i++;
    //   status = 0;
    // }


    }


  }
  //alert(count);


for(i=0;count-1 > i;i++){

  add = getlocalname()+','+id;
  pricedata = getlocalprice()+','+price;
  setlocalstore(add,pricedata);


}




}


      
//alert(getCookie());

  
//alert(count_data());
//alert(pricesum());
//alert(add);
//console.log(getCookie('add_Cart'));

 



  