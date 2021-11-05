$(document).ready( function() {
	var _URL = window.URL || window.webkitURL;
    	$(document).on('change', '.btn-file :file', function() {

    		// var file, img;
		    // if ((file = this.files[0])) {
		    //     img = new Image();
		    //     img.onload = function () {
		    //         alert(this.width + " " + this.height);
		    //     };
		    //     img.src = _URL.createObjectURL(file);
		    // }


		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});

		

		function readURL(input) {

		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		            $('#clear').show();
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});
	});
//-----------------------------------------------------------------------image modal custom--------------------------------------------------
   function readURL(input) {
   	alert('55555');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
//--------------------------------------------------------------------------------------------------------------------------------------------