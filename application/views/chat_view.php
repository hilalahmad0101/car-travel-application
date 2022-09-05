
	<style type="text/css">
		.d-flex {
		    display: -ms-flexbox!important;
		    display: flex!important;
		}

		.chat{
			margin-top: auto;
			margin-bottom: auto;
		}
		.chat .card{
			height: 500px;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;
			min-width: 300px;
			padding: 15px;
			overflow: auto;
		}
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		.chat .card-header{
			border-radius: 15px 15px 0 0 !important;
			border-bottom: 0 !important;
		}
		 .chat .card-footer{
			border-radius: 0 0 15px 15px !important;
				border-top: 0 !important;
		}
		/*.container{
			align-content: center;
		}*/
		.search{
			/*border-radius: 15px 0 0 15px !important;*/
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
		}
		.search:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
		.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}

		.chat .active{
				background-color: rgba(0,0,0,0.3);
				margin-top: 10px;
				margin-bottom: -10px;
		}
		.rounded-circle {
		    border-radius: 50%!important;
		}
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
		
		}

		.active .user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
			margin-top: -10px;
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
		.img_cont{
				position: relative;
				height: 70px;
				width: 70px;
		}
		.img_cont_msg{
				height: 40px;
				width: 40px;
		}
		.online_icon{
			position: absolute;
			height: 15px;
			width:15px;
			background-color: #4cd137;
			border-radius: 50%;
			bottom: 0.2em;
			right: 0.4em;
			border:1.5px solid white;
		}

		.active .online_icon{
			position: absolute;
			height: 15px;
			width:15px;
			background-color: #4cd137;
			border-radius: 50%;
			bottom: 0.2em;
			right: 0.4em;
			border:1.5px solid white;
			bottom: 10px;
		}
		.offline{
			background-color: #c23616 !important;
		}
		.user_info{
			margin-top: auto;
			margin-bottom: auto;
			margin-left: 15px;
		}
		.user_info span{
			font-size: 20px;
			color: white;
		}
		.user_info p{
		font-size: 10px;
		color: rgba(255,255,255,0.6);
		}
		.video_cam{
			margin-left: 50px;
			margin-top: 5px;
		}
		.video_cam span{
			color: white;
			font-size: 20px;
			cursor: pointer;
			margin-right: 20px;
		}
		.msg_cotainer{
			margin-top: auto;
			margin-bottom: auto;
			margin-left: 10px;
			border-radius: 25px;
			background-color: #82ccdd;
			padding: 10px;
			position: relative;
		}
		.msg_cotainer_send{
			margin-top: auto;
			margin-bottom: auto;
			margin-right: 10px;
			border-radius: 25px;
			background-color: #78e08f;
			padding: 10px;
			position: relative;
		}
		.msg_time{
			position: absolute;
			left: 0;
			bottom: -15px;
			color: rgba(255,255,255,0.5);
			font-size: 10px;
		}
		.msg_time_send{
			position: absolute;
			right:0;
			bottom: -15px;
			color: rgba(255,255,255,0.5);
			font-size: 10px;
		}
		.msg_head{
			position: relative;
		}
		#action_menu_btn{
			position: absolute;
			right: 10px;
			top: 10px;
			color: white;
			cursor: pointer;
			font-size: 20px;
		}

		.action_menu ul{
			list-style: none;
			padding: 0;
		margin: 0;
		}
		.action_menu ul li{
			width: 100%;
			padding: 10px 15px;
			margin-bottom: 5px;
		}
		.action_menu ul li i{
			padding-right: 10px;
		
		}
		.action_menu ul li:hover{
			cursor: pointer;
			background-color: rgba(0,0,0,0.2);
		}


		@media(max-width: 576px){
			.contacts_card{
				margin-bottom: 15px !important;
			}
		}
	</style>

			<div class="chat">
				<div class="card contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-addon">
								<span class="input-group-text search_btn"><i class="fa fa-search"></i></span>
							</div>
						</div>

					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
										<span class="online_icon"></span>
									</div>
									<div class="user_info">
										<span>Khalid</span>
										<p>Kalid is online</p>
									</div>
								</div>
							</li>
							<li class="active">
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg" class="rounded-circle user_img">
										<span class="online_icon offline"></span>
									</div>
									<div class="user_info">
										<span>Taherah Big</span>
										<p>Taherah left 7 mins ago</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">
										<span class="online_icon"></span>
									</div>
									<div class="user_info">
										<span>Sami Rafi</span>
										<p>Sami is online</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://static.turbosquid.com/Preview/2014/05/17__21_33_18/Male_Rigged_Face_4_.jpg11e3e67f-0abe-4e79-b376-d1036c040396Res200.jpg" class="rounded-circle user_img">
										<span class="online_icon offline"></span>
									</div>
									<div class="user_info">
										<span>Nargis Hawa</span>
										<p>Nargis left 30 mins ago</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg" class="rounded-circle user_img">
										<span class="online_icon offline"></span>
									</div>
									<div class="user_info">
										<span>Rashid Samim</span>
										<p>Rashid left 50 mins ago</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
										<span class="online_icon"></span>
									</div>
									<div class="user_info">
										<span>Khalid</span>
										<p>Kalid is online</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg" class="rounded-circle user_img">
										<span class="online_icon offline"></span>
									</div>
									<div class="user_info">
										<span>Taherah Big</span>
										<p>Taherah left 7 mins ago</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">
										<span class="online_icon"></span>
									</div>
									<div class="user_info">
										<span>Sami Rafi</span>
										<p>Sami is online</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://static.turbosquid.com/Preview/2014/05/17__21_33_18/Male_Rigged_Face_4_.jpg11e3e67f-0abe-4e79-b376-d1036c040396Res200.jpg" class="rounded-circle user_img">
										<span class="online_icon offline"></span>
									</div>
									<div class="user_info">
										<span>Nargis Hawa</span>
										<p>Nargis left 30 mins ago</p>
									</div>
								</div>
							</li>
							<li>
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg" class="rounded-circle user_img">
										<span class="online_icon offline"></span>
									</div>
									<div class="user_info">
										<span>Rashid Samim</span>
										<p>Rashid left 50 mins ago</p>
									</div>
								</div>
							</li>
						</ui>
					</div>
					<div class="card-footer"></div>
				</div>
			</div>

			<h1 class="text-center text-danger">Coming soon...</h1>