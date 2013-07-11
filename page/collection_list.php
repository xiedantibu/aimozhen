<?php
include "../include/init.php";
$pagename = "collection";$headname = "collection";
include '../view/base/header.php';
$collection_id = $_GET['id'];
$collection = new Collection($collection_id);
$video_count = $collection->count;

$video = new Video();

$page_size = 24;
$url=explode("?p=",$_SERVER['REQUEST_URI']);
$page = isset($url[1]) ? intval($url[1]) : 1;
?>


    <?php include HTDOCS_DIR . "/view/base/headerbar.php"; ?>
      <div class="row">
      
<div class="span8 breadcrumb"> <a href="/"><?=$sitename?></a> > <a href="/collection/">选辑</a> > <a href="#"><?=$collection->name?></a></div></div>
    
      <div class="row">
  <div class="span12" style="margin:0"> 
  
     	<?
		$video = new Video();
		$video->collection = $collection_id;
		$videos = $video->find(array('order' => 'id desc', 'limit' => ($page-1) * $page_size . ', ' . $page_size));
		foreach ($videos as $video) {
			$user = new User($video->userid);
	?>
      <!-- 作品-->
		<?php include HTDOCS_DIR . "/view/base/post.php"; ?>
      <!-- /作品--> 
	<?
		}
	?>
		  </div>
      </div>
        
		<div class="row">
            <div class="pagination pagination-small pagination-centered">
                <?php require_once HTDOCS_DIR . "/include/page.php";;
                    $subPagess=new SubPages($page_size,$video_count,$page,10,"/collection/".$collection_id."/?p=",2);
                ?>
            </div>
 		</div>
        
    </div> <!-- /上方 -->
<?php
include '../view/base/footer.php';
?>