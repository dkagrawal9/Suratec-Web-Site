<form action="functions.php" method="post" enctype="multipart/form-data" name="upload-form-add" id="upload-form-add">
  <input type="hidden" name="_method" value="import_csv">
  
  <!-- <input name="btnSubmit" type="submit" id="btnSubmit" value="Submit">
  <button>ok</button> -->


<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">นำเข้าไฟล์ CSV</h3>
            </div>
            <div class="box-body" >
                <div class="form-horizontal">
                    <div class="box-body">
                    <div class="col-md-12" >
                    <!-- Start box warning for ADD system -->
                     <div class="form-group">
                   
                    <div class="col-sm-12" align="center">
                    	<span class="btn btn-default btn-file" style="background: #00CCFF; border: 2px solid #3399FF;border-radius: 12px;" >
                        	เลือกไฟล์ *.csv<input name="fileCSV" type="file" id="fileCSV" >
                    	</span>
                    </div>
                    </div>
                    
                    <!--  -->
                   
                </div>
            
                </div>
             </div>
         </div>
    </div>
</div>
</div>
</form>

 <div class = "modal-footer">
 	<div class="col-sm-6" align="left">
 			<button type = "button" class = "btn btn-success " id="save_csv">
               <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
            </button>
    </div>
    <div class="col-sm-6" align="right">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               ปิด
            </button>
    </div>
            
 </div>
</div>
</div>
</div>
<script type="text/javascript">
    
	 $(document).on('click', '#save_csv', function(){
        var formData = new FormData($('#upload-form-add')[0]);



        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการบันทึกหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "functions.php",
            data: formData,
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
  swal({
            title: 'สำเร็จ',
            text: "บันทึกเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
          
            // alert('การบันทึก');
         swal(window.location.href='front-manage.php')
            //location.reload();
           
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
    });
</script>