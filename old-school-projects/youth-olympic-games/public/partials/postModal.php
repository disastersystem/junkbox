<div class="modal modalPost" tabindex="-1" post-id = "0" role="dialog" aria-labelledby="myModalLabel" style="padding: 0;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<div style = "cursor: pointer; float:right; padding-right: 50px; color: #888;" onClick = "toggleShare();">
					Share <i class="fa fa-share-alt"></i>
				</div>

				<div class="deleteButtonContainer">
					<!-- append delete button here -->
				</div>

				<h4 class="modal-title" id="myModalLabel"><!-- title of post --></h4>
			</div>

			<div class = "sharingContainer">

				<span style = "vertical-align: 25%; margin-right: 20px; color: #aaa;" >Share: </span>

				<button class = "shareButtons facebook">
					<i class="fa fa-facebook-square"></i>
				</button>

				<button class = "shareButtons">
					<div id="tweetBtn">
						<a class="twitter-share-button"
				            href="https://twitter.com/share"
				            data-hashtags="YOG2016,Lillehammer"
				            data-text="Youth Olympic Games">
				        </a>
						<script>!function(d,s,id){
							var js,fjs=d.getElementsByTagName(s)[0];
							if(!d.getElementById(id)){
							js=d.createElement(s);
							js.id=id;js.src="//platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);}
							}(document,"script","twitter-wjs");
						</script>
					 </div>
				</button>
			</div>

			<div class = "author col-xs-12">
				<img class = "authorImage col-xs-3">
				<div class = "authorName col-xs-9"></div>
				<div class = "authorTimestamp col-xs-9">sdfds</div>
			</div>
			<div class="modal-body">
				<div class="media-view">
					<!-- image or video gets inserted here -->
				</div>

				<!-- if(isset($_SESSION['user_session']))
					echo
					'<div class="commentField col-xs-12">
						<div class = "col-xs-10">
							<textarea class = "commentField" placeholder = "comment" ></textarea>
						</div>
						<div class = "col-xs-2">
							<button class = "submitComment">
								<i class="fa fa-comment"></i>
							</button>
						</div>
					</div>'; -->

				<div class="commentField col-xs-12">
						<div class = "col-xs-10">
							<textarea class = "commentField" placeholder = "comment" ></textarea>
						</div>
						<div class = "col-xs-2">
							<button class = "submitComment">
								<i class="fa fa-comment"></i>
							</button>
						</div>
					</div>

				<div class="comments-view"></div>
			</div>


		</div>
	</div>
</div>
<script>

	function toggleShare()
	{
		$('.sharingContainer').slideToggle('fast');
	}

</script>
