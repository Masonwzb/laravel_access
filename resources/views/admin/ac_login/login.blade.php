<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('style/font/css/font-awesome.min.css')}}">
</head>
<body style="background-image:url({{ asset('style/img/qwer.jpg') }}) /*background:#87CEEB*/;background-size: 100% 110%">
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>门禁</h1>
		<h2>门禁管理登录平台</h2>
		<div class="form">
			@if(session('msg'))
			<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="user_name" value="{{ old('user_name') }}" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" value="{{ old('user_pass') }}" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
				<p><a href="#">返回首页</a> &copy; 2018 Powered by </p><p><a href="http://jgxy.xmu.edu.cn/" target="_blank">厦门大学嘉庚学院</a></p>
		</div>
	</div>
</body>
</html>