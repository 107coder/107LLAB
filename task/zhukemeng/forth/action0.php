<?php
//这是一个信息增、删和改操作的处理页

//（1）、 导入配置文件
	require("introduction_dbconfig.php");
	
//（2）、连接MySQL、并选择数据库
	$link4 = @mysqli_connect(HOST4,USER4,PASS4) or die("数据库连接失败！");
	mysqli_select_db($link4,DBNAME4);
	mysqli_set_charset($link4,'utf8');
	
//（3）、根据需要action值，来判断所属操作，执行对应的代码
	switch($_GET["action0"]){
		case "add": //执行添加操作
			//1. 获取要添加的信息，并补充其他信息
				$title = $_POST["title"];
				$content = $_POST["content"];
				
 			//2. 做信息过滤（省略）
			//3. 拼装添加SQL语句，并执行添加操作
				$sql = "insert into introduction(title,content) values('{$title}','{$content}');";
				
				mysqli_query($link4,$sql);
				
			//4. 判断是否成功
				$id = mysqli_insert_id($link4);//获取刚刚添加信息的自增id号值
				echo $id;
				
				if($id>0){
					echo "<h3>新闻信息添加成功！</h3>";
				}else{
					echo "<h3>新闻信息添加失败！</h3>";
				}
				echo "<a href='javascript:window.history.back();'>返回</a>&nbsp;&nbsp;";
				echo "<a href='introdution.php'>浏览</a>";
				
				break;
		
		case "del": //执行删除操作
				//1. 获取要删除的id号
				$id=$_GET['id'];
				
				//2. 拼装删除sql语句，并执行删除操作
				$sql = "delete from introduction where id={$id}";
				mysqli_query($link4,$sql);
				
				//3. 自动跳转到浏览新闻界面
				header("Location:introdution.php");
			break;
			
		case "update": //执行修改操作
				//1. 获取要修改的信息
				$title = $_POST["title"];
				$content = $_POST["content"];
				$id = $_POST['id'];
				
				//2. 过滤要修改的信息（省略）
				//3. 拼装修改sql语句，并执行修改操作
				$sql = "update introduction set title='{$title}',content='{$content}' where id={$id}";
				//echo $sql;
				mysqli_query($link4,$sql);
			
				//4. 跳转回浏览界面
				header("Location:introdution.php");
				
			break;
	
	}
	
//（4）、关闭数据连接
	mysqli_close($link4);
