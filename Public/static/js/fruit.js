// location
	function setLocation(){
		// 得到页面宽度
		var pageWidth	= document.body.scrollWidth;
		// 设置背景图宽度
		document.getElementById('location_img').style.backgroundSize	= pageWidth+"px";
		// 得到页面高度 
		var pageHeight	= document.body.scrollHeight;
		// 设置页面高度
		pageHeight		= pageHeight;
		document.getElementById('pageone').style.height	= pageHeight+"px";
	}
// check
	function carSub(fruit_id){
        var nowNum=parseInt(document.getElementById('fruit_id_'+fruit_id).innerHTML);
        if(nowNum>1){
            var afterNum=nowNum-1;
            document.getElementById('fruit_id_'+fruit_id).innerHTML=afterNum;
            document.getElementById('fruit_num_'+fruit_id).value=afterNum;
        } 
    }
    function carAdd(fruit_id){
        var afterNum=parseInt(document.getElementById('fruit_id_'+fruit_id).innerHTML)+1;
        document.getElementById('fruit_id_'+fruit_id).innerHTML=afterNum;
        document.getElementById('fruit_num_'+fruit_id).value=afterNum;
    }
	function checkform(){
		var lname	= document.getElementById('lname').value;
		var fmobile	= document.getElementById('fmobile').value;
		var fplace	= document.getElementById('fplace').value;
		var fdetail	= document.getElementById('fdetail').value;
		//var fsendtime	= document.getElementById('fsendtime').value;
		if( lname.length < 1 ){
			$.mobile.loading('show', {  
				text: "亲尊姓大名？", //加载器中显示的文字  
				textVisible: true, //是否显示文字  
				theme: 'e',        //加载器主题样式a-e  
				textonly: true,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			setTimeout("hiddenLoading()",2000);
			return false;
		}else if( fmobile.length != 11 ){
			$.mobile.loading('show', {  
				text: "手机号告诉我呗！", //加载器中显示的文字  
				textVisible: true, //是否显示文字  
				theme: 'e',        //加载器主题样式a-e  
				textonly: true,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			setTimeout("hiddenLoading()",2000);
			return false;
		}else if( fplace == 'none' ){
			$.mobile.loading('show', {  
				text: "请选择收货区域哦！", //加载器中显示的文字  
				textVisible: true, //是否显示文字  
				theme: 'e',        //加载器主题样式a-e  
				textonly: true,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			setTimeout("hiddenLoading()",2000);
			return false;
		}else if( fdetail.length < 1 ){
			$.mobile.loading('show', {  
				text: "请填写收货地址哦！", //加载器中显示的文字  
				textVisible: true, //是否显示文字  
				theme: 'e',        //加载器主题样式a-e  
				textonly: true,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			setTimeout("hiddenLoading()",2000);
			return false;
		}
		/*else if( fsendtime == '0' ){
			$.mobile.loading('show', {  
				text: "请选择配送时间！", //加载器中显示的文字  
				textVisible: true, //是否显示文字  
				theme: 'e',        //加载器主题样式a-e  
				textonly: true,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			setTimeout("hiddenLoading()",2000);
			return false;
		}*/
		document.form1.submit();
	}
    // 清除提示信息
    function hiddenLoading(){
        $.mobile.loading('hide','normal');
    }

// detail
	// 商品ID 域名URL 购物OR加入购物车，默认是加入购物车
    function addtocar(fruit_id,nurl,buyit){
            // 添加购物车
			// 购物车提示信息
			$.mobile.loading('show', {  
				//text: "恭喜，已加入至购物车", //加载器中显示的文字  
				textVisible: false, //是否显示文字  
				theme: 'a',        //加载器主题样式a-e  
				textonly: false,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			// 去读附加条件
			var addinfo_arr	= document.getElementsByClassName('detail_addinfo_checked');
			var addinfo_str	= '';
			for( var i=0;i<addinfo_arr.length;i++ ){
				addinfo_str	= addinfo_str+","+addinfo_arr[i]['id'];
			}
			//console.log(addinfo_str);
            $(document).load(nurl+"/addtocar/id/"+fruit_id+"/buyit/"+buyit+"/addinfo/"+addinfo_str,function(responseTxt,statusTxt,xhr){
                if(statusTxt=="success"){
                    // 返回的是购物车的商品数量
                    if( responseTxt>0 ){
						// 如果返回的是 1024 表示，直接进入购物车
						if( responseTxt == 1024 ){
							window.location.href	= nurl+"/mycar";
							return false;
						}
                        // 购物车提示信息
                        $.mobile.loading('show', {  
                            text: "恭喜，已加入至购物车", //加载器中显示的文字  
                            textVisible: true, //是否显示文字  
                            theme: 'a',        //加载器主题样式a-e  
                            textonly: true,   //是否只显示文字  
                            html: ""           //要显示的html内容，如图片等  
                        });
                        console.log(responseTxt);
                        $('.carnum').text(responseTxt);   
                        setTimeout("hiddenLoading()",1500); 
                    }
                }
                if(statusTxt=="error"){
                    alert("加入购物车失败，请重试。");
                }
            });          
    }

// mycare
    function carSub(fruit_id){
        var nowNum=parseInt(document.getElementById('fruit_id_'+fruit_id).innerHTML);
        if(nowNum>1){
            var afterNum=nowNum-1;
            document.getElementById('fruit_id_'+fruit_id).innerHTML=afterNum;
            document.getElementById('fruit_num_'+fruit_id).value=afterNum;
            document.getElementById('carnum').innerHTML=document.getElementById('carnum').innerHTML-1;
             var burl=document.getElementById('baseurl').value;
             $(document).load(burl+"/index.php/Fruit/Index/changecarnum/num/"+document.getElementById('carnum').innerHTML+'/fruit_id/'+fruit_id+'/num2/'+afterNum,function(responseTxt,statusTxt,xhr){});
    }
    }
    function carAdd(fruit_id){
        var afterNum=parseInt(document.getElementById('fruit_id_'+fruit_id).innerHTML)+1;
        document.getElementById('fruit_id_'+fruit_id).innerHTML=afterNum;
        document.getElementById('fruit_num_'+fruit_id).value=afterNum;
        document.getElementById('carnum').innerHTML=parseInt(document.getElementById('carnum').innerHTML)+1;
        	var burl=document.getElementById('baseurl').value;
             $(document).load(burl+"/index.php/Fruit/Index/changecarnum/num/"+document.getElementById('carnum').innerHTML+'/fruit_id/'+fruit_id+'/num2/'+afterNum,function(responseTxt,statusTxt,xhr){});
    }
	function carDel(fruit_id,nurl,nums){
		//var id_carnum=parseInt(document.getElementById('id_carnum').value)-nums;

		$(document).load(nurl+"/delfromcar/id/"+fruit_id,function(responseTxt,statusTxt,xhr){
			if(statusTxt=="success"){
				if( responseTxt ){
					var id_carnum = parseInt(responseTxt);
					document.getElementById('id_carnum').value	= id_carnum;

		
		
					if( id_carnum < 1 ){
						//document.getElementById("fruit_li_"+fruit_id).innerHTML='';
						document.getElementById("fruit_li_"+fruit_id).style.display='none';
						document.getElementById("gotoCheck").innerHTML='';
						document.getElementById("gotoCheck").style.display='none';
						//document.getElementById("gotoCheck").remove();
						// 购物车提示信息
						$.mobile.loading('show', {  
							text: "购物车已空。", //加载器中显示的文字  
							textVisible: true, //是否显示文字  
							theme: 'a',        //加载器主题样式a-e  
							textonly: true,   //是否只显示文字  
							html: '购物车是空的，去选购吧！'           //要显示的html内容，如图片等  
						});
						$('.carnum').text(0);
					}else{
						$('.carnum').text(id_carnum);
						document.getElementById("fruit_li_"+fruit_id).innerHTML='';
						document.getElementById("fruit_li_"+fruit_id).style.display='none';
					}
							}
			}
			if(statusTxt=="error"){
			}
		});
	}

$(document).ready(function(){
	// 详情页面，选择附加条件
	$(".detail_addinfo").click(function(){
		var touch_id	= this.id;
		$("#"+touch_id).toggleClass('detail_addinfo_checked');
	});
	// location 点击搜索框，搜索框 滑动到顶部
	$('#search_location').click(function(){ 
		var gotoheight	= $(document).height();
		gotoheight		= gotoheight*0.38;
		gotoheight		= gotoheight+"px";
		//alert(gotoheight);
		$('body').animate({scrollTop: gotoheight}, 500);
	});
	// location 搜索框变化，Ajax 查询符合条件的记录
	$('#search_location').on('keyup',function(){
		// 用户输入内容
		var keyword	= $('#search_location').val();
		keyword		= keyword.replace(/(\s*)|(\s*)/g,"");
		var	baseurl	= $('#base_url').val();
		var selectstr	= "<a href='"+baseurl+"/index.php/fruit'>您输入的地址不在我们的配送范围内，请重新输入，或联系客服：010-89940661<br /><br />直接进入</a>";
		if( keyword ){
			// 发送Ajax请求
			$(document).load(baseurl+"/index.php/fruit/index/location/keyword/"+keyword,function(responseTxt,statusTxt,xhr){
				// 下拉菜单
				if(statusTxt=="success"){
					var reObj	= eval('('+responseTxt+')');
					//console.log(reObj.relist.length);
					// json 下拉，5个
					if( reObj.resum > 0 ){
						// 构造下拉菜单
						selectstr	= '';
						for( key in reObj.relist ){
							// 单条记录
							var list_str_tmp	= reObj.relist[key];
							selectstr		   += "<a href='"+baseurl+"/index.php/fruit/index/index/office_id/"+list_str_tmp.office_id+"'>"+list_str_tmp.office_name+"</a>";
						}
					}else{
						selectstr;
					}
				}
				if(statusTxt=="error"){
					selectstr;
				}
				$('.location-search-result').html(selectstr);
			});
		}else{
			selectstr	= "<a href='"+baseurl+"/index.php/fruit'>直接进入</a>";
			$('.location-search-result').html(selectstr);
		}
		//console.log(list_str_tmp);
	});
});

// 切换商圈，清空详细地址
function clearfdetail(fdetail){
	document.getElementById(fdetail).value = '';
}