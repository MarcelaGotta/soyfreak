@foreach(app('App\\Addons\\Custombox\\Classes\\CustomBoxRepository')->getList(10, (!isset($all)) ? true : false, false) as $box)

			<div class="box">
				<div class="panel panel-default panel-box">
						@if($box->style_boxheader == 'special')
							<div class="panel-body panel-body-image">
								<div class="bg-overlay olay-{{$box->headercol}}"></div>
								
									@if($box->headerimg)
									<div class="bg-img wio-{{$box->headercol}}">
										<img src="{{URL::to('')}}/app/Addons/Custombox/assets/images/{{$box->headerimg}}">
									</div>
									@else
									<div class="bg-img wio-{{$box->headercol}}" style="display:table !important;">
										<h3>{{Str::limit($box->headline, 100)}}</h3>
									</div>
									@endif
								<a href="#" class="panel-body-inform icon-@if($box->headerimg){{$box->headercol}} @else{{$box->headercol}}-blank @endif">
								   <span><i class="icon ion-{{$box->icontype}}"></i></span>
								</a>
							</div>
						@else
							<div class="box-title">
								{{Str::limit($box->headline, 100)}}
							</div>
						@endif
							<div class="box-content">
								<div class="recent-custom-boxes-list">
									<h3>{{Str::limit($box->title, 100)}}</h3>
									<div class="custombox-content">{{$box->content}}</div>
								</div>
							</div>
							<div class="panel-footer likes">
									<ul>
										@if($box->show_likes)
											<li>
												<?php $hasLike = $box->hasLiked()?>
												<a data-is-login="{{Auth::check()}}" data-status="{{($hasLike) ? '1' : 0}}" class="like-button" data-like="{{trans('like.like')}}" data-unlike="{{trans('like.unlike')}}" data-id="{{$box->id}}" data-type="custombox" href=""> <span>{{($hasLike) ? trans('like.unlike') : trans('like.like')}}</span></a>
												<span class="pull-right"><i class="icon ion-ios7-heart"></i> &#183 <span class="post-like-count-{{$box->id}}"> {{$box->countLikes()}}</span></span>
											</li>
										@endif
									</ul>
							
							</div>
						@if($box->footer)
							<div class="panel-footer">{{$box->footer}}</div>
						@endif
				</div>
			</div>
@endforeach