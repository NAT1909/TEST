<?php 
include_once "header.php";
include_once "model.php";
if(!isset($_SESSION['idUser'])){
	header('Location: index.php');
}
$model = new Model;
$listFriend = $model->findAllFriends($_SESSION['idUser']);
$search = 0;
//Tìm kiếm người dùng
if(isset($_POST['search-name'])){
	if(!empty($_POST['keyword'])){
		$keyword = $_POST['keyword'];
		$user = $model->findUserByKeyword($keyword);
		if(!$user){
			$_SESSION['error'] = "Không tồn tại người dùng";
		}
		else{
			$search = 1;
		}
	}else{
		$_SESSION['error'] = "Bạn nhập chưa đầy đủ thông tin";
	}
}
//Tìm kiếm bài viết
if(isset($_POST['search-post'])){
	if(!empty($_POST['keyword'])){
		$keyword = $_POST['keyword'];
		$post = $model->findPostByKeyword($keyword);
		if(!$post){
			$_SESSION['error'] = "Không tồn tại bài viết";
		}
		else{
			$search = 1;
		}
	}else{
		$_SESSION['error'] = "Bạn nhập chưa đầy đủ";
	}
}
?>
<?php if(isset($_SESSION['error'])):?>
	<div class="alert alert-warning" role="alert">
		<?php
		echo $_SESSION['error'];
		unset($_SESSION['error']);
		?>
	</div>
<?php endif ?>
<h2><center>Tìm kiếm</center></h2>
<form action="search.php" method="POST">
	<div class="form-group">
		<label>Nhập từ khóa</label>
		<input type="text" class="form-control" placeholder="Nhập vào nội dung tìm kiếm" name="keyword">
	</div>
	<button type="submit" class="btn btn-primary" name="search-name">Tìm người dùng</button>
	<button type="submit" class="btn btn-primary" name="search-post">Tìm bài viết</button>
</form>
<div class="show-user">
	<?php if(isset($_POST['search-name']) && $search == 1):?>
		<?php foreach ($user as $user): ?>
			<div class="friend">
				<a href="info_user.php?id=<?=$user->id?>"><img src="profile_pictures/<?php echo $user->avatar;?>">
					<h4><?php echo $user->fullname ?></h4>
				</a>
			</div>
		<?php endforeach ?>
	<?php endif?>
</div>
<div class="search-blog">
	<?php if(isset($_POST['search-post']) && $search == 1):?>
		<?php foreach ($post as $post): ?>
			<?php $user = $model->findUserById($post->idUser);?>
			<div class="show-post">
				<h4><a href="info_user.php?id=<?=$user->id?>"><?php if($user->avatar != ''):?><img width="100px"  src="profile_pictures/<?php echo $user->avatar;?>"><?php endif?>Họ tên: <?=$user->fullname?></a></h4>
				<p>Đăng lúc: <?=$post->timeCreate?></p>
				<p style="color: #0050ff"> <?=$post->content?></p>
				<p><?php if($post->picture != ''): ?><img width="500px;" src="images-post/<?php echo $post->picture;?>"></p><?php endif?>
				<p>Chế độ bài viết: <?php if($post->tinhTrangBaiViet == 0) echo "Công khai"?></p>
				<p><a href="single_post.php?idPost=<?=$post->id?>">Bình luận (<?php 
						$countComment = $model->countComment($post->id); 
						if($countComment)
							echo $countComment->countComment; ?> bình luận)</a></p>
			</div>
		<?php endforeach ?>
	<?php endif;?>
	</div>
<?php include_once "footer.php";?>
