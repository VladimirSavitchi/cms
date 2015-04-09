<?php
$project_id = $_GET['id'];
// read images
$target_dir ="admin/uploads/".$project_id."/gallery/";
if (is_dir($target_dir)) {
if ($dir = opendir($target_dir) ){
	$images = array();
	while (false !== ($file = readdir($dir))) {
		if ($file != "." && $file != "..") {
			$images[] = $file; 
		}
	}
	closedir($dir);
}
}
?>
	<small><a href="index.php" ><b>&#x25c0 Back</b></a></small>
		
	<div  class="container">
	   <ul class="row">
		<?php if (isset($images)) { foreach($images as $image) : ?>
		   <li class="col-lg-3 col-md-4 col-xs-6 thumb">
				<img class="img-responsive thumbnail" src="<?php echo $target_dir.$image; ?>"/>
			</li>
		  <?php endforeach; ?>
		  <?php } else { echo "<h3 class = 'msg'>Unavailable...</h3>";} ?>
	   </ul>
	</div>

		</div><!-- /.span12 -->          
	</div><!-- /.row --> 
</div><!-- /.container -->


   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script>
$('li img').on('click',function(){
                var src = $(this).attr('src');
                var img = '<img src="' + src + '" class="img-responsive"/>';
 
                //Start of new code
                var index = $(this).parent('li').index();                   
                var html = '';
                html += img;                
                html += '<div style="height:25px;clear:both;display:block;">';
				html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
                html += '<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
                html += '</div>';
                //End of new code
 
                $('#myModal').modal();
                $('#myModal').on('shown.bs.modal', function(){
                    $('#myModal .modal-body').html(html);
                })
                $('#myModal').on('hidden.bs.modal', function(){
                    $('#myModal .modal-body').html('');
                });
           });
	
 $(document).on('click', 'a.controls', function(){
 var index = $(this).attr('href');
var src = $('ul.row li:nth-child('+ index +') img').attr('src');             
$('.modal-body img').attr('src', src);

var newPrevIndex = parseInt(index) - 1; 
var newNextIndex = parseInt(newPrevIndex) + 2; 
 
if($(this).hasClass('previous')){               
    $(this).attr('href', newPrevIndex); 
    $('a.next').attr('href', newNextIndex);
}else{
    $(this).attr('href', newNextIndex); 
    $('a.previous').attr('href', newPrevIndex);
}

var total = $('ul.row li').length + 1; 
//hide next button
if(total === newNextIndex){
    $('a.next').hide();
}else{
    $('a.next').show()
}            
//hide previous button
if(newPrevIndex === 0){
    $('a.previous').hide();
}else{
    $('a.previous').show()
}

$('#myModal').on('shown.bs.modal', function(){
    $('#myModal .modal-body').html(html);
    //this will hide or show the right links:
    $('a.controls').trigger('click');
})

           return false;
        });
</script>