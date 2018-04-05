(function(){
	let MONTH_NAMES = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	$('#addform').submit(()=> {
		let state = true;
		$('#addform').find('#productname').each(function() {
		 	this.setCustomValidity('');
		 	let value = $(this).val();
		 	if (isEmptyString(value)){
		 		this.setCustomValidity('This field is required');
		 		state = false;
		 	}
		 	
		})
		$('#addform').find('#quantinty').each(function() {
		 	this.setCustomValidity('');
		 	let value = $(this).val();
		 	let pattern = $(this).attr('data-pattern');
		 	if (isEmptyString(value)){
		 		this.setCustomValidity('This field is required');
		 		state = false;
		 	}
		 	
		})
		$('#addform').find('#price').each(function() {
		 	this.setCustomValidity('');
		 	let value = $(this).val();
		 	let pattern = $(this).attr('data-pattern');
		 	if (isEmptyString(value)){
		 		this.setCustomValidity('This field is required');
		 		state = false;
		 	}
		 	
		})
		if(state){
			let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			submit_ajax({
				'productname':$('#productname').val(),
				'quantinty':$('#quantinty').val(),
				'price':$('#price').val(),
				'timestamp':Date.now(),
				'uid':$('#uid').val(),
				_token: CSRF_TOKEN
			})
		}
		 return false;

	})

	$(document).on('click','.edit_product',(e)=>{
		let data = $(e.target).attr('data-product');

		data = JSON.parse(data);
		$('#productname').val(data.productname)
		$('#quantinty').val(data.quantinty)
		$('#price').val(data.price)
		$('#uid').val(data.timestamp)
	})

	function submit_ajax(data){
		let url =$('#addform').attr('data-url');
		$.ajax({
		  type: "POST",
		  url: url,
		  data: data,
		  success: function(data){
		  	$('#addform')[0].reset()
		  	$('#uid').val('')
		  	load_data()
		  }
		});

	}
	function isEmptyString(string) {
        string = new String(string);
        if(string == null) {
            return true;
        }
		if(string.replace(' ', '') === '') {
			return true;
		}
		return false;
    }
    function getFormattedDate(timestamp){
      let d = new Date();
      let date = new Date();
      date.setTime(timestamp);
      let month = date.getMonth() + 1;
      let day = date.getDate();
      let hour = date.getHours();
      let min= date.getMinutes();
      let sec= date.getSeconds();
      let ampm = hour >= 12 ? 'PM' : 'AM';
      hour = hour % 12;
      hour = hour ? hour : 12;
      min = min < 10 ? '0'+min : min;
      sec = sec < 10 ? '0'+sec : sec;
      let strTime = hour + ':' + min + ' ' + ampm;
      strTime = day +' '+MONTH_NAMES[date.getMonth()]+' '+date.getFullYear()+' '+hour + ':' + min + ' ' + ampm;
      return strTime;
  }

    function load_data(){
    	let url =$('#list_data').attr('data-url');
    	$('#list_data').html('')
		$.ajax({
		  type: "GET",
		  url: url,
		  dataType: "json",
		  success: function(data){
		  	if(data.length > 0){
		  		data.sort((a,b)=>{
			  		return b.timestamp - a.timestamp;
			  	})
		  	}
		  	let total =0;
		  	$.each(data, (i, product)=>{
		  		let sum_total = (parseInt(product.quantinty) * parseInt(product.price));
		  		total +=sum_total;
		  		let editbtn = "<button type='button' class='btn btn-primary edit_product' data-id='"+i+"' data-product='"+JSON.stringify(product)+"'>Edit</button>"
		  	 	let $html = '<tr><td>'+product.productname+'</td><td>'+product.quantinty+'</td><td>$'+product.price+'</td><td>'+getFormattedDate(product.timestamp)+'</td><td>'+sum_total+'</td><td>'+editbtn+'</td></tr>'
		  		$('#list_data').append($html)
		  	})
		  	let $html = '<tr><td></td><td></td><td></td><td></td><td>'+total+'</td><td></td></tr>'
		  	$('#list_data').append($html)
		  	
		  }
		});
    	
    }
    load_data()
})()