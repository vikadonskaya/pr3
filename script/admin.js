		function show_catalog(){  
				//сворачивает полное описание у всех строк
				/*$("td[class=desc]").each(function(){		
						var text=$(this).text();
						$(this).text(text.substr(0,120)+'...');
					}
				);*/
		}
		
		//запрашивает страницу для вывода 
		function show(url)  
        {  
            $.ajax({                
				type: "POST",
				url: "ajax.php",
				data: { url: url },
                cache: false,  
                success: function(data){  
			        $("#content").html(data);  
			
                }  
            });  
        }  
		//отчистка всех полей форы  редактирвания товара
	  	function clear_field_edit()  
        {  
			var edit_product=$(".edit_product");	
			edit_product.find("input[name=edit_id]").val('');
			edit_product.find("input[name=edit_name]").val('');
			edit_product.find("input[name=edit_code]").val('');
			edit_product.find("#edit_preview").html('');
			edit_product.find("input[name=edit_price]").val('');
			edit_product.find("textarea[name=edit_description]").val('');			
			$('input[name=edit_photoimg]').val('');
		
		
        }  
		
		//отчистка всех полей форы добавления товара
		function clear_field_new_product()  
        {  
			var creat_product=$(".creat_product");		
			creat_product.find("input[name=name]").val('');
			creat_product.find("input[name=code]").val('');
			creat_product.find("#preview").html('');
			creat_product.find("input[name=price]").val('');
			creat_product.find("textarea[name=description]").val('');			
			$('input[name=photoimg]').val('');
        }  
		
	  function indication(object,text, type)  
        {
				var background="#9abb8b";
				var bordercolor="#588a41";
			
				if(!type){
					background="#fab0ab";  
					bordercolor="#fc6f64";
				}
				object.animate({ opacity: "show" }, "slow" );
				object.html(text); 
				object.css('background',background);
				object.css('border-color',bordercolor);			
				object.animate({ opacity: "hide" }, 3000 );
				
		}
		
		//позиционирование элемента по центру окна
		function centerPosition(object)  
        {
			object.css('position', 'absolute');
			object.css('left', ($(window).width()-object.width())/2+ 'px');
			object.css('top', ($(window).height()-object.height())/2+ 'px');
		}
		
	$(document).ready(function(){   	
		//если запрашиваемая страница, не из админки а из сайта, то парсим гет параметры
		//var GET = {}; 
		//window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value){ GET[key] = value; }); 
		//if(GET['id']) show(GET['id']+".php");
		
		//обработчики нажатий на ссылки в панеле
			$('a[id=product]').click(function(){show("catalog.php");});
			$('a[id=page]').click(function(){show("page.php");});
			$('a[id=menu]').click(function(){show("menu.php");});
			$('a[id=settings]').click(function(){show("settings.php");});
	});  	
	
	/*Каталог*/ 
		
		//Обработка  нажатия кнопки перехода на другую страницу каталога
		$('a[rel=pagination]').live("click", function(){    
			
			var  l=$(this).attr('l'); // нижняя граница
			var  step=$(this).attr('step');// интервал
			
			$.ajax({                
					type:"POST",
					url: "ajax.php",
					data: { url: "catalog.php",l:l,step:step },
					cache: false,  
					success: function(data){
						$("#content").html(data);  
					}  
				
			}); 
			
		});	
		
		//Обработка  нажатия кнопки создания нового товара
		$('a[rel=creat_new_product]').live("click", function(){
			$(".edit_product").hide();//скрываем открытые окна 
			centerPosition($(".creat_product"));  
			$(".creat_product").animate({ opacity: "show" }, 500 ); // показываем блок для создания нового товара
		}); 
		
		//Обработка  нажатия кнопки сохранения нового товара
		$('a[rel=save_new_product]').live("click", function(){
		
			var filepath=$('input[type=file]').val();//получаем путь до загружаемого файла 
			var arr= filepath.split('\\');//разбиваем его на части
			var filename=arr[arr.length-1];// берем только последнюю часть - название и расширение
	
			//далее проверка на заполненность полей
			var name=$.trim($(".creat_product").find('input[name=name]').val());
			var code=$.trim($(".creat_product").find('input[name=code]').val());
			var price=$.trim($(".creat_product").find('input[name=price]').val())-0;
			var desc=$.trim($(".creat_product").find('textarea[name=description]').val());
			var err=0;
					
		
	
			if(!code||!desc||!name){err="Все поля должны быть заполнены!";}
			else if((typeof price)!="number"||!price){err="Введите правильную цену!";}
			if(err!=0)
			{
				indication($("#message"),err, false);
			}
			else		
			$.ajax({                
						type:"POST",
						url: "ajax.php",
						data: {url: "action/add_product.php",name:name,code:code,price:price,desc:desc,image_url:filename},
						cache: false,  
						success: function(data){
		
							var response = eval("(" + data + ")");		
							indication($("#message"),response.msg, response.status);
							$(".creat_product").hide();
						
							//переходим на последнюю страницу
							var l=$("div.pagination").find("a").last().attr('l');
							var step=$("div.pagination").find("a").last().attr('step');
		
							$.ajax({                
							type:"POST",
							url: "ajax.php",
							data: { url: "catalog.php",l:l,step:step },
							cache: false,  
							success: function(data){
								$("#content").html(data);  
							}  
							}); 
						
						}
				
					}); 
		});
		
       	//Обработка  нажатия кнопки отмены создания нового товара		
		$('a[rel=cancel_creat_new_product]').live("click", function(){	
				clear_field_new_product();
				$(".creat_product").animate({ opacity: "hide" }, 500 );
		}); 
		
	

		//Обработка  нажатия кнопки редактирования  товара	
		$('a[rel=edit]').live("click", function(){
			var edit_product=$(".edit_product");
			$(".edit_btn_cansel_load_img").css('display','none');
			$(".creat_product").hide();//скрываем другие окна
			centerPosition(edit_product);  
			edit_product.animate({ opacity: "show" }, 500 );//показываем блок редактирования
			
			var id=$(this).attr('id');
			var code_product = $("tr[id="+$(this).attr('id')+"]").find("td[class=code]").text();	
			var name_product = $("tr[id="+$(this).attr('id')+"]").find("td[class=name]").text();			
			var desc_product = $("tr[id="+$(this).attr('id')+"]").find("td[class=desc]").text();
			var price_product = $("tr[id="+$(this).attr('id')+"]").find("td[class=price]").text();
			var image_url_product = $("tr[id="+$(this).attr('id')+"]").find("img[class=uploads]").attr('src');	

			edit_product.find("input[name=edit_id]").val(id);
			edit_product.find("input[name=edit_name]").val(name_product);
			edit_product.find("input[name=edit_code]").val(code_product);
		
			$(".edit_btn_load_img").css('display','block');
			

			
			if(image_url_product!="../uploads/none.png"){		
			$(".edit_btn_load_img").css('display','none');
			edit_product.find("#edit_preview").html("<img src='"+image_url_product+"' width='100' height='100'/>");
			edit_product.find(".edit_btn_cansel_load_img").css('display','block');
		
			}
		
			edit_product.find("input[name=edit_price]").val(price_product);
			edit_product.find("textarea[name=edit_description]").val(desc_product);
			
		}); 
	
			
		//Обработка  нажатия кнопки сохранения отредактированного товара	
		$('a[rel=save_edit_product]').live("click", function(){   
			var id=$.trim($('input[name=edit_id]').val());
			
			
			var filepath=$('input[name=edit_photoimg]').val();
			
			
			if(filepath!=""){
			var arr=filepath.split('\\');
			var image_url_product=arr[arr.length-1];				
			}
			else{
			var image_url_product = $("tr[id="+id+"]").find("img[class=uploads]").attr('src');	
			var arr=image_url_product.split('/');
			image_url_product=arr[arr.length-1];	
			}
		
			var name=$.trim($('input[name=edit_name]').val());
			var code=$.trim($('input[name=edit_code]').val());
			var price=$.trim($('input[name=edit_price]').val())-0;
			var desc=$.trim($('textarea[name=edit_description]').val());
			var err=0;
		
			if(!name||!code||!desc){err="Все поля должны быть заполнены!";}
			else if((typeof price)!="number"||!price){err="Введите правильную цену!";}
			
			if(err!=0)
			{
				$("#message").animate({ opacity: "show" }, "slow" );
				$("#message").html(err); 
				$("#message").css('background','#fab0ab');
				$("#message").css('border-color','#fc6f64');			
				$("#message").animate({ opacity: "hide" }, 3000 );
			}
		else	
		
			$.ajax({                
					type:"POST",
					url: "ajax.php",
					data: {url: "action/edit_product.php",
					id:id,
					name:name,
					code:code,
					price:price,
					desc:desc,
					image_url:image_url_product
					},
					cache: false,  
					success: function(data){
				
							var response = eval("(" + data + ")");		
							
							indication($("#message"),response.msg, response.status);
							$(".edit_product").animate({ opacity: "hide" }, 500 );
								
							//вставляем  измененны данные в строку таблицы
							$("tr[id="+id+"]").find("td[class=code]").text(code);	
							$("tr[id="+id+"]").find("td[class=name]").text(name);			
							$("tr[id="+id+"]").find("td[class=desc]").text(desc);
							$("tr[id="+id+"]").find("td[class=price]").text(price);
							$("tr[id="+id+"]").find("td[class=image_url]").html("");
							if(!image_url_product)image_url_product="none.png";
							$("tr[id="+id+"]").find("td[class=image_url]").html("<img class='uploads' src='../uploads/"+image_url_product+"' width='80' height='80'/>");
						
							clear_field_edit();  
					}
				
			}); 
		});
			
		
		//нажата кнопка отмены изображния в форме редакирования
		$('#edit_form_del_img').live('click', function(){ 
		var id=$.trim($('input[name=edit_id]').val());
	
		$("tr[id="+id+"]").find("img[class=uploads]").attr('src', '');	

			$.ajax({                
				type: "POST",
				url: "ajax.php",
				data: {url: "action/del_image.php",	 id: id },
                cache: false,  
                success: function(data){  
			        $("#edit_preview").html('');  	
					$(".edit_btn_load_img").css('display','block');
					$(".edit_btn_cansel_load_img").css('display','none');
					
                }  
            }); 
		});
		
		//нажата кнопка отмены изображния в форме добавления товара
		$('#form_del_img').live('click', function(){
			    $("#preview").html('');  	
			
				$('input[name=photoimg]').val('');
				$(".btn_cansel_load_img").css('display', 'none');
				$(".btn_load_img").css('display',  'block');					
            }  
        );  
		
		//Обработка  нажатия кнопки отмены редактирования  товара			
		$('a[rel=cancel_edit_product]').live("click", function(){	
				clear_field_edit();  
				$(".edit_product").animate({ opacity: "hide" }, 500 );
		}); 
		//Обработка  нажатия кнопки удаления  товара			
		$('a[rel=del]').live("click", function(){
		
		var l=$("div.pagination").find("a[class=activ]").attr('l');
		var step=$("div.pagination").find("a[class=activ]").attr('step');
		var back_url="catalog.php?l="+l+"&step="+step;
			$.ajax({                
						type:"POST",
						url: "ajax.php",
						data: {url: "action/delete_product.php",
						id:$(this).attr('id')			
						},
						cache: false,  
						success: function(data){	
						
							var response = eval("(" + data + ")");		
							indication($("#message"),response.msg, response.status);
							
							
							$.ajax({                
							type:"POST",
							url: "ajax.php",
							data: { url: "catalog.php",l:l,step:step },
							cache: false,  
							success: function(data){
								$("#content").html(data);  
							}  
							}); 
						//	show("catalog.php");
						}
				
					}); 
		}); 