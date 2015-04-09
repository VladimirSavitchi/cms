    <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">

		<?php foreach ($projects as $key => $value) : ?>
		<?php $item_class = ($i == 1) ? 'item active' : 'item'; ?>
            <div class="<?php echo $item_class; ?> ">

                <div class="bannerImage">
                    <a href="index.php?p=gallery&id=<?php echo $projects[$key]['project_id']; ?>"><img src="admin/<?php echo $projects[$key]['url']; ?>" alt=""></a>
                </div>

                <div class="caption row-fluid">
                    <div class="span4"><h3><?php echo $projects[$key]['project_title']; ?></h3>
                    <a class="btn btn-inverse" href="index.php?p=gallery&id=<?php echo $projects[$key]['project_id']; ?>"> <i class="icon-picture icon-large icon-white"> </i>  View Gallery</a>
                    </div>                	
                	<div class="span8"><p><?php echo $projects[$key]['project_content']; ?></p>
                	</div>
                </div>

            </div><!-- /Slide1 --> 
		<?php $i++; ?>
		<?php endforeach; ?>
			
        </div>

          <div class="control-box">                            
            <a data-slide="prev" href="#myCarousel" class="carousel-control left"><i class="glyphicon glyphicon-chevron-left"></i></a>
            <a data-slide="next" href="#myCarousel" class="carousel-control right"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </div><!-- /.control-box --> 

    </div><!-- /#myCarousel -->