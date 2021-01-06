
<html>
<head>
	<style>
		.search-box{
			align-self: center;
			justify-self: stretch;
			width: 300px;
			
		}
		.flex-box {
			  display: flex;
			  justify-content: space-around;
			  align-items: center;
			  flex-wrap: wrap;
			  margin-left:100px;
			  margin-right:100px;
			  margin-bottom: 50px;
			}

		.flex-element {
			  display: flex;
			  flex-direction: column;
			  align-items: center;
			}
	</style>
</head>
		<div class="flex-box">
		<div class="flex-element">
			<form class="form-inline search-box" id="search" method="GET" action="listProduct.php">
				<input class="form-control form-control-lg mr-3" type="text" placeholder=" Search... " aria-label="Search" name="product">
				Women: <input type="radio" value="Mulher" name="gender" <?php if($_GET['gender']=="Mulher"){echo "checked=\"checked\"";}?>>
				Men: <input type="radio" value="Homem" name="gender" <?php if($_GET['gender']=="Homem"){echo "checked=\"checked\"";}?>>
			</form>
		</div>
		</div>
</html>