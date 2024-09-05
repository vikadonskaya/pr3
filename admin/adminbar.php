<style>	
body{
	margin:0;
	padding:0;
	font: 13px arial, sans-serif; 
	font-family: Calibri;
	font-size: 10pt;
}
#admin_header{
	height:18px;
	float:left;
	width:100%;
	background: url('admin/design/images/bg_panel.png') repeat;
	border-bottom:1px solid #C9D7F1;
	padding:5px;	
}

#admin_header a{
	font: 13px arial, sans-serif; 
	color: gray;
	text-decoration: none;
}

#admin_header a:hover{
	color: orange;
}

#admin_header .menu{
	float:left;
	margin-top:1px;
}

#admin_header .menu ul{
	margin:0;
	padding:0;
	list-style:none;
}

#admin_header .menu ul li{
	float:left;
	margin-right:15px;
	padding:0 15px 0 23px;
	border-right:1px solid #C9D7F1;
}


#admin_header .menu li.page{
	background:url(admin/design/images/icons/page.png) 0 50% no-repeat;
}

#admin_header .menu li.menu{
	background:url(admin/design/images/icons/menu.png) 0 50% no-repeat;
}
#admin_header .menu li.settings{
	background:url(admin/design/images/icons/settings.png) 0 50% no-repeat;
}
#admin_header .menu li.products{
	background:url(admin/design/images/icons/products.png) 0 50% no-repeat;
}

#admin_header .user{
float:right;
margin-right:15px;
}
</style>
	<div id="admin_header">
		<div class="logo"></div>		
		<div class="menu">
			<ul>
				<li ><a href="/admin" id="look">Панель управления</a></li>
			</ul>
		</div>
		<div class="user">
			<a href="#"><?=$_SESSION["User"]?></a> (<a href="/enter?out=1">Выход</a>)
		</div>
	</div>